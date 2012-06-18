<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Administration_Users_Usergroups_Load extends \cerbo\kernel\Module
{

    private $id = -1;
    private $name = '';
    private $policies = array();

    // This module should not be used as a simple page, so we
    // don't have to add a design for it (but it will cause an
    // error if you try to access it).
    public function __construct()
    {
        \cerbo\kernel\Security::needsPolicies( "administracio::login" );
    }

    public function build(){

        $request = \cerbo\kernel\Request::getRequest();
        $usergroup_id = $request->getParameter( 0 );

        $ds = \cerbo\kernel\DataSource::getInstance();
        
        // Get usergroup

        $ds->select( 'usergroups', array( 'id' => array( '=', $usergroup_id ) ) );

        $row = $ds->fetch();

        $this->id = $row->id;
        $this->name = $row->name;

        // Get policies

        $ds->select( 'policies', array( 'usergroup_id' => array( '=', $usergroup_id ) ) );

        while ( ( $result = $ds->fetch() ) != false )
        {
            $this->policies[$result->extension][] = $result->policy;
        }


    }

    public function submited(){}

    public function toJSON()
    {

        $lambda             = new \cerbo\kernel\Lambda();  
        $lambda->id         = $this->id;
        $lambda->name       = $this->name;
        $lambda->policies   = $this->policies;

        return $lambda->toJSON();
    
    }

}

?>
