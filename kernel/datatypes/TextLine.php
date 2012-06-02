<?php

namespace sandra\datatype;

class TextLine extends \sandra\datatype\DataType
{

    public function fetchData()
    {

        // TODO Add some logic here
        $this->setValue( 'Hello World' );

    }

    public function validate()
    {

        if ( $this->isRequired() && $this->isEmpty() )
        {
            return false;
        }

        return true;

    }

    public function save()
    {

        // TODO Add some logic here

    }

}

?>
