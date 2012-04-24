<?php

	/**
	 * Classe permettant de g�rer les utilisateurs
	 */
	class Utilisateur
	{

		public $ID = Null;
		
		//! Le nom de l'utilisateur
		private $nom = "Doe";
		//! Le pr�nom de l'utilisateur
		private $prenom = "John";

		private $login = "anonymous";

		/**
		 * Constructeur
		 */
		function __construct( $charger_utilisateur = null )
		{
			
			if ( $charger_utilisateur == null )
			{

				// Cr�� un utilisateur vierge

			}
			else
			{

				if ( !is_object( $charger_utilisateur ) )
				{
					
					// Chargement depuis un ID
					
					global $session;
			
					$personne_o = mysql_fetch_array(
						$session->requeteSQL( "SELECT * FROM personne WHERE id = $charger_utilisateur" )
					);
					
					$this->ID = $personne_o['id'];
					$this->login = $personne_o['login'];
					$this->nom = $personne_o['nom'];
					$this->prenom = $personne_o['prenom'];
					
				}
				else
				{
					
					// Récupére un utilisateur qui a déjà été chargé
					
					$this->ID = $charger_utilisateur->id;
					$this->login = $charger_utilisateur->login;
					$this->nom = $charger_utilisateur->nom;
					$this->prenom = $charger_utilisateur->prenom;
					
				}

			}

		}
		
		public function __toString()
		{
			return "<a href=''>".$this->getNomComplet()."</a>";
		}

		public static function authentifierUtilisateur( $login, $password )
		{

			global $session;

			$login = mysql_real_escape_string($login);
			$password = md5($password);
			echo $password;
			
			return $session->requeteSQL( "SELECT * FROM personne WHERE login = '$login' AND password = '$password'" );

		}

		public static function listeUtilisateurs()
		{

			global $session;
			
			return $session->requeteSQL( "SELECT * FROM personne" );
		}

		function getNomComplet()
		{
			return strtoupper( $this->nom ).' '.ucwords( strtolower( $this->prenom ) );
		}

		function getLogin()
		{
			return $this->login;
		}

	}

?>
