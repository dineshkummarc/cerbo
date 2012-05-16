<?php

class TwigPhototheque extends Twig_Extension
{
    
    public function getName()
    {
        return 'TwigPhototheque';
    }

    public function getGlobals()
    {
        return array();
    }

    public function getFunctions()
    {
        return array(
            'phototheque_get_dossiers' => new Twig_Function_Method($this, 'getDossiers' )
        );
    }

    public function getFilters()
    {
        return array();
    }

    // Méthodes écrites pour accéder aux données

    public function getDossiers()
    {
        return Galerie::getDossiers();
    }

}

?>
