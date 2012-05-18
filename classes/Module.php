<?php

/**
 * Gestion du module
 */
class Module
{

    public $module;
    public $file;

    /**
     * Constructeur.
     *
     * Detecte quel module utiliser en se basant sur l'URI demandée au serveur.
     * Passe tous les éléments après un double slash en $_GET.
     */
    function __construct()
    {

        $query = $_SERVER['REQUEST_URI'];
        $config = Configuration::charger( 'application.ini' );

        // Suppression du début de l'URL (si besoins)
        if ( isset( $config['URL']['EnleverDuChemin'] ) && $config['URL']['EnleverDuChemin'] != '' )
        {
            if ( substr( $query, 0, strlen( $config['URL']['EnleverDuChemin'] ) ) == $config['URL']['EnleverDuChemin'] )
            {
                $query = substr( $query, strlen( $config['URL']['EnleverDuChemin'] ) );
            }
        }


        if ( substr( $query, 0, 1 ) == "/" )
            $query = substr( $query, 1 );

        // On fait le trie entre le module a afficher et les parametres passés
        $parties = explode( '//', $query );

        // On sauvegarde le module
        $query = $parties[0];

        // On sauvegarde les parametres dans le tableau de GET comme si tout était normale
        $_GET = array();
        if ( isset( $parties[1] ) )
        {
            foreach( explode( '/', $parties[1] ) as $arg )
            {
                $_GET['url_parameters'][] = urldecode( $arg );
            }
        }

        if ( $query == "" )
            $query = "accueil";

        $this->module = $query;
        $this->file = "$query.php";

    }

}

?>
