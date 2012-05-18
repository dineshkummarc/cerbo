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
            $responsive = '-responsive';
        }
        else{ $responsive = ''; }

        $val = "<link rel=\"stylesheet\" href=\"" . Design::getFichier( "css/bootstrap$responsive.min.css" ) . "\" />
        <script type=\"text/javascript\" src=\"" . Design::getFichier( 'js/bootstrap.min.js' ) . "\"></script>\n";

        echo $val;

    }

}

?>