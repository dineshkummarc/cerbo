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

    // Methods called ===============================================
    
    public function cerboInformations()
    {
        return \cerbo\kernel\Cerbo::getApplicationInformations();
    }

}

?>
