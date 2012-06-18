<?php

/**
 * File containing all you should need to use usergroups.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

class Usergroup
{

    private $name = '';
    private $policies = array();

    public function __construct( $usergroup_id )
    {

        if ( $usergroup_id != null )
        {

            $ds = \cerbo\kernel\DataSource::getInstance();
            $ds->select( 'usergroups', array( 'id' => array( '=', $usergroup_id ) ) );

            $row = $ds->fetch();

            $this->name = $row->name;

            // Load policies

            $ds->select( 'policies', array( 'usergroup_id' => array( '=', $usergroup_id ) ) );

            while( ( $row = $ds->fetch() ) != false )
            {
                $this->policies[$row->extension][] = $row->policy;
            }

        }
        else
        {

            $this->name = 'Anonymous';
            $this->policies = array();

        }

    }

    public static function getUsergroupForUser( $user_id )
    {

        $ds = \cerbo\kernel\DataSource::getInstance();
        $ds->select( 'relation_users_usergroups', array( 'user_id' => array( '=', $user_id ) ) );

        $row = $ds->fetch();

        return new \cerbo\kernel\Usergroup( $row->usergroup_id );

    }

    public function getName()
    {
        return $this->name;
    }

    public function getPolicies()
    {
        return $this->policies;
    }

}

?>
