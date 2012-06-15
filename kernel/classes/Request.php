<?php

/**
 * File containing the class who extract data from URL.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class Request
{

    private $requested_uri;
    private $uri;
    private $module_name;
    private $parameters;
    private $format;

    /**
     * Load a request URI and extract its parts.
     */
    public function __construct()
    {
        $this->requested_uri = $_SERVER['REQUEST_URI'];
        $this->resolveURI();
        $this->generateModuleName();
    }

    /**
     * Generate the name of the class the module should be
     */
    public function generateModuleName()
    {
        $parts = explode( '/', $this->uri );
        $module_name = array();
        foreach ( $parts as $part )
        {
            $module_name[] = ucfirst( $part );
        }
        $this->module_name = implode( '_', $module_name );
    }

    /**
     * Resolve the URI by returning a Page or a Module.
     */
    public function resolveURI()
    {

        $routes = \cerbo\kernel\Route::getRoutes();
        $config = \cerbo\kernel\Configuration::getConfiguration();

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

        // Look into routes for something to replace with

        if ( isset( $routes[$this->uri] ) )
        {

            // Look for a module to override
            if ( $routes[$this->uri]['module'] )
            {
                \cerbo\kernel\Debug::addNotice(
                    get_class(), 
                    "Module <b>$this->uri</b> is routed to <b>" . $routes[$this->uri]['module'] . "</b>"
                );
                $this->uri = $routes[$this->uri]['module']; // Change the module to load
            }

        }

    }

    public function getURI()
    {
        return $this->uri;
    }

    public function getModuleName()
    {
        return $this->module_name;
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
