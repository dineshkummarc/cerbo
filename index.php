<?php

	require_once 'autoload.php';
    require_once 'lib/Twig/Autoloader.php'; Twig_Autoloader::register();
    require_once 'classes/Twig.php';

    $config = parse_ini_file( 'settings/application.ini', true );

    // Définition des dossiers où se trouvent les templates
    $templates_folders = array( 'templates' );

    // Parcours des extensions actives pour les ajouter à l'application
    foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
    {
        // Ajout des templates
        if ( file_exists( 'extensions/'.$extension.'/templates' ) )
        {
            $templates_folders[] = 'extensions/'.$extension.'/templates';
        }
    }

    $loader = new Twig_Loader_Filesystem( $templates_folders );
    $twig = new Twig_Environment( $loader, array(
    //    'cache' => 'var/twig'
    ) );
    
    // Ajout de l'extension Twig de base
    $twig->addExtension( new TwigNina() );
    // Parcours des extensions actives pour les ajouter à l'application
    foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
    {
        // Ajout des extensions de Twig
        if ( file_exists( 'extensions/'.$extension.'/classes/Twig.php' ) )
        {
            // Chargement du fichier PHP
            require_once 'extensions/'.$extension.'/classes/Twig.php';
            // Ajout de l'extension dans Twig
            $twig_extension = 'Twig' . ucfirst( $extension );
            $twig->addExtension( new $twig_extension() );
        }
    }

	$session = new Session();

	// Création de la page.
	$page = new Page();
    $page->render( $twig );

?>
