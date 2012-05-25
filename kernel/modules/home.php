<?php

namespace sandra\modules;

class Home extends \sandra\kernel\Module implements \sandra\kernel\ModuleInterface
{

    public function __construct()
    {
        $this->setTemplate( 'modules/home' );
    }

    public function run()
    {

        // Add your module logic here

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
