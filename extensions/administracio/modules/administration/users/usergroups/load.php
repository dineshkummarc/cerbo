<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Administration_Users_Usergroups_Load extends \cerbo\kernel\Module
{

    private $id;
    private $name;
    private $policies;

    // This module should not be used as a simple page, so we
    // don't have to add a design for it (but it will cause an
    // error if you try to access it).
    public function __construct(){}

    public function build(){

        $request = \cerbo\kernel\Request::getRequest();
        $usergroup_id = $request->getParameter( 0 );

        $ds = \cerbo\kernel\DataSource::getInstance();
        $ds->select( 'usergroups', array( 'id' => array( '=', $usergroup_id ) ) );

        $row = $ds->fetch();

        $this->id = $row->id;
        $this->name = $row->name;

    }

    public function submited(){}

    public function toJSON()
    {
        return '{
                    "id": "' . $this->id . '",
                    "name": "' . $this->name . '"
                }';
    }

}

?>
