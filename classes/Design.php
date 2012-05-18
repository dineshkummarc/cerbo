<?php

class Design
{

    public static function getFichier( $fichier )
    {

        // Charge les paramètres de configuration
        $config = Configuration::charger( 'application.ini' );

        // Extraction des tableaux des extensions et des designs
        $extensions = array_reverse( $config['EXTENSIONS']['ExtensionsActives'] );
        $designs = array_reverse( $config['DESIGN']['Utiliser'] );

        $prefixe = ( trim( $config['URL']['EnleverDuChemin'] ) != '' ) ? $config['URL']['EnleverDuChemin'] . '/' : '/' ;

        // Parcours des extensions
        foreach ( $designs as $design )
        {
            foreach ( $extensions as $extension )
            {
                //echo '<p>extensions/' . $extension . '/design/' . $design . '/' . $fichier . '</p>';
                if ( file_exists( 'extensions/' . $extension . '/design/' . $design . '/' . $fichier ) )
                {
                    return $prefixe . 'extensions/' . $extension . '/design/' . $design . '/' . $fichier;
                }
            }
        }

        // Si on n'a rien trouvé on regarde dans les designs à la racine
        foreach ( $designs as $design )
        {
            if ( file_exists( 'design/' . $design . '/' . $fichier ) )
            {
                return $prefixe . 'design/' . $design . '/' . $fichier;
            }
        }

        // On a rien trouvé donc on renvois null
        return null;

    }

}

?>
