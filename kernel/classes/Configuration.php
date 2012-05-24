<?php

namespace sandra\kernel;

class Configuration
{

    /**
     * Load all the available configuration files and store them
     * in the global variable $_CONFIGURATION. It is an indexed
     * array where the key is the name of the configuration file.
     */
    public static function load()
    {

        // $_CONFIGURATION is set as a global variable to avoid reloading them.
        global $_CONFIGURATION;

        // Load basic configuration files
        $handler = opendir( 'settings' );
        while ( ( $dir = readdir( $handler ) ) != null )
        {
            if ( !is_dir( $dir ) && $dir != '.' && $dir != '..' )
            {
                $_CONFIGURATION[$dir] = parse_ini_file( 'settings/' . $dir, true );
            }
        }
        closedir( $handler );

        // Load configuration files from extensions and merge their data with the basics.
        
        foreach ( $_CONFIGURATION['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            foreach ( $_CONFIGURATION as $file => $values )
            {
                if ( file_exists( 'extensions/' . $extension . '/settings/' . $file ) )
                {
                    $_CONFIGURATION[$file] = array_merge(
                        $_CONFIGURATION[$file],
                        parse_ini_file( 'extensions/' . $extension . '/settings/' . $file )
                    );
                }
            }
        }

        return $_CONFIGURATION;

    }

}

?>
