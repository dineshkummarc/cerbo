<?php

    $Securite->doit( 'IDENTIFIE', true );

    $Page->setTemplate( 'pages/accueil' );
    $Page->addVariable( 'nom', $_SESSION['login'] );

?>
