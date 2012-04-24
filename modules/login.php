<?php

    $Page->setTemplate( "pages/login" );

    if ( isset( $_POST['login'] ) && isset( $_POST['password'] ) )
    {

        $login      = mysql_real_escape_string( $_POST['login'] );
        $password   = mysql_real_escape_string( $_POST['password'] );

        // Vérification des identifiants et login
        $sql = "    SELECT * 
                    FROM utilisateurs 
                    WHERE login = '$login'
                        AND motdepasse '$password'";

        $res = Session::requeteSQL( $sql );

        if ( count( $res ) == 1 )
        {
            // Identification réussie
            // TODO Chargement des informations
        }
        else
        {
            $Page->addVariable( 'erreur', 'Impossible de vous identifier avec ce couple login / mot de passe.' );
        }
    }

?>
