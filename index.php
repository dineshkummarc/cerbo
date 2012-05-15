<?php

	require_once 'autoload.php';
    require_once 'lib/Twig/Autoloader.php';

    Twig_Autoloader::register();

    // Définition des dossiers où se trouvent les templates
    $templates_folders = array( 'templates' );
    $config = parse_ini_file( 'settings/application.ini', true );
    foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
    {
        $templates_folders[] = 'extensions/'.$extension.'/templates';
    }

    $loader = new Twig_Loader_Filesystem( $templates_folders );
    $twig = new Twig_Environment( $loader, array(
    //    'cache' => 'var/twig'
    ) );

	$session = new Session();

	// Création de la page.
	$page = new Page();
    $page->render( $twig );

?>
