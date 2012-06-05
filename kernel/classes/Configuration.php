<?php

namespace cerbo\kernel;

class Configuration
{

    private static $config = null;

    public static function getConfiguration()
    {

        if ( \cerbo\kernel\Configuration::$config == null )
        {
            \cerbo\kernel\Configuration::load();
        }

        return \cerbo\kernel\Configuration::$config;

    }

    public static function load()
    {

        $config = array();

        // Load basic configuration files
        $handler = opendir( 'settings' );
        while ( ( $dir = readdir( $handler ) ) != null )
        {
            if ( !is_dir( $dir ) && $dir != '.' && $dir != '..' )
            {
                $config[$dir] = parse_ini_file( 'settings/' . $dir, true );
            }
        }
        closedir( $handler );

        // Load configuration files from extensions and merge their data with the basics.
        
        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {
            foreach ( $config as $file => $values )
            {
                if ( file_exists( 'extensions/' . $extension . '/settings/' . $file ) )
                {
                    $config[$file] = array_merge(
                        $config[$file],
                        parse_ini_file( 'extensions/' . $extension . '/settings/' . $file )
                    );
                }
            }
        }

        \cerbo\kernel\Configuration::$config = $config;

    }

}

?>
