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
            'url_propre'    => new Twig_Filter_Method( $this, 'filtrerURL' ),
            'design'        => new Twig_Filter_Method( $this, 'filtrerDesign' ),
        );
    }

    // Méthodes écrites pour accéder aux données

    public function filtrerURL( $url )
    {
        return Page::creerURL( $url );
    }

    public function filtrerDesign( $fichier )
    {
        $uri = Design::getFichier( $fichier );
        return ( $uri != null ) ? $uri : 'ERREUR : Fichier non trouvé (' . $fichier . ')' ;
    }

}

?>
