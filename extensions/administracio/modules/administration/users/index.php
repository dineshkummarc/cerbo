<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Administration_Users_Index extends \cerbo\kernel\Module
{

    public function __construct()
    {
        \cerbo\kernel\Security::needsPolicies( "administracio::login" );
        $this->setTemplate( 'modules/administration/users/index' );
    }

    public function build(){}

    public function submited(){}

}

?>
