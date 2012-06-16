<?php

/**
 * File containing the description of a module.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

/**
 * All the modules have to extend from this class !
 */
abstract class Module extends Content
{
    public function alterFromRoutes( $uri )
    {
        $routes = \cerbo\kernel\Route::getRoutes();
        if ( isset( $routes[$uri] ) )
        {

            if ( isset( $routes[$uri]['params'] ) )
            {
                // Alter $_POST variables
                foreach ( $routes[$uri]['params'] as $key => $value )
                {
                    $_POST[$key] = $value;
                }
            }

            if ( isset( $routes[$uri]['template'] ) )
            {
                \cerbo\kernel\Debug::addNotice(
                    get_class(),
                    'Route override <i>template</i> from <b>' . $this->getTemplate() . '</b> to <b>' . $routes[$uri]['template']  . '</b>.'
                );
                $this->setTemplate( $routes[$uri]['template'] );
            }

        }
    }
}

?>
