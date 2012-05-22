<?php

/**
 * Opérations de base sur le design du site.
 */
class Design
{

    /**
     * Récupére le chemin vers un fichier de design en prenant en compte l'ordre des designs
     * et l'ordre des extensions utilisées.
     * Si aucun fichier n'est trouvé, on renvoie NULL.
     * @param $fichier Le nom du fichier a charger (avec son sous dossier comme js/jquery.js par exemple).
     * @return Le chemin complet vers le fichier ou null suivant les cas.
     */
    public static function getFichier( $fichier )
    {

        // Charge les paramètres de configuration
        $config = Configuration::charger( 'application.ini' );

        // Extraction des tableaux des extensions et des designs
        $extensions = array_reverse( $config['EXTENSIONS']['ExtensionsActives'] );
        $designs = array_reverse( $config['DESIGN']['Utiliser'] );

        $prefixe = ( trim( $config['URL']['EnleverDuChemin'] ) != '' ) ? $config['URL']['EnleverDuChemin'] . '/' : '/' ;

        // Parcours des extensions
        foreach ( $designs as $design )
        {
            foreach ( $extensions as $extension )
            {
                if ( file_exists( 'extensions/' . $extension . '/design/' . $design . '/' . $fichier ) )
                {
                    return $prefixe . 'extensions/' . $extension . '/design/' . $design . '/' . $fichier;
                }
            }
        }

        // Si on n'a rien trouvé on regarde dans les designs à la racine
        foreach ( $designs as $design )
        {
            if ( file_exists( 'design/' . $design . '/' . $fichier ) )
            {
                return $prefixe . 'design/' . $design . '/' . $fichier;
            }
        }

        // On a rien trouvé donc on renvois null
        return null;

    }

    /**
     * Liste tous les dossiers de design valides par rapport à la configuration du site.
     * @return Un tableau avec la liste de tous les dossiers de design valides (dans 
     * l'ordre dans lequel ils ont été déclarés).
     */
    public static function listerDossiersDeDesign( $config )
    {

        $templates_folders = array();
        foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
        {
            foreach ( $config['DESIGN']['Utiliser'] as $design )
            {
                // Ajout des templates
                if ( file_exists( 'extensions/' . $extension . '/design/' . $design . '/templates' ) )
                {
                    $templates_folders[] = 'extensions/' . $extension . '/design/' . $design . '/templates';
                }
            }
        }
        return $templates_folders;

    }

    /**
     * Enregistre en variable globale (oui, c'est pas bien) les fichiers qui doivent être
     * chargés dans le layout en fonction des modules chargés.
     */
    public static function chargerAutomatiquement( $config )
    {

        global $_DESIGN;
        
        // Chargement des fichiers de design à charger automatiquement
        $_DESIGN = array(); // Tableau qui va recevoir les fichiers de design à inclure automatiquement
        foreach ( $config['DESIGN']['FichiersDeBase'] as $fichier )
        {
            $_DESIGN[] = $fichier;
        }

    }

}

?>
