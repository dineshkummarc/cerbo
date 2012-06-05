<?php

namespace cerbo\kernel;

/**
 * All the modules have to extend from this class !
 */
class ModuleHandler extends \cerbo\kernel\ContentHandler
{

    private $uri;
    private $module_path;
    private $module_instance;

    public function __construct( $uri )
    {

        $this->uri = $uri;
        $this->module_path = null;
        $this->detectModulePath( $uri );

        // Load the file
        include $this->module_path;

        // Load instance of the module
        $module_class_name = '\\cerbo\\modules\\' . ucfirst( $this->uri );
        $this->module_instance = new $module_class_name();

    }

    public function getContent()
    {
        return $this->module_instance;
    }

    private function detectModulePath( $uri )
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();
        $found  = false;

        if ( file_exists( 'kernel/modules/' . $uri . '.php' ) )
        {
            $this->module_path = 'kernel/modules/' . $uri . '.php';
            $found = true;
        }

        if ( !$found )
        {

            foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
            {
                if ( \cerbo\kernel\Extension::haveModule( $extension, $uri ) )
                {
                    $this->module_path = \cerbo\kernel\Extension::getModulePath();
                    $found = true;
                }
            }

        }

        // We end here because we already have checked if it is a standard module
        // or an extension module.

    }

    public static function isModule( $uri )
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        // First, check in kernel modules
        if ( file_exists( 'kernel/modules/' . $uri . '.php' ) )
        {
            return true;
        }

        // Check through extensions
        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            if ( \cerbo\kernel\Extension::haveModule( $extension, $uri ) )
            {
                return true;
            }
        }
        
        return false;

    }

}

?>
