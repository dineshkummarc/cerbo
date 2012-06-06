<?php

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

    // Methods called ===============================================
    
    public function cerboInformations()
    {
        return \cerbo\kernel\Cerbo::getApplicationInformations();
    }

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

        $config = \cerbo\kernel\Configuration::getConfiguration();

        if ( trim( $config['application.ini']['URL']['RemoveFromPath'] ) != '' )
        {
            return $config['application.ini']['URL']['RemoveFromPath'] . '/' . $uri;
        }

        return $uri;

    }

}

?>
