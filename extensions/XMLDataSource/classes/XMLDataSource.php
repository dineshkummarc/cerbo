<?php

class XMLDataSource implements DataSourceInterface
{

    public $dossier_xml;    // Emplacement des fichiers XML

    public function __construct()
    {
        // Rien de particulier à faire ici
    }

    public function setParametresCNX( $params )
    {
        $this->dossier_xml = $params; 
    }

    public function select( $table, $parametres )
    {
        // TODO Executer la recherche
        return array();
    }

}

?>
