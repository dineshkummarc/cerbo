<?php

namespace cerbo\kernel;

class I18n
{

    private static $translations = null;

    /**
     * TODO Manage $params
     */
    public static function translate( $context, $string, $params = null )
    {

        if ( isset( \cerbo\kernel\I18n::$translations[$context][$string] ) )
        {
            $translation = \cerbo\kernel\I18n::$translations[$context][$string];
        }
        else
        {
            $translation = $string;
            // TODO Raise error
        }

        // TODO Manage parameters
        
        return $translation;

    }

    public static function load()
    {
        
        $config = \cerbo\kernel\Configuration::getConfiguration();
        $language = \cerbo\kernel\I18n::detectTranslation();

        // Loading base translation
        \cerbo\kernel\I18n::$translations = array();

        // Extract translations from the extensions
        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension )
        {

            $extension_file = \cerbo\kernel\Extension::getCorrectFilePath(
                $extension,
                'translations/' . $language . '.json'
            );

            if ( file_exists( $extension_file ) )
            {

                // Load the JSON file and happend it to the existing array

                $content = file_get_contents( $extension_file );
                $json = json_decode( $content, true );

                \cerbo\kernel\I18n::$translations = array_merge(
                    \cerbo\kernel\I18n::$translations,
                    $json
                );

            }

        }

    }

    public static function detectTranslation()
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        // TODO Check all those things by modifying my hosts

        // Try to detect language by HOST_NAME
        foreach ( $config['application.ini']['TRANSLATIONS']['TranslationsMap'] as $code => $hostname )
        {

            if ( $_SERVER['SERVER_NAME'] == $hostname )
            {
                return $code;
            }

        }

        // TODO Detect if the language code is given in the URL
        // Ex. : www.mywebsite.com/<language code>/my/web/page

        return $config['application.ini']['TRANSLATIONS']['DefaultTranslation'];

    }

}

?>
