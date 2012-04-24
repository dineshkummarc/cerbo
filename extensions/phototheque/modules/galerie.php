<?php

    $Page->setTemplate( 'pages/galerie' );

    $galerie = isset( $_GET['url_parameters'][0] ) ? $_GET['url_parameters'][0] : 'Toutes les photos' ;

    $Page->addVariable( 'galerie', $galerie );

?>
