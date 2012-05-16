<?php

	require_once 'autoload.php';
    require_once 'lib/Twig/Autoloader.php'; 
    Twig_Autoloader::register();

    $config = parse_ini_file( 'settings/application.ini', true );

    // Définition des dossiers où se trouvent les templates
    $templates_folders = array();

    // Ajout des designs à la racine
    foreach ( $config['DESIGN']['Utiliser'] as $design )
    {
        if ( file_exists( 'design/' . $design . '/templates' ) )
        {
            $templates_folders[] = 'design/' . $design . '/templates';
        }
    }

    // Parcours des extensions actives pour les ajouter à l'application
    foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
    {
        foreach ( $config['DESIGN']['Utiliser'] as $design )
        {
            // Ajout des templates
            if ( file_exists( 'extensions/' . $extension . '/design/' . $design . '/templates' ) )
            {
                $templates_folders[] = 'extensions/' . $extension . '/design/' . $design . '/templates';
            }
        }
    }

    $loader = new Twig_Loader_Filesystem( array_reverse( $templates_folders ) );
    $twig = new Twig_Environment( $loader, array(
    //    'cache' => 'var/twig'
    ) );
    
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
