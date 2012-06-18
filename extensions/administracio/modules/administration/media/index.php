<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Administration_Media_Index extends \cerbo\kernel\Module
{

    public function __construct()
    {
        \cerbo\kernel\Security::needsPolicies( "administracio::login" );
        $this->setTemplate( 'modules/administration/media/index' );
    }

    public function build(){}

    public function submited(){}

}

?>
