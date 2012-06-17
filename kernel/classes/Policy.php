<?php

namespace cerbo\kernel;

class Policy
{

    private static $available_policies = array();

    public static function loadPolicies()
    {
        
        $config = \cerbo\kernel\Configuration::getConfiguration();

        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {

            $about_file = 'extensions/' . $extension . '/about.json';
            if ( file_exists( $about_file ) )
            {

                $content = file_get_contents( $about_file );
                $json = json_decode( $content, true );

                if ( count( $json['rights'] ) > 0 )
                {

                    \cerbo\kernel\Policy::$available_policies = array_merge(
                        \cerbo\kernel\Policy::$available_policies,
                        array( $extension => $json['rights'] )
                    );

                }

            }

        }

    }

    public static function getPolicies()
    {
        return \cerbo\kernel\Policy::$available_policies;
    }

}

?>
