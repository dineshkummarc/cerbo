<?php

/**
 * File containing the class to manage, load and fetch data from designs.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class Design
{
    
    public static function getDesignFolders()
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        $list = array();

        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            foreach ( $config['application.ini']['DESIGN']['Use'] as $design )
            {

                // Get the correct folder (folders are managed like file for this)
                $path = \cerbo\kernel\Extension::getCorrectFilePath(  
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

    /**
     * TODO This method should cache the results
     */
    public static function getDesignFile( $file )
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            foreach ( $config['application.ini']['DESIGN']['Use'] as $design )
            {
                $path = \cerbo\kernel\Extension::getCorrectFilePath(
                    $extension, 'design/' . $design . '/' . $file
                );
                if ( file_exists( $path ) )
                {
                    return $path;
                }
            }
        }

        // Not found
        // TODO Raise an error
        return $file . '#Failed';

    }

}

?>
