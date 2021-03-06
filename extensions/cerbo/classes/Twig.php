<?php

require_once 'extensions/cerbo/classes/TwigCerbo_DesignNeeds_TokenParser.php';

class TwigCerbo extends Twig_Extension
{
    
    public function getName()
    {
        return 'TwigCerbo';
    }

    public function getFunctions()
    {
        return array(

            'cerbo_informations' => new Twig_Function_Method( $this, 'cerboInformations' ),

            'autoload_design_files' => new Twig_Function_Method( $this, 'autoloadDesignFiles' ),
            'debug_output' => new Twig_Function_Method( $this, 'debugOutput' ),

        );
    }

    public function getFilters()
    {
        return array(
        
            'i18n' => new Twig_Filter_Method( $this, 'i18n' ),
            'design' => new Twig_Filter_Method( $this, 'design' ),
            'url' => new Twig_Filter_Method( $this, 'url' )

        );
    }

    public function getTokenParsers()
    {
        return array(
            new \TwigCerbo_DesignNeeds_TokenParser()
        );
    }

    // Methods called ===============================================

    // Functions ----------------------------------------------------

    public function cerboInformations()
    {
        return \cerbo\kernel\Cerbo::getApplicationInformations();
    }

    public function autoloadDesignFiles()
    {
        echo \cerbo\kernel\Design::getAutoloadFilesHTML();
    }

    public function debugOutput()
    {
        echo \cerbo\kernel\Debug::getDebugHTML();
    }


    // Filters ------------------------------------------------------

    public function i18n( $text, $context, $params = null )
    {
        return \cerbo\kernel\I18n::translate( $context, $text, $params );
    }

    public function design( $file )
    {
        return \cerbo\kernel\Design::getDesignFile( $file );
    }

    public function url( $uri )
    {
        return \cerbo\kernel\URL::makeCleanURL( $uri );
    }

}

?>
