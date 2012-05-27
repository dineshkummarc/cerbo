<?php

namespace sandra\kernel;

class Design
{
    
    public static function getDesignFolders()
    {

        $config = \sandra\kernel\Configuration::getConfiguration();

        $list = array();

        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            foreach ( $config['application.ini']['DESIGN']['Use'] as $design )
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
