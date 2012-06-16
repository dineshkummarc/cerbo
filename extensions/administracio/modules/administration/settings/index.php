<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Administration_Settings_Index extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/administration/settings/index' );
    }

    public function build(){}

    public function submited(){}

}

?>
