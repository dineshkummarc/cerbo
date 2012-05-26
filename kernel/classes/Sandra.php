<?php

namespace sandra\kernel;

class Sandra
{

    private $request;
    private $twig;
    private $content;

    public function __construct()
    {
        $this->request = new \sandra\kernel\Request();
        $this->twig = null;
    }

    public function render()
    {
        
        if ( \sandra\kernel\ModuleHandler::isModule( $this->request->getURI() ) )
        {
            $content_handler = new \sandra\kernel\ModuleHandler( $this->request->getURI() );
        }
        else
        {
            $content_handler = new \sandra\kernel\PageHandler( $this->request->getURI() );
        }

        $content_handler->getContent()->build();

        echo "<p>Content : ";
        print_r( $content_handler );
        echo "</p>";


    }

}

?>
