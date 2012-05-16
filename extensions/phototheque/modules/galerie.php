<?php

    // Définition des droits nécessaires
    $Securite->doit( 'IDENTIFIE', true );

    // Définition du template à utiliser
    $Page->setTemplate( 'pages/galerie' );

    // Chargement des paramètres d'URL
    $galerie = isset( $_GET['url_parameters'][0] ) ? $_GET['url_parameters'][0] : 'Toutes les photos' ;
    $pagination = isset( $_GET['url_parameters'][1] ) ? $_GET['url_parameters'][1] : 1 ;
    $afficher_dossiers = isset( $_GET['url_parameters'][0] ) ? false : true ;

    // Passage des variables au template
    $Page->addVariable( 'galerie', $galerie );
    $Page->addVariable( 'page', $pagination );
    $Page->addVariable( 'afficher_dossiers', $afficher_dossiers );

?>
