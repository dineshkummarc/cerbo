<?php

/**
 * Gestion de la session et de tout ce qui peut se passer pendant l'execution d'une page.
 */
class Session
{

    /** 
     * Stockage des résultats SQL pour la page en cours.
     * Avec ce tableau on stoque les résultats pour les requêtes SQL qui sont demandées.
     * Quand une requête est lancée, le résultat est calculé et est stocké dans ce tableau
     * associatif avec comme clef le prototype complet de la méthode (paramétres compris).
     * De cette manière, si la même requête est demandé, la méthode doit demander à la
     * session, si le résultat n'a pas déjà été calculé. Si oui, le r�sultat est automatiquement
     * chargé depuis ce tableau. Ceci afin de limiter les requêtes à la base de données.
     */
    private $db_stoquage_resultats = array();

    /**
     * Démarre ou reprend la session.
     */
    function __construct()
    {

        session_start();

        if ( !isset( $_SESSION['login'] ) )
        {
            $this->initialiserSession();
        }

    }

    function __destruct()
    {
        $self->db_stoquage_resultats = array(); 
    }

    public static function terminer()
    {
        session_destroy();
        $_SESSION['login'] = 'anonymous';
        $_SESSION['name'] = 'Anonymous';
    }

    /**
     * Initialise la session avec des valeurs par défaut
     */
    function initialiserSession()
    {
        $_SESSION['login'] = 'anonymous';
    }

    public static function enregistrerUtilisateurCourant( Utilisateur $utilisateur )
    {

        $_SESSION['login'] = $utilisateur->getLogin();
        $_SESSION['nom'] = $utilisateur->getNomComplet();
        $_SESSION['id'] = $utilisateur->ID;

    }

    public function requeteSQL( $sql )
    {

        //echo "<p>$sql</p>";

        global $bdd;

        // Si la requête n'a jamais été executée on l'execute et on la stoque.
        if ( !isset( $this->db_stoquage_resultats[md5($sql)] ) )
            $this->db_stoquage_resultats[md5($sql)] = $bdd->query( $sql );
        else
            // On rembobine le pointeur de résultats pour un nouvel accés
            mysql_data_seek($this->db_stoquage_resultats[md5($sql)], 0);

        return $this->db_stoquage_resultats[md5($sql)];

    }

    public static function estIdentifie()
    {
        return ( $_SESSION['login'] == 'anonymous' ) ? false : true ;
    }

}

?>
