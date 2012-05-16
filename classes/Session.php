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
            Session::initialiserSession();
        }

    }

    function __destruct()
    {
    }

    public static function terminer()
    {
        session_destroy();
        Session::initialiserSession();
    }

    /**
     * Initialise la session avec des valeurs par défaut
     */
    public static function initialiserSession()
    {
        $_SESSION['login']  = 'anonymous';
        $_SESSION['nom']    = 'Anonymous';
        $_SESSION['id']     = 2;
    }

    public static function estIdentifie()
    {
        return ( $_SESSION['login'] == 'anonymous' ) ? false : true ;
    }

}

?>
