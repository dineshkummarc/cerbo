<?php

namespace sandra\kernel;

class Design
{
    
    public static function getDesignFolders()
    {

        global $_CONFIGURATION;

        $list = array();

        foreach ( $_CONFIGURATION['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            foreach ( $_CONFIGURATION['application.ini']['DESIGN']['Use'] as $design )
            {

                // Get the correct folder (folders are managed like file for this)
                $path = \sandra\kernel\Extension::getCorrectFilePath(  
                    $extension, 'design/' . $design . '/templates'
                );

                if ( file_exists( $path ) )
                {
                    $list[] = $path;
                }
            }
        }

        return $list;

    }

}

?>
