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

        if ( isset( $_POST['redirect_after_logout'] ) )
        {
            $redirection = \cerbo\kernel\URL::makeCleanURL( $_POST['redirect_after_logout'] );
            header( 'Location:' . $redirection );
        }

    }

    public function submited(){}

}

?>
