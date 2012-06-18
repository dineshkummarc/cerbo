<?php

namespace cerbo\modules;

class Error403 extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/error403' );
    }

    public function build(){}

    public function submited(){}

}

?>
