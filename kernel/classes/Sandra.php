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
        
        if ( \sandra\kernel\Module::isModule( $this->request->getURI() ) )
        {
            $content = new \sandra\kernel\Module( $this->request->getURI() );
        }
        else
        {
            $content = new \sandra\kernel\Page( $this->request->getURI() );
        }

    }

}

?>
