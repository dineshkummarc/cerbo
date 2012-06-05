<?php

namespace cerbo\kernel;

class Cerbo
{

    private $request;
    private $twig;
    private $content;

    public function __construct()
    {

        $this->request = new \cerbo\kernel\Request();
        $this->twig = null;

        \cerbo\kernel\Extension::load();
        \cerbo\kernel\I18n::load();

    }

    public function render()
    {
        
        if ( \cerbo\kernel\ModuleHandler::isModule( $this->request->getURI() ) )
        {
            $content_handler = new \cerbo\kernel\ModuleHandler( $this->request->getURI() );
        }
        else
        {
            $content_handler = new \cerbo\kernel\PageHandler( $this->request->getURI() );
        }

        // Run the code of the module / page before returning it
        $content_handler->getContent()->submited();
        $content_handler->getContent()->build();

        // Get the result of the content in the correct format
        if ( $this->request->getFormat() == "JSON" )
        {
            $result = $content_handler->getContent()->toJSON();
        }
        elseif( $this->request->getFormat() == "XML" )
        {
            $result = $content_handler->getContent()->toXML();
        }
        else
        {
            
            // Standard output to be well formed with a template

            // Load Twig
            require_once 'lib/Twig/Autoloader.php';
            \Twig_Autoloader::register();

            // Init twig
            $this->twig = new \Twig_Environment(

                new \Twig_Loader_Filesystem(
                    \cerbo\kernel\Design::getDesignFolders()
                ), 
                array(
                    //'cache' => 'var/cache/templates',
                )

            );

            // Render with Twig
            $result = $this->twig->render(
                $content_handler->getContent()->getTemplate(). '.twig' ,
                array( 'DataMap' => $content_handler->getContent()->getDataMap() )
            );

        }

        echo $result;

    }

}

?>
