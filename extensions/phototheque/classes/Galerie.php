<?php

class Galerie
{

    public static function getDossiers()
    {

        $dossiers = array();

        $handler = opendir( 'extensions/phototheque/data' );
        while ( $f = readdir( $handler ) )
        {
            if ( is_dir( 'extensions/phototheque/data/' . $f ) )
            {
                if ( $f != '.' && $f != '..' )
                {
                    $dossiers[] = $f;
                }
            }
        }
        closedir( $handler );
        
        return $dossiers;
    }

}

?>
