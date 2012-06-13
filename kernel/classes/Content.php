<?php

/**
 * File containing the main class to manage content.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\kernel;

/**
 * All the modules have to extend from this class !
 */
abstract class Content
{

    private $template;
    private $data_map;

    /**
     * Set the template to render this content.
     */
    public function setTemplate( $template )
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Add a field to the DataMap.
     */
    public function addToDataMap( $name, $value )
    {
        $this->data_map[$name] = $value;
    }

    public function getDataMap()
    {
        return $this->data_map;
    }

    /**
     * This method is here to allow you to add all you need
     * to DataMap.
     */
    abstract protected function build();

    /**
     * When you come from a form, this piece of code is
     * executed.
     */
    abstract protected function submited();

    /**
     * Format as you need the data to a valid JSON format.
     */
    public function toJSON()
    {
        return $this->forgeJSON();
    }

    /**
     * Format as you need the data to a valid XML format.
     */
    public function toXML()
    {
        return $this->forgeXML();
    }

    private function forgeJSON()
    {
        return json_encode( $this->data_map );
    }

    private function forgeXML()
    {
        return "TODO forgeXML";
    }

}

?>
