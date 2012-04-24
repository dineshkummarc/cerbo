<?php

class Securite
{

    public static function verifierAccesApplication( Page $page )
    {

        if ( $page->module->module != 'login' && $_SESSION['login'] == 'anonymous' )
            header( "Location: /login" );

    }

}

?>
