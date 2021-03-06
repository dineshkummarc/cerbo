<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Fotografio_Index extends \cerbo\kernel\Module
{

    public function __construct()
    {
        $this->setTemplate( 'modules/fotografio/index' );
    }

    public function build()
    {

        $pictures = \FotografioGallery::getPictures();
        $this->addTemplateVariable( 'Pictures', $pictures );

    }

    public function submited(){}

}

?>
