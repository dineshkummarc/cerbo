<?php

class Securite
{

    public $regles = array();

    public function __construct()
    {
        // Rien à faire ici pour le moment
    }

    public function doit( $identifieur_securite, $valeur )
    {
        $this->regles[$identifieur_securite] = $valeur;
    }

    public function estAutorise()
    {

        // Règle pour l'identification
        // C'est la seule règle en dur (c'est le seul élément standard)
        if ( isset( $this->regles['IDENTIFIE'] ) && $this->regles['IDENTIFIE'] == 1 )
        {
            // Règle de base, on vérifie que l'utilisateur est connecté
            if ( $_SESSION['login'] == 'anonymous' )
            {
                return false;
            }
        }

        // TODO Gérer les règles "custom".

        return true;

    }

}

?>
