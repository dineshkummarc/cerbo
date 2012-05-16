<?php

class Design
{

    public static function getFichier( $fichier )
    {

        // Charge les paramètres de configuration
        $config = parse_ini_file( 'settings/application.ini', true );

        // Extraction des tableaux des extensions et des designs
        $extensions = array_reverse( $config['DESIGN']['Utiliser'] );
        $designs = array_reverse( $config['DESIGN']['Utiliser'] );

        // Parcours des extensions
        foreach ( $designs as $design )
        {
            foreach ( $extensions as $extension )
            {
                if ( file_exists( 'extensions/' . $extension . '/design/' . $design . '/' . $fichier ) )
                {
                    return 'extensions/' . $extension . '/design/' . $design . '/' . $fichier;
                }
            }
        }

        // Si on n'a rien trouvé on regarde dans les designs à la racine
        foreach ( $designs as $design )
        {
            if ( file_exists( 'design/' . $design . '/' . $fichier ) )
            {
                return 'design/' . $design . '/' . $fichier;
            }
        }

        // On a rien trouvé donc on renvois null
        return null;

    }

}

?>
