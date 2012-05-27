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
        $this->addToDataMap( 'title', 'Home' );
        $this->addToDataMap( 'body', 'Welcome my dear.' );

    }

    public function submited(){}

}

?>
