<?php

require_once "extensions/lesscss/lib/lessphp/lessc.inc.php";

class LessCSS
{

    public static function compile( $files )
    {

        if ( !is_array( $files ) )
        {
            $files = array( $files );
        }

        // TODO Check MD5 of files, compile and store it in DB
        // Should use :
        // try
        // {
        //      lessc::compile( 'input.less', 'output.css' );
        // }
        // catch ( exception $e )
        // {
        //      exit( 'lessc fatal error: <br/>' . $e->getMessage() );
        // }

    }

}

?>
