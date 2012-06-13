<?php

/**
 * File containing all you should need to use sessions.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class Session
{

    private static $current_session = null;

    private $current_user = null;

    private function __construct()
    {
        session_start();
        // $this->current_user = \cerbo\kernel\User::getCurrentUser();
    }

    public function hasVariable( $variable_name )
    {
        if ( isset( $_SESSION[$variable_name] ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getVariable( $variable_name )
    {
        return $_SESSION[$variable_name];
    }

    public static function forceSessionStart()
    {
        \cerbo\kernel\Session::getSession();
    }

    public static function getSession()
    {
        if ( \cerbo\kernel\Session::$current_session == null )
        {
            \cerbo\kernel\Session::$current_session = new Session();
        }
        return \cerbo\kernel\Session::$current_session;
    }

}

?>
