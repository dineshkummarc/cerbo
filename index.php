<?php

	require_once 'autoload.php';
    require_once 'lib/twig/lib/Twig/Autoloader.php'; 
    Twig_Autoloader::register();

    $config = Configuration::charger( 'application.ini' );

	$session = new Session();
    Traduction::detecterLangue();

    Design::chargerAutomatiquement( $config );

    $loader = new Twig_Loader_Filesystem( array_reverse( Design::listerDossiersDeDesign( $config ) ) );
    $twig = new Twig_Environment( $loader, array(
    //    'cache' => 'var/twig'
    ) );
    
    Extension::charger( $config, $twig );

	// Création de la page.
	$page = new Page();
    $page->render( $twig );

?>
