<?php

/**
 * File containing User class to manage registered users and anonymous.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class User
{

    private static $current_user = null;

    /**
     * If the user_id is set to null, it will load the anonymous user
     */
    public function __construct( $user_id = null )
    {

        if ( $user_id == null )
        {
            $this->setAnonymousData();
        }
        else
        {
            // TODO Load user's data from DB
        }

    }

    private function setAnonymousData()
    {
        $this->id = -1;
        $this->name = \cerbo\kernel\I18n::translate( 'Anonymous', 'cerbo/kernel' );
    }

    public static function identifyUser()
    {

        $session = \cerbo\kernel\Session::getSession();

        if ( \cerbo\kernel\User::$current_page == null )
        {
            if ( $session->hasVariable( 'identifyed_user' ) )
            {
                \cerbo\kernel\User::$current_user = new \cerbo\kernel\User(
                    $session->getVariable( 'identifyed_user' )
                );
            }
            else
            {
                \cerbo\kernel\User::$current_user = new \cerbo\kernel\User();
            }
        }

    }

    public static function getCurrentUser()
    {
        if ( \cerbo\kernel\User::$current_user == null )
        {
            \cerbo\kernel\User::identifyUser();
        }
        return \cerbo\kernel\User::$current_user;
    }

}

?>
