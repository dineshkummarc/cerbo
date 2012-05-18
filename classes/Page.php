<?php

/**
 * Gestion de la page à afficher.
 */
class Page
{

    public $module = null;
    public $template = "pages/blank";
    public $parameters = array();
    public $securite = null;
    public $fil_ariane = array();

    /**
     * Constructeur.
     *
     * Initialise les différentes variables.
     */
    function __construct()
    {

        global $session;

        $this->module = new Module();
        $this->securite = new Securite();

    }

    /**
     * Effectue le rendus de la page.
     *
     * 1. Charge et execute le contenus du fichier PHP dans module associé.
     * 2. Charge les paramètres de sécurité et fait les vérifications qui vont bien.
     * (si l'utilisateur n'est pas autorisé, on redirige vers /login)
     * 3. Lance Twig.
     *
     * Dans les modules les variables suivantes sont définies :
     *     - $Page : Une référence vers cet objet
     *     - $Securite : Un accés directe à la sécurité
     */
    function render( $twig_renderer )
    {

        $Page = $this;
        $Securite = $this->securite;

        $config = Configuration::charger( 'application.ini' );

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
            foreach ( $config['EXTENSIONS']['ExtensionsActives'] as $extension )
            {
                if ( file_exists( 'extensions/'.$extension.'/modules/'.$this->module->file ) )
                {
                    include 'extensions/'.$extension.'/modules/'.$this->module->file;
                }
            }
        }

        // Vérifie les paramètres de sécurité
        if ( $this->module->module != 'login' && $this->module->module != 'logout' )
        {
            if ( !$this->securite->estAutorise() )
            {
                Page::rediriger( 'login' );
            }
        }

        // Ajout de variables dans le template
        $this->parameters['FilAriane'] = $this->fil_ariane;
        $this->parameters['Module'] = $this->module->module;

        // Lance le rendu
        echo $twig_renderer->render( "$this->template.twig", $this->parameters );

    }

    function setFilAriane( $tableau )
    {
        $this->fil_ariane = $tableau;
    }

    /**
     * Définis le template à utiliser.
     *
     * @param $template Le chemin du template (sans l'extension .twig).
     */
    function setTemplate ( $template )
    {
        $this->template = $template;
    }

    /**
     * Ajoute une variable au template.
     *
     * @param $identifiant Le nom de la variable de template.
     * @param $valeur La valeur de la variable.
     */
    function addVariable ( $identifiant, $valeur )
    {
        $this->parameters[$identifiant] = $valeur;
    }

    /**
     * Créer une redirection vers le module donné en prenant en compte une éventuelle
     * sous arborescence (cas des sites qui ne sont pas à la racine du serveur)
     *
     * @param $module Le module vers lequel rediriger.
     */
    public static function rediriger( $module )
    {
        $config = Configuration::charger( 'application.ini' );
        $prefix = $config['URL']['EnleverDuChemin'];
        header("Location: $prefix/$module");
    }

    /**
     * Créé une URL pour l'URI donnée (module + paramètres)
     * en prennant en compte EnleverDuChemin de application.ini
     */
    public static function creerURL( $uri )
    {

        $config = Configuration::charger( 'application.ini' );

        if ( substr( $uri, 0, 1 ) != '/' )
        {
            $uri = '/' . $uri;
        }
        
        $url = $config['URL']['EnleverDuChemin'] . $uri;
        
        return $url;

    }

}

?>
