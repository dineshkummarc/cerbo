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

    private $user_id = -1;
    private $user_name = '';
    private $user_firstname = '';
    private $user_lastname = '';
    private $user_login = '';
    private $usergroup = null;

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
    
            $ds = \cerbo\kernel\DataSource::getInstance();
            $ds->select( 'users', array( 'id' => array( '=', $user_id ) ) );

            $user_row = $ds->fetch();

            $this->user_id          = $user_row->id;
            $this->user_name        = $user_row->firstname . ' ' . $user_row->lastname;
            $this->user_firstname   = $user_row->firstname;
            $this->user_lastname    = $user_row->lastname;
            $this->user_login       = $user_row->login;

            $this->usergroup = \cerbo\kernel\Usergroup::getUsergroupForUser( $this->user_id );

        }

    }

    public static function changeCurrentUser( $change_to )
    {

        \cerbo\kernel\User::$current_user = new \cerbo\kernel\User( $change_to );
    }

    private function setAnonymousData()
    {
        $this->user_id = -1;
        $this->user_name = \cerbo\kernel\I18n::translate( 'kernel/global', 'Anonymous' );
        $this->usergroup = new \cerbo\kernel\Usergroup( null );
    }

    public static function identifyUser()
    {

        $session = \cerbo\kernel\Session::getSession();

        if ( \cerbo\kernel\User::$current_user == null )
        {
            if ( $session->hasVariable( 'identified_user' ) )
            {
                \cerbo\kernel\User::$current_user = new \cerbo\kernel\User(
                    $session->getVariable( 'identified_user' )
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

    public function getUserName()
    {
        return $this->user_name;
    }

    public function getUsergroup()
    {
        return $this->usergroup;
    }

}

?>
