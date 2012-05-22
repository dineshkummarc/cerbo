<?php

/**
 * Gestion des extensions.
 */
class Extension
{

    /**
     * Charge et enregistre toutes les extensions déclarées dans application.ini
     * au sein de Twig.
     * @param $config Le fichier de configuration (application.ini) au format Array.
     * @param $twig L'instance de Twig.
     */
    public static function charger( $config, $twig )
    {
        // Parcours des extensions actives pour les ajouter à l'application
        foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
        {
            // Ajout des extensions de Twig
            if ( file_exists( 'extensions/'.$extension.'/classes/Twig.php' ) )
            {
                // Chargement du fichier PHP
                require_once 'extensions/'.$extension.'/classes/Twig.php';
                // Ajout de l'extension dans Twig
                $twig_extension = 'Twig' . ucfirst( $extension );
                $twig->addExtension( new $twig_extension() );
            }
        }
    }

}

?>
