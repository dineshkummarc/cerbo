<?php

/**
 * File containing all you should need to translate contents in modules
 * and templates.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

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
            \cerbo\kernel\Debug::addWarning(
                get_class(),
                "Can't find translation for <b>$string</b> using the following context : <b>$context</b>."
            );
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

                if ( $json != null )
                {
                    \cerbo\kernel\I18n::$translations = array_merge(
                        \cerbo\kernel\I18n::$translations,
                        $json
                    );
                }
                else
                {
                    // TODO Raise an error
                }

            }

        }

    }

    public static function detectTranslation()
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        // TODO Check all those things by modifying my hosts

        // Try to detect language by HOST_NAME
        if ( isset( $config['application.ini']['TRANSLATIONS']['TranslationsMap'] ) )
        {
            foreach ( $config['application.ini']['TRANSLATIONS']['TranslationsMap'] as $code => $hostname )
            {

                if ( $_SERVER['SERVER_NAME'] == $hostname )
                {
                    return $code;
                }

            }
        }

        // TODO Detect if the language code is given in the URL
        // Ex. : www.mywebsite.com/<language code>/my/web/page

        return $config['application.ini']['TRANSLATIONS']['DefaultTranslation'];

    }

}

?>
