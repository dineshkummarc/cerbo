<?php

namespace sandra\kernel;

class Request
{

    private $requested_uri;
    private $uri;
    private $parameters;
    private $format;

    /**
     * Load a request URI and extract its parts.
     */
    public function __construct()
    {
        $this->requested_uri = $_SERVER['REQUEST_URI'];
        $this->resolveURI();
    }

    /**
     * Resolve the URI by returning a Page or a Module.
     */
    public function resolveURI()
    {

        $config = \sandra\kernel\Configuration::getConfiguration();

        // Remove extra content from the URI
        if ( trim( $config['application.ini']['URL']['RemoveFromPath'] ) != '' )
        {
            $remove = $config['application.ini']['URL']['RemoveFromPath'];
            if ( substr( $this->requested_uri, 0, strlen( $remove ) ) == $remove )
            {
                $this->requested_uri = substr( 
                    $this->requested_uri,
                    strlen( $remove ) + 1
                );
            }
        }
        else
        {
            $this->requested_uri = substr( $this->requested_uri, 1 ); // Remove first '/'
        }
        
        // Split real URI with parameters
        $parts = explode( '//', $this->requested_uri );

        // Extract URI
        $this->uri = $parts[0];

        // Extract format
        $uri_elements = explode( '/', $this->uri );
        $last_uri_element = $uri_elements[count($uri_elements) - 1];
        if ( strrpos( $last_uri_element, '.' ) !== false )
        {
            // Extract format
            $this->format = substr( $last_uri_element, strrpos( $last_uri_element, '.' ) + 1 );
            // Remove format from URI
            $this->uri = substr( $this->uri, 0, strrpos( $this->uri, '.' ) );
        }

        // Extract parameters
        if ( isset( $parts[1] ) )
        {
            $this->parameters = explode( '/', $parts[1] );
        }
        else
        {
            $this->parameters = array();
        }

    }

    public function getURI()
    {
        return $this->uri;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getFormat()
    {
        return strtoupper( $this->format );
    }

}

?>
