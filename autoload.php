<?php

function __nina_autoload( $class_name )
{
    if ( file_exists( dirname( __FILE__ )."/classes/$class_name.php" ) )
    {
        require_once dirname( __FILE__ )."/classes/$class_name.php";
    }
    else
    {
        // On regarde dans les extensions
        $config = parse_ini_file( 'settings/application.ini', true );
        foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
        {
            if ( file_exists( dirname( __FILE__ )."/extensions/$extension/classes/$class_name.php" ) )
            {
                require_once dirname( __FILE__ )."/extensions/$extension/classes/$class_name.php";
            }
        }
    }
}

spl_autoload_register( '__nina_autoload' );

?>
