<?php

/**
 * File containing the class to manage routes.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class Route
{

    private static $routes = array();

    public static function getRoutes()
    {
        return \cerbo\kernel\Route::$routes;
    }

    public static function load()
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        // Load default routes
        if ( file_exists( 'settings/routes.json' ) )
        {

            $content = file_get_contents( 'settings/routes.json' );
            $json = json_decode( $content, true );

            if ( $json != null )
            {
                \cerbo\kernel\Route::$routes = array_merge(
                    \cerbo\kernel\Route::$route,
                    $json
                );
            }

        }

        // Get routes from extensions
        foreach ( $config['application.ini']['EXTENSIONS']['Use'] as $extension)
        {
            $file_path = 'extensions/' . $extension . '/settings/routes.json';
            if ( file_exists( $file_path ) )
            {

                $content = file_get_contents( $file_path );
                $json = json_decode( $content, true );

                if ( $json != null )
                {
                    \cerbo\kernel\Route::$routes = array_merge(
                        \cerbo\kernel\Route::$routes,
                        $json
                    );
                }

            }
        }

    }

}

?>
