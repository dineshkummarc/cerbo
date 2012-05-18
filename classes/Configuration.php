<?php

class Configuration
{

    public static function charger( $fichier )
    {

        // Chargement du fichier de configuration maitre
        // (pour savoir quels fichiers INI charger)
        $base_conf = parse_ini_file( 'settings/application.ini', true );

        $config = array();

        if ( file_exists( 'settings/' . $fichier ) )
        {
            $config = array_merge(
                $config,
                parse_ini_file( 'settings/' . $fichier, true )
            );
        }

        foreach ( $base_conf['EXTENSIONS']['ExtensionsActives'] as $extension )
        {
            if ( file_exists( 'extensions/' . $extension . '/settings/' . $fichier ) )
            {
                $config = array_merge(
                    $config,
                    parse_ini_file( 'extensions/' . $extension . '/settings/' . $fichier, true )
                );
            }
        }

        return $config;

    }

}

?>
