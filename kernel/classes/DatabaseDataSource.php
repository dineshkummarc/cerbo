<?php

/**
 * File containing the data source dedicated to databases.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class DatabaseDataSource extends \cerbo\kernel\DataSource
{

    private $pdo_cnx = null;
    private $pdo_res = null;

    public function __construct( $parameters )
    {

        // Get the values from the parameters
        $driver     = $parameters['driver'];
        $database   = $parameters['database'];
        $host       = $parameters['host'];
        $username   = $parameters['username'];
        $password   = $parameters['password'];

        try
        {
            // Connect DB through PDO
            $cnx_string = $driver . ':dbname=' . $database . ';host=' . $host;
            $this->pdo_cnx = new \PDO( $cnx_string, $username, $password );
        }
        catch(PDOException $e)
        {
            $e->getMessage();
        }

    }

    private static function resolveParametersArray( $parameters, $current_operator = null )
    {

        $sql_string = '';
        $first = true;
        $current_operator = 'AND';

        foreach ( $parameters as $operator => $value )
        {

            // We are on a LOGICAL array
            if ( strtoupper( $operator ) == 'AND' || strtoupper( $operator ) == 'OR' )
            {
                $current_operator = strtoupper( $operator );
                // TODO Place parenthesis when there is more than 1 element in the subarray
                $sql_string .= ' ' . $current_operator . ' ( ';
                $sql_string .= \cerbo\kernel\DatabaseDataSource::resolveParametersArray( $value, $current_operator );
                $sql_string .= ' ) ';
            }
            else
            {

                $field = $operator; // Missnamed variable for this case

                switch ( $value[0] )
                {
                    case '=':
                        $sql_string .=  ' ' . ( ( $first ) ? '' : $current_operator ) . ' ' . $field . ' = \'' . $value[1] . '\' ';
                        break;
                }

                $first = false;

            }

        }

        return $sql_string;

    }

    public function select( $table, $parameters )
    {

        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . \cerbo\kernel\DatabaseDataSource::resolveParametersArray( $parameters );

        $this->pdo_res = $this->pdo_cnx->query( $sql );

        \cerbo\kernel\Debug::addDataSourceQuery( get_class(), $sql );

    }

    public function selectAll( $table )
    {

        $sql = 'SELECT * FROM ' . $table;

        $this->pdo_res = $this->pdo_cnx->query( $sql );

        \cerbo\kernel\Debug::addDataSourceQuery( get_class(), $sql );

    }

    public function remove( $table, $parameters )
    {

    }

    public function update( $table, $parameters )
    {

    }

    public function fetch( $line = null )
    {
        return $this->pdo_res->fetch( \PDO::FETCH_OBJ );
    }

    public function nbResults()
    {
        return $this->pdo_res->rowCount();
    }

}

?>
