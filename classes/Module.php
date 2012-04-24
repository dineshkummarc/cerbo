<?php

	class Module
	{

		public $module;
		public $file;

		function __construct()
		{

            $query = $_SERVER['REQUEST_URI'];
            $config = parse_ini_file( "settings/application.ini", true );

            // Suppression du début de l'URL (si besoins)
            if ( isset( $config['URL']['EnleverDuChemin'] ) && $config['URL']['EnleverDuChemin'] != '' )
            {
                if ( substr( $query, 0, strlen( $config['URL']['EnleverDuChemin'] ) ) == $config['URL']['EnleverDuChemin'] )
                {
                    $query = substr( $query, strlen( $config['URL']['EnleverDuChemin'] ) );
                }
            }


			if ( substr( $query, 0, 1 ) == "/" )
				$query = substr( $query, 1 );

			// On fait le trie entre le module a afficher et les parametres passés
			$parties = explode( "?", $query );
			
			// On sauvegarde le module
			$query = $parties[0];
			
			// On sauvegarde les parametres dans le tableau de GET comme si tout était normale
			$_GET = array();
			if( isset( $parties[1] ) )
			foreach( explode( "&", $parties[1] ) as $couple )
			{
				$couple = explode( "=", $couple );
				$_GET[$couple[0]] = $couple[1];
			}
			
			if ( $query == "" )
				$query = "accueil";

			$this->module = $query;
			$this->file = "$query.php";

		}

	}

?>
