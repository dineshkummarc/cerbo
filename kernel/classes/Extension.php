<?php

namespace sandra\kernel;

class Extension
{

    private $is_phar;

    public function __construct( $name )
    {

        // Check what is the kind of extension ( folder or PHAR )
        if ( \sandra\kernel\Extension::isPHAR( $name ) )
        {
            $this->is_phar = true;
        }
        else
        {
            $this->is_phar = false;
        }

    }

    /**
     * Check if an extensin have a Module or not.
     */
    public static function haveModule( $extension, $module )
    {

        if ( \sandra\kernel\Extension::isPHAR( $extension ) )
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

        if ( \sandra\kernel\Extension::isPHAR( $extension ) )
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

        if ( \sandra\kernel\Extension::isPHAR( $extension ) )
        {
            return 'phar://extensions/' . $extension . '/' . $file;
        }

        return 'extensions/' . $extension . '/' . $file;

    }

}

?>
