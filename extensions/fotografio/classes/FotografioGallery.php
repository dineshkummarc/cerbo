<?php

class FotografioGallery
{

    public static function getPictures( $folder = '', $recursive = false )
    {
        return FotografioGallery::scanFolder( $folder, $recursive );
    }

    public static function scanFolder( $folder, $recursive )
    {

        $root = 'extensions/fotografio/data';
        $full_path = $root . $folder;
        $inner_files = scandir( $full_path );

        $files = array();
        foreach ( $inner_files as $file )
        {
            if ( $file != '.' && $file != '..' )
            {
                if ( is_dir( $root . $folder . '/' . $file ) && $recursive )
                {
                    // Scan folders recursively
                    $files = array_merge( $files, FotografioGallery::scanFolder( $folder . '/' . $file ), true );
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
