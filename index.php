<?php

	require_once 'autoload.php';
    require_once 'lib/twig/Autoloader.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem( 'templates' );
    $twig = new Twig_Environment( $loader, array(
        'cache' => 'var/twig'
    ) );

	$bdd = new BDD();
	$session = new Session();

	// Création de la page.
	$page = new Page();
    $page->render( $twig );

?>
