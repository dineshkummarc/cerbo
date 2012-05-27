<?php

namespace sandra\modules;

class Error404 extends \sandra\kernel\Module
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
