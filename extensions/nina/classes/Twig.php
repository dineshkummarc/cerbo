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

    public function getFunctions()
    {
        return array(
            'design_autoload'   => new Twig_Function_Method($this, 'functionDesignAutoload' ),
        );
    }

    function getTokenParsers()
    {
        return array(
            new TwigNina_DesignNecessite_TokenParser()
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

    public function functionDesignAutoload()
    {

        global $_DESIGN;
        foreach ( $_DESIGN as $fichier )
        {

            $chemin = Design::getFichier( $fichier );

            if ( $chemin != null )
            {

                switch ( substr( $fichier, strrpos( $fichier, '.' ) ) )
                {

                    case '.less':
                        echo "<link rel=\"stylesheet/less\" type=\"text/css\" href=\"$chemin\" />\n";
                        break;
    
                    case '.css':
                        echo "<link type=\"text/css\" href=\"$chemin\" />\n";
                        break;

                    case '.js':
                        echo "<script type=\"text/javascript\" src=\"$chemin\"></script>\n";
                        break;
     
                }

            }

        }

    }

}

?>
