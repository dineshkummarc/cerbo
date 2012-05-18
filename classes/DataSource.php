<?php

/**
 * Interface devant être implémenté par une source de données.
 */
interface DataSourceInterface
{

    public function setParametresCNX( $params );

    public function select( $table, $parametres );

}

/**
 * Opérations de base sur la base de données.
 */
class DataSource
{

    public static function getInstance()
    {

        // Récuperation de l'handler à utiliser
        $config = Configuration::charger( 'application.ini' );

        // Initialisation de l'handler
        $handler = $config['BASEDEDONNEES']['DataSourceHandler'];
        $cnx = new $handler();
        $cnx->setParametresCNX( $config['BASEDEDONNEES']['Connection'] );

        return $cnx;

    }

}

?>
