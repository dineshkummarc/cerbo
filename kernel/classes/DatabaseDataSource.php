<?php

namespace cerbo\kernel;

class DatabaseDataSource extends \cerbo\kernel\DataSource
{

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
            $db = new \PDO( $cnx_string, $username, $password );
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
        echo "<p>$sql</p>";

    }

    public function remove( $table, $parameters )
    {

    }

    public function update( $table, $parameters )
    {

    }

    public function fetch( $line = null )
    {

        return false;

    }

}

?>
