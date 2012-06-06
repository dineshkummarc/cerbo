<?php

namespace cerbo\kernel;

class Extension
{

    private $is_phar;
    private static $twig_extensions;

    public function __construct( $name )
    {

        // Check what is the kind of extension ( folder or PHAR )
        if ( \cerbo\kernel\Extension::isPHAR( $name ) )
        {
            $this->is_phar = true;
        }
        else
        {
            $this->is_phar = false;
        }

    }

    /**
     * Look for all the Twig extensions in extensions and store them in an internal
     * array, ready to be used when we will use Twig.
     * TODO We will probably use this method too to handle some custom behaviours
     * with hooks.
     */
    public static function load()
    {

        \cerbo\kernel\Extension::$twig_extensions = array();
        $config = \cerbo\kernel\Configuration::getConfiguration();

        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {

            if ( \cerbo\kernel\Extension::isPHAR( $extension ) )
            {
                $file_path = 'phar://extensions/' . $extension . '/classes/Twig.php';
                if ( file_exists( $file_path ) )
                {
                    \cerbo\kernel\Extension::$twig_extensions[] = $file_path;
                }
            }
            else
            {
                $file_path = 'extensions/' . $extension . '/classes/Twig.php';
                if ( file_exists( 'extensions/' . $extension . '/classes/Twig.php' ) )
                {
                    \cerbo\kernel\Extension::$twig_extensions[$extension] = $file_path;
                }
            }

        }

    }

    /**
     * Access the list of all the Twig extensions available.
     */
    public static function getTwigExtensionsArray()
    {
        return \cerbo\kernel\Extension::$twig_extensions;
    }

    /**
     * Check if an extensin have a Module or not.
     */
    public static function haveModule( $extension, $module )
    {

        if ( \cerbo\kernel\Extension::isPHAR( $extension ) )
        {
            $extension_path = 'phar://extensions/' . $extension . '.phar';
        }
        else
        {
            $extension_path = 'extensions/' . $extension;
        }

        if ( file_exists( $extension_path . '/modules/' . $module . '.php' ) )
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public static function getModulePath( $extension, $module )
    {

        if ( \cerbo\kernel\Extension::isPHAR( $extension ) )
        {
            $extension_path = 'phar://extensions/' . $extension . '.phar';
        }
        else
        {
            $extension_path = 'extensions/' . $extension;
        }

        return $extension_path . '/modules/' . $module . '.php';

    }

    /**
     * Check if the extension is a PHAR or not.
     */
    public static function isPHAR( $name )
    {
        if ( file_exists( 'extensions/' . $name . '.phar' ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Test if an extension exists or not.
     */
    public static function exists( $name )
    {
        // Check for foler or PHAR
        if ( 
            file_exists( 'extensions/' . $name )
            || file_exists( 'extensions/' . $name . '.phar' ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function getCorrectFilePath( $extension, $file )
    {

        if ( \cerbo\kernel\Extension::isPHAR( $extension ) )
        {
            return 'phar://extensions/' . $extension . '.phar/' . $file;
        }

        return 'extensions/' . $extension . '/' . $file;

    }

}

?>
