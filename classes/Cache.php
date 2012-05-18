<?php

class Cache
{

    /**
     * Charge un fichier en cache
     * (si le fichier n'existe pas, il est créé).
     */
    public static function getFichier( $fichier )
    {
        $id = new FichierDeCache( $fichier );
    }

}

class FichierDeCache
{
    
    public function __construct( $fichier )
    {

        

    }

}

?>
