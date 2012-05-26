<?php

namespace sandra\modules;

class Home extends \sandra\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/home' );
    }

    public function build()
    {

        // Add your module logic here
        $this->addToDataMap( 'body', '<h1>Home</h1>' );

    }

    public function submited()
    {
        
        // Add your module logic here when a form is submited

    }

    public function toJSON()
    {

        // Add the JSON format export here
        
    }

    public function toXML()
    {
        
        // Add the XML format export here

    }

}

?>
