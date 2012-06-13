<?php

/**
 * File containing the class to manage pages.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

/**
 * All the modules have to extend from this class !
 */
class Page extends Content
{

    private $data_map;

    public function __construct(){}

    public function fetchDataFromNodeID( $node_id )
    {

        $db = \cerbo\kernel\DataSource::getInstance();
        $db->select( 'content', array(
            'id' => array( '=', $node_id )
        ) );

        while ( ( $row = $db->fetch() ) == true )
        {
            // $this->data_map[] = $row[];
        }

    }

    public function addToDataMap( $name, $value )
    {
        $this->data_map[$name] = $value;
    }

    public function getDataMap()
    {
        return $this->data_map;
    }

    public static function fetchPageByNodeID( $node_id )
    {

        $page = new \cerbo\kernel\Page();
        $page->fetchDataFromNodeID( $node_id );

        return $page;

    }

}

?>
