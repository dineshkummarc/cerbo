<?php

class TwigNina extends Twig_Extension
{
    
    public function getName()
    {
        return 'TwigNina';
    }

    public function getFilters()
    {
        return array(
            'url_propre' => new Twig_Filter_Method( $this, 'filtrerURL' ),
        );
    }

    // Méthodes écrites pour accéder aux données

    public function filtrerURL( $url )
    {
        return Page::creerURL( $url );
    }

}

?>
