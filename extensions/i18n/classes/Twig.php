<?php

class TwigI18n extends Twig_Extension
{
    
    public function getName()
    {
        return 'TwigI18n';
    }

    public function getFilters()
    {
        return array(
            'i18n' => new Twig_Filter_Method($this, 'i18n' )
        );
    }

    public function i18n( $string, $params = null )
    {

        // TODO Charger les données depuis les fichiers de traduction
        // Ou laisser le texte dans la langue par défaut
        echo 'Meow';

    }

}

?>
