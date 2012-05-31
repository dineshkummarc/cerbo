<?php

function __sandra_autoload( $class_name )
{

    // First we need to remove namespace from the name
    $clean_class_name = substr( $class_name, strrpos( $class_name, "\\" ) + 1 );

    if ( file_exists( dirname( __FILE__ )."/kernel/classes/$clean_class_name.php" ) )
    {
        require_once dirname( __FILE__ )."/kernel/classes/$clean_class_name.php";
    }
    elseif( file_exists( dirname( __FILE__ )."/kernel/datatypes/$clean_class_name.php" ) )
    {
        require_once dirname( __FILE__ )."/kernel/datatypes/$clean_class_names.php";
    } 
    else
    {
        $config = \sandra\kernel\Configuration::getConfiguration();
        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {

            $class_path = \sandra\kernel\Extension::getCorrectFilePath( $extension, "classes/$clean_class_name.php" );
            $datatype_path = \sandra\kernel\Extension::getCorrectFilePath( $extension, "datatypes/$clean_class_name.php" );

            if ( file_exists( $class_path ) )
            {
                require_once $class_path;
            }
            elseif( file_exists( $datatype_path ) )
            {
                require_once $datatype_path;
            }

        }
    }
}

spl_autoload_register( '__sandra_autoload' );

?>
