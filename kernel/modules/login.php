<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Login extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/login' );
    }

    public function build()
    {
        $this->addTemplateVariable(
            'RedirectAfterLogin',
            $_POST['redirect_after_login']
        );
    }

    public function submited(){

        if ( isset( $_POST['login'] ) && isset( $_POST['password'] ) )
        {

            $login = $_POST['login'];
            $password = \cerbo\kernel\Security::crypt( $_POST['password'] );

            $ds = \cerbo\kernel\DataSource::getInstance();
            $ds->select(
                'users',
                array(
                        'login' => array( '=', $login),
                        'password' => array( '=', $password )
                )
            );

            if ( $ds->nbResults() > 0 )
            {

                $user_row = $ds->fetch();
                \cerbo\kernel\User::changeCurrentUser( $user_row->id );
                
                $session = \cerbo\kernel\Session::getSession();
                $session->setVariable( 'identified_user', $user_row->id );

                if ( isset( $_POST['redirect_after_login'] ) )
                {
                    $redirection = \cerbo\kernel\URL::makeCleanURL( $_POST['redirect_after_login'] );
                    header( 'Location:' . $redirection );
                }

            }
            else
            {
                $this->addTemplateVariable(
                    'ErrorMessage',
                    i18n::translate(
                        'kernel/login',
                        'A valid username and password is required to login.'
                    )
                );
            }

        }

    }

}

?>
