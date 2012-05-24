<?php

namespace sandra\kernel;

interface DataSourceInterface
{

    public function setParameters( $parameters );

    public function select( $table, $parameters );

}

class DataSource
{

    public static function getInstance()
    {

        // Initialisation de l'handler
        $handler = $_CONFIGURATION['application.ini']['DATABASE']['DataSourceHandler'];
        $cnx = new $handler();
        $cnx->setParameters( $_CONFIGURATION['application.ini']['BASEDEDONNEES']['Connection'] );

        return $cnx;

    }

}

?>
