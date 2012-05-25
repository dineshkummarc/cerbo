<?php

namespace sandra\kernel;

/**
 * All the modules have to extend from this class !
 */
class ModuleHandler
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
        $module_class_name = '\\sandra\\modules\\' . ucfirst( $this->uri );
        $this->module_instance = new $module_class_name();

    }

    public function detectModulePath( $uri )
    {

        global $_CONFIGURATION;
        $found  = false;

        if ( file_exists( 'kernel/modules/' . $uri . '.php' ) )
        {
            $this->module_path = 'kernel/modules/' . $uri . '.php';
            $found = true;
        }

        if ( !$found )
        {

            foreach ( $_CONFIGURATION['application.ini']['EXTENSIONS']['Use'] as $extension )
            {
                if ( \sandra\kernel\Extension::haveModule( $extension, $uri ) )
                {
                    $this->module_path = \sandra\kernel\Extension::getModulePath();
                    $found = true;
                }
            }

        }

        // We end here because we already have checked if it is a standard module
        // or an extension module.

    }

    public function isModule( $uri )
    {

        global $_CONFIGURATION;

        // First, check in kernel modules
        if ( file_exists( 'kernel/modules/' . $uri . '.php' ) )
        {
            return true;
        }

        // Check through extensions
        foreach ( $_CONFIGURATION['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            if ( \sandra\kernel\Extension::haveModule( $extension, $uri ) )
            {
                return true;
            }
        }
        
        return false;
    }

}

interface ModuleInterface
{

    public function run();
    public function submited();
    public function toJSON();
    public function toXML();

}

?>
