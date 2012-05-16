<?php

    $Page->setTemplate( "pages/login" );

    if ( isset( $_POST['login'] ) && isset( $_POST['password'] ) )
    {

        $bdd = DataSource::getInstance();

        $login      = mysql_real_escape_string( $_POST['login'] );
        $password   = mysql_real_escape_string( $_POST['password'] );

        // Execution de la requête
        $res = $bdd->select( 'utilisateurs', array(
            array( 'login', '=', $login ),
            array( 'password', '=', $password )
        ) );

        // Vérification des paramètres de connection
        if ( count( $res ) == 1 )
        {
            // Identification réussie
            // TODO Chargement des informations
            // $utilisateur = mysql_fetch_object( $res );
            // $_SESSION['login'] = $utilisateur->login;
        }
        else
        {
            // Affichage d'un message d'erreur
            $Page->addVariable(
                'erreur',
                'Impossible de vous identifier avec ce couple login / mot de passe.'
            );
        }
    }

?>
