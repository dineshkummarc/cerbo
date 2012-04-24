<?php

	class BDD
	{

		//! Connexion � la base de donn�es.
		private $cnx;

		function __construct()
		{

			$config = parse_ini_file( "settings/bdd.ini", true );

			$this->cnx = mysql_connect( 
                $config['mysql']['host'],
                $config['mysql']['login'],
                $config['mysql']['password']
            );

			mysql_select_db( $config['mysql']['database'] );

		}

		/**
		 * Destructeur avec fermeture automatique de la connexion � la base de donn�es.
		 */
		function __destruct()
		{
			mysql_close( $this->cnx );
		}

		function query( $sql )
		{
			return mysql_query( $sql, $this->cnx );
		}

	}

?>
