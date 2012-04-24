<?php

function __nina_autoload( $class_name )
{
    if ( file_exists( dirname( __FILE__ )."/classes/$class_name.php" ) )
        require_once dirname( __FILE__ )."/classes/$class_name.php";
    //else
    //	die( "ERREUR FATALE : Impossible de charger la classe <pre>$class_name</pre>" );
}

spl_autoload_register( '__nina_autoload' );

?>
