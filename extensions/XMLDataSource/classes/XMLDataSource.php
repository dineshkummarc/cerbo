<?php

// Inclusion d'une librairie tiers pour simplifier la gestion de XML
require_once( 'extensions/XMLDataSource/lib/simple_html_dom.php' );

/**
 * Cette classe permet d'accéder aux données issues de fichiers XML.
 */
class XMLDataSource extends DataSource implements DataSourceInterface
{

    public $dossier_xml;    // Emplacement des fichiers XML

    public function __construct()
    {
        // Rien de particulier à faire ici
    }

    /**
     * Définis les paramètres de connection à la base de données.
     */
    public function setParametresCNX( $params )
    {

        // Vérification du slash finale
        if ( substr( $params, strlen( $params ) - 1 ) != '/' )
        {
            $params = "$params/";
        }

        $this->dossier_xml = $params; 

    }

    /**
     * Fait une requête simple dans la table.
     */
    public function select( $table, $parametres )
    {

        // Récupération du contenu du fichier XML
        $xml = file_get_html( $this->getFichier( $table ) );
        $resultats = array();

        // On regarde dans tous les résultats
        foreach ( $xml->find( $table ) as $entree )
        {

            $verification_booleenne = false;

            // On vérifie que les conditions sont bonnes
            foreach ( $parametres as $param )
            {

                $champ      = $param[0];
                $operateur  = $param[1];
                $valeur     = $param[2];

                switch ( $operateur )
                {

                    case '=':
                        $operation = ( $entree->$champ == $valeur ) ? true : false ;
                        break;

                    case 'LIKE':
                        $operation = ( strpos( $entree->$champ, $valeur ) !== false ) ? true : false ;
                        break;

                    case '<':
                        $operation = ( $entree->$champ < $valeur ) ? true : false ;
                        break;

                    case '<=':
                        $operation = ( $entree->$champ <= $valeur ) ? true : false ;
                        break;

                    case '>':
                        $operation = ( $entree->$champ > $valeur ) ? true : false ;
                        break;

                    case '>=':
                        $operation = ( $entree->$champ >= $valeur ) ? true : false ;
                        break;

                    case '!=':
                        $operation = ( $entree->$champ != $valeur ) ? true : false ;
                        break;

                }
                
                // Ajout du résultat de la comparaison 
                $verification_booleenne = $verification_booleenne && $operation;

            }

            if ( $verification_booleenne )
            {
                $resultats[] = $this->formatStandard( $entree );
            }

        }

        return $resultats;

    }

    public function formatStandard( $entree )
    {
        // TODO Transformer un noeud du DOM en tableau (indexé).
        return "HELLO KITTY";
    }

    /**
     * Calcul le nom complet du fichier à charger.
     */
    public function getFichier( $table )
    {
        return $this->dossier_xml . $table . '.xml';
    }

}

?>
