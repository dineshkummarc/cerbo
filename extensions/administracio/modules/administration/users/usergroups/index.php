<?php

namespace cerbo\modules;

use \cerbo\kernel\I18n as i18n;

class Administration_Users_Usergroups_Index extends \cerbo\kernel\Module
{

    public function __construct()
    {
        \cerbo\kernel\Security::needsPolicies( "administracio::login" );
        $this->setTemplate( 'modules/administration/users/usergroups/index' );
    }

    public function build()
    {

        $ds = \cerbo\kernel\DataSource::getInstance();
        $ds->selectAll( 'usergroups' );

        $usergroups = array();
        while ( ( $line = $ds->fetch() ) != false )
        {
            $usergroups[] = array(
                'id' => $line->id,
                'name' => $line->name
            );
        }

        $this->addTemplateVariable( 'Usergroups', $usergroups );

        $this->addTemplateVariable(
            'AvailablePolicies',
            \cerbo\kernel\Policy::getPolicies()
        );

    }

    public function submited(){}

}

?>
