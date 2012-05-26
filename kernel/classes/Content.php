<?php

namespace sandra\kernel;

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

    /**
     * Add a field to the DataMap.
     */
    public function addToDataMap( $name, $value )
    {
        $this->data_map[$name] = $value;
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
    abstract protected function toJSON();

    /**
     * FOrmat as you need the data to a valid XML format.
     */
    abstract protected function toXML();

}

?>
