<?php

    // Définition du template à utiliser
    $Page->setTemplate( 'pages/galerie' );

    // Chargement des paramètres d'URL
    $galerie = isset( $_GET['url_parameters'][0] ) ? $_GET['url_parameters'][0] : 'Toutes les photos' ;
    $pagination = isset( $_GET['url_parameters'][1] ) ? $_GET['url_parameters'][1] : 1 ;

    // Passage des variables au template
    $Page->addVariable( 'galerie', $galerie );
    $Page->addVariable( 'page', $pagination );

?>
