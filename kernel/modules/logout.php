<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Logout extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/logout' );
    }

    public function build()
    {
        $session = \cerbo\kernel\Session::getSession();
        $session->end();
    }

    public function submited(){}

}

?>
