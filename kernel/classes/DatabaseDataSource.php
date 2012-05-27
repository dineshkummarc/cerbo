<?php

namespace sandra\datasource;

class DatabaseDataSource extends \sandra\kernel\DataSource
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

    public function select( $table, $parameters )
    {

    }

    public function remove( $table, $parameters )
    {

    }

    public function update( $table, $parameters )
    {

    }

}

?>
