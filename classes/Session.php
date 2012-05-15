<?php

/**
 * Gestion de la session et de tout ce qui peut se passer pendant l'execution d'une page.
 */
class Session
{

    /**
     * Démarre ou reprend la session.
     */
    function __construct()
    {

        session_start();

        if ( !isset( $_SESSION['login'] ) )
        {
            $this->initialiserSession();
        }

    }

    function __destruct()
    {
    }

    public static function terminer()
    {
        session_destroy();
        $_SESSION['login'] = 'anonymous';
        $_SESSION['name'] = 'Anonymous';
    }

    /**
     * Initialise la session avec des valeurs par défaut
     */
    function initialiserSession()
    {
        $_SESSION['login'] = 'anonymous';
    }

    public static function enregistrerUtilisateurCourant( Utilisateur $utilisateur )
    {

        $_SESSION['login'] = $utilisateur->getLogin();
        $_SESSION['nom'] = $utilisateur->getNomComplet();
        $_SESSION['id'] = $utilisateur->ID;

    }

    public static function estIdentifie()
    {
        return ( $_SESSION['login'] == 'anonymous' ) ? false : true ;
    }

}

?>
