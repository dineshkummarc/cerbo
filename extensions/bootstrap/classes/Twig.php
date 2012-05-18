<?php

class TwigBootstrap extends Twig_Extension
{
    
    public function getName()
    {
        return 'TwigBootstrap';
    }

    public function getFunctions()
    {
        return array(
            'bootstrap' => new Twig_Function_Method($this, 'bootstrap' )
        );
    }

    public function bootstrap( $params )
    {

        if ( isset( $params['responsive'] ) && $params['responsive'] == true )
        {
            $responsive = "\n<link rel=\"stylesheet\" href=\"" . Design::getFichier( 'css/bootstrap-reposnsive.min.css' ) . "\" />\n";
        }
        else{ $responsive = ''; }

        $val = "<link rel=\"stylesheet\" href=\"" . Design::getFichier( 'css/bootstrap.min.css' ) . "\" />$responsive
        <script type=\"text/javascript\" src=\"" . Design::getFichier( 'js/bootstrap.min.js' ) . "\"></script>\n";

        echo $val;

    }

}

?>
