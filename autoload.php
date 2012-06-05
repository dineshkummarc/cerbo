<?php

// Try to load the cache file for autolads
if ( file_exists( 'var/kernel/autoload.php' ) )
{
    include_once 'var/kernel/autoload.php';
    foreach ( $_AUTOLOAD_ARRAY as $autoload_class )
    {
        include_once $autoload_class;
    }
}
else
{
    $_AUTOLOAD_ARRAY = array();
}

function __cerbo_autoload( $class_name )
{

    // First we need to know if it is a Twig class.
    // If it is one, we should not try to handle it (and test if file exists in a lot of places, wasting time)

    if ( substr( $class_name, 0, 4 ) != 'Twig' )
    {

        global $_AUTOLOAD_ARRAY;
        $found = null;  // This variable is here to store the path of the found file for the class

        // First we need to remove namespace from the name
        $clean_class_name = substr( $class_name, strrpos( $class_name, "\\" ) + 1 );

        // Now we look through kernel and extensions
        if ( file_exists( "kernel/classes/$clean_class_name.php" ) )
        {
            require_once "kernel/classes/$clean_class_name.php";
            $found = "kernel/classes/$clean_class_name.php";
        }
        elseif( file_exists( "kernel/datatypes/$clean_class_name.php" ) )
        {
            require_once "kernel/datatypes/$clean_class_names.php";
            $found = "kernel/datatypes/$clean_class_names.php";
        } 
        else
        {
            $config = \cerbo\kernel\Configuration::getConfiguration();
            foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
            {

                $class_path = \cerbo\kernel\Extension::getCorrectFilePath( $extension, "classes/$clean_class_name.php" );
                $datatype_path = \cerbo\kernel\Extension::getCorrectFilePath( $extension, "datatypes/$clean_class_name.php" );

                if ( file_exists( $class_path ) )
                {
                    require_once $class_path;
                    $found = $class_path;
                }
                elseif( file_exists( $datatype_path ) )
                {
                    require_once $datatype_path;
                    $found = $datatype_path;
                }

            }
        }

        if ( $found != null )
        {
            $_AUTOLOAD_ARRAY[] = $found;
            addToAutoloadCacheFile();
        }

    }

}

function addToAutoloadCacheFile()
{

    global $_AUTOLOAD_ARRAY;    // Should it be a global variable ?

    $code = "<?php\n\n";

    $code .= "\$_AUTOLOAD_ARRAY = array();\n";
    foreach ( $_AUTOLOAD_ARRAY as $autoload_class )
    {
        $code .= '$_AUTOLOAD_ARRAY[] = \'' . $autoload_class . "';\n";
    }
    
    $code .= "\n?>";

    file_put_contents( 'var/kernel/autoload.php', $code );

}

spl_autoload_register( '__cerbo_autoload' );

?>
