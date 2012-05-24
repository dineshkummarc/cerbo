<?php

function __sandra_autoload( $class_name )
{

    // First we need to remove namespace from the name
    $clean_class_name = substr( $class_name, strrpos( $class_name, "\\" ) + 1 );

    if ( file_exists( dirname( __FILE__ )."/kernel/classes/$clean_class_name.php" ) )
    {
        require_once dirname( __FILE__ )."/kernel/classes/$clean_class_name.php";
    }
    else
    {
        /*
        // On regarde dans les extensions
        $config = Configuration::charger( 'application.ini' );
        foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
        {
            if ( file_exists( dirname( __FILE__ )."/extensions/$extension/classes/$clean_class_name.php" ) )
            {
                require_once dirname( __FILE__ )."/extensions/$extension/classes/$clean_class_name.php";
            }
        }
         */
    }
}

spl_autoload_register( '__sandra_autoload' );

?>
