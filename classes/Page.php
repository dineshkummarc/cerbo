<?php

	class Page
	{

        public $module = null;
        public $template = "blank";
        public $parameters = array();

		function __construct()
		{

			global $session;

			$this->module = new Module();

		}

        function render( $twig_renderer )
        {

            $Page = $this;

            // Charge les données depuis le module (et déroule code du module si il y a)

            // On regarde si le module existe dans les modules courants.
            // Autrement on regarde dans les extensions pour l'existance du module.

            if ( file_exists( 'modules/'.$this->module->file ) )
            {
                include 'modules/'.$this->module->file;
            }
            else
            {
                // Parcours des extensions
                $config = parse_ini_file( 'settings/application.ini', true );
                foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
                {
                    if ( file_exists( 'extensions/'.$extension.'/modules/'.$this->module->file ) )
                    {
                        include 'extensions/'.$extension.'/modules/'.$this->module->file;
                    }
                }
            }

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
