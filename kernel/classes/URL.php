<?php

/**
 * File containing the class to manage URLs.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class URL
{

    public static function makeCleanURL( $uri )
    {
        
        $config = \cerbo\kernel\Configuration::getConfiguration();

        if ( trim( $config['application.ini']['URL']['RemoveFromPath'] ) != '' )
        {
            return $config['application.ini']['URL']['RemoveFromPath'] . '/' . $uri;
        }

        return $uri;

    }

}

?>
