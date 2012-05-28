<?php

namespace sandra\modules;

use \sandra\kernel\I18n as i18n;

class Home extends \sandra\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/home' );
    }

    public function build()
    {

        // Add your module logic here
        $this->addToDataMap(
            'title', 
            i18n::translate( 'kernel/home', 'Home' )
        );

        $this->addToDataMap( 
            'body', 
            i18n::translate( 'kernel/home', 'Welcome my dear.' ) 
        );

    }

    public function submited(){}

}

?>
