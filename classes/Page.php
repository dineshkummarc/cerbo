<?php

	class Page
	{

        public $module = null;
        public $template = "blank";
        public $parametres = array();

		function __construct()
		{

			global $session;

			$this->module = new Module();

		}

        function render( $twig_renderer )
        {

            $Page = $this;

            // Charge les données depuis le module (et déroule code du module si il y a)
            include 'modules/'.$this->module->file;

            // Vérifie les paramètres de sécurité
            // TODO
            
            // lance le rendu
            echo $twig_renderer->render( "$this->template.twig", $this->parameters );

        }

        function setTemplate ( $template )
        {
            $this->template = $template;
        }

        function addVariable ( $identifiant, $valeur )
        {
            $this->parameters[$identifiant] = $valeur;
        }

		function __destruct()
		{
		}

	}

?>
