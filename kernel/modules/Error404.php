<?php

namespace cerbo\modules;

class Error404 extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/error404' );
    }

    public function build(){}

    public function submited(){}

}

?>
