<?php

/**
 * File containing the base class for data sources.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

abstract class DataSource
{

    private static $db_pointer = null;

    abstract protected function __construct( $parameters );
    abstract protected function select( $table, $parameters );
    abstract protected function remove( $table, $parameters );
    abstract protected function update( $table, $parameters );
    abstract protected function fetch( $line = null );

    public static function getInstance()
    {

        $config = \cerbo\kernel\Configuration::getConfiguration();

        // Initialize DataSource connection if it doesn't exists.
        if ( \cerbo\kernel\DataSource::$db_pointer == null )
        {

            $handler = $config['application.ini']['DATABASE']['DataSourceHandler'];
            $parameters = $config['application.ini']['DATABASE']['Connection'];

            $class = '\\cerbo\\kernel\\' . $handler;
            \cerbo\kernel\DataSource::$db_pointer = new $class( $parameters );

        }

        return \cerbo\kernel\DataSource::$db_pointer;

    }

}

?>
