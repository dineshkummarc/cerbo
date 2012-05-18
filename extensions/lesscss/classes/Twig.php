<?php

class TwigLessCss extends Twig_Extension
{
    
    public function getName()
    {
        return 'TwigLessCss';
    }

    public function getFunctions()
    {
        return array(
            'lesscss' => new Twig_Function_Method($this, 'lesscss' )
        );
    }

    public function lesscss()
    {
        echo "<script src=\"" . Design::getFichier( 'js/less.min.js' ) . "\" type=\"text/javascript\"></script>";
    }

}

?>
