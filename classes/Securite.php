<?php

$_REGLES[] = 'IDENTIFIE';


class Securite
{

    public $regles = array();

    public function __construct()
    {
        
    }

    public function doit( $identifieur_securite, $valeur )
    {
        $this->regles[$identifieur_securite] = $valeur;
    }

    public function estAutorise()
    {

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
