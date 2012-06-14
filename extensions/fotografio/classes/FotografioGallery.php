<?php

class FotografioGallery
{

    public static function getPictures( $folder = '' )
    {
        return FotografioGallery::scanFolder( $folder );
    }

    public static function scanFolder( $folder )
    {

        $root = 'extensions/fotografio/data';
        $full_path = $root . $folder;
        $inner_files = scandir( $full_path );

        $files = array();
        foreach ( $inner_files as $file )
        {
            if ( $file != '.' && $file != '..' )
            {
                if ( is_dir( $root . $folder . '/' . $file ) )
                {
                    // Scan folders recursively
                    $files = array_merge( $files, FotografioGallery::scanFolder( $folder . '/' . $file ) );
                }
                else
                {
                    $files[] = $root . $folder . '/' . $file;
                }
            }
        }

        return $files;

    }

}

?>
