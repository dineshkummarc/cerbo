<?php

namespace cerbo\modules;

class Error404 extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/error' );
    }

    public function build()
    {

        // Add your module logic here
        $this->addToDataMap( 'title', 'Error 404' );
        $this->addToDataMap( 'body', 'Page not found.' );

    }

    public function submited(){}

}

?>
