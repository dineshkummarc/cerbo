<?php

/**
 * File containing the main class of the Application.
 * See index.php to know how to use it.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class Cerbo
{

    private $request;
    private $twig;
    private $content;

    // Some informations about the application
    private static $app_name = 'Cerbo';
    private static $app_version = '0.0.1';
    private static $app_version_name = 'não';
    private static $app_authors = array(
        'MARTIN Damien' => 'damien@martin-damien.fr'
    );

    public function __construct()
    {

        \cerbo\kernel\Debug::addNotice( get_class(), "Starting Cerbo." );

        \cerbo\kernel\Session::forceSessionStart();
        \cerbo\kernel\Extension::load();
        \cerbo\kernel\Route::load();
        \cerbo\kernel\I18n::load();

        $this->request = new \cerbo\kernel\Request();
        $this->twig = null;
        
    }

    public function render()
    {
        
        if ( \cerbo\kernel\ModuleHandler::isModule( $this->request->getURI() ) )
        {
            $content_handler = new \cerbo\kernel\ModuleHandler(
                $this->request->getURI(),
                $this->request->getModuleName()
            );
            $content_handler->getContent()->alterFromRoutes( $this->request->getOriginalURI() );
        }
        else
        {
            $content_handler = new \cerbo\kernel\PageHandler( $this->request->getURI() );
        }

        // Run the code of the module / page before returning it
        $content_handler->getContent()->submited();
        $content_handler->getContent()->build();

        // Get the result of the content in the correct format
        if ( $this->request->getFormat() == "JSON" )
        {
            $result = $content_handler->getContent()->toJSON();
        }
        elseif( $this->request->getFormat() == "XML" )
        {
            $result = $content_handler->getContent()->toXML();
        }
        else
        {
            
            // Standard output to be well formed with a template

            // Load Twig
            require_once 'lib/twig/lib/Twig/Autoloader.php';
            \Twig_Autoloader::register();

            // Init twig
            $this->twig = new \Twig_Environment(

                new \Twig_Loader_Filesystem(
                    \cerbo\kernel\Design::getDesignFolders()
                ), 
                array(
                    //'cache' => 'var/cache/templates',
                )

            );

            // Add extensions to Twig
            foreach ( \cerbo\kernel\Extension::getTwigExtensionsArray() as $extension => $path )
            {
                // echo "<p>$extension: $path</p>";
                require_once $path;
                $class_name = '\Twig' . ucfirst( $extension );
                $this->twig->addExtension( new $class_name() );

            }

            // Prepare data to send as variables to template
            $variables = array();

            // TODO DataMap should only be set for Pages
            $variables['DataMap'] = $content_handler->getContent()->getDataMap();

            // Get Module template variable definitions
            if ( count( $content_handler->getContent()->getTemplateVariables() ) > 0 )
            {
                foreach ( $content_handler->getContent()->getTemplateVariables() as $key => $value )
                {
                    $variables[$key] = $value;
                }
            }

            // Some standard variables available in all templates //

            // Current User
            $user = \cerbo\kernel\User::getCurrentUser();
            $variables['CurrentUser']['name'] = $user->getUserName();

            // Render with Twig
            $result = $this->twig->render(
                $content_handler->getContent()->getTemplate(). '.twig' ,
                $variables
            );

        }

        echo $result;

    }

    public static function getApplicationInformations()
    {
        $informations_string = '';
        $informations_string .= \cerbo\kernel\Cerbo::$app_name;
        $informations_string .= ' '. \cerbo\kernel\Cerbo::$app_version;
        $informations_string .= ' (' . \cerbo\kernel\Cerbo::$app_version_name . ')';
        return $informations_string;
    }

}

?>
