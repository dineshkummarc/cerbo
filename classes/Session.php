<?php

	/**
	 * Gestion de la session et de tout ce qui peut se passer pendant l'execution d'une page.
	 */
	class Session
	{

		/** 
		 * Stockage des r�sultats SQL pour la page en cours.
		 * Avec ce tableau on stoque les r�sultats pour les requ�tes SQL qui sont demand�es.
		 * Quand une requ�te est lanc�e, le r�sultat est calcul� et est stock� dans ce tableau
		 * associatif avec comme clef le prototype complet de la m�thode (param�tres compris).
		 * De cette mani�re, si la m�me requ�te est demand�, la m�thode doit demander � la
		 * session, si le r�sultat n'a pas d�j� �t� calcul�. Si oui, le r�sultat est automatiquement
		 * charg� depuis ce tableau. Ceci afin de limiter les requ�tes � la base de donn�es.
		 */
		private $db_stoquage_resultats = array();

		/**
		 * D�marre ou reprend la session.
		 */
		function __construct()
		{
			
			session_start();

			if ( !isset( $_SESSION['login'] ) )
			{
				$this->initialiserSession();
			}

		}

		function __destruct()
		{
			$self->db_stoquage_resultats = array(); 
		}

		public static function terminer()
		{
			session_destroy();
			$_SESSION['login'] = 'anonymous';
			$_SESSION['name'] = 'Anonymous';
		}

		/**
		 * Initialise la session avec des valeurs par d�faut
		 */
		function initialiserSession()
		{
			$_SESSION['login'] = 'anonymous';
		}

		public static function enregistrerUtilisateurCourant( Utilisateur $utilisateur )
		{
			
			$_SESSION['login'] = $utilisateur->getLogin();
			$_SESSION['nom'] = $utilisateur->getNomComplet();
			$_SESSION['id'] = $utilisateur->ID;
			
		}

		public function requeteSQL( $sql )
		{
			
			//echo "<p>$sql</p>";

			global $bdd;

			// Si la requ�te n'a jamais �t� execut�e on l'execute et on la stoque.
			if ( !isset( $this->db_stoquage_resultats[md5($sql)] ) )
				$this->db_stoquage_resultats[md5($sql)] = $bdd->query( $sql );
			else
				// On rembobine le pointeur de résultats pour un nouvel accés
				mysql_data_seek($this->db_stoquage_resultats[md5($sql)], 0);

			return $this->db_stoquage_resultats[md5($sql)];

		}
 
 		public static function estIdentifie()
		{
			return ( $_SESSION['login'] == 'anonymous' ) ? false : true ;
		}

	}

?>
