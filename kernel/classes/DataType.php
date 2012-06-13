<?php

/**
 * File containing the model for making a DataType.
 *
 * @copyright Copyleft MARTIN Damien <damien@martin-damien.fr>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v2
 */

namespace cerbo\datatype;

abstract class DataType
{

    private $collector;
    private $required;
    private $value;

    public abstract protected function fetchData();
    public abstract protected function validate();
    public abstract protected function save();

    public function getValue()
    {
        return $this->value;
    }

    public function setValue( $value )
    {
        $this->value = $value;
    }

    public function isRequired()
    {
        return $this->required;
    }

    public function isCollector()
    {
        return $this->collector;
    }

    public function isEmpty()
    {
        return ( trim( $this->value ) == '' ) ? true : false ;
    }

}

?>
