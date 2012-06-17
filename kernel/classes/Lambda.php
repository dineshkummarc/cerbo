<?php

/**
 * The Lambda class is here to offer a support for creating
 * any kind of object with as many attributes you will need.
 * It is used, for exemple, for creating lambda objects and
 * transforming them into JSON.
 */

namespace cerbo\kernel;

class Lambda
{
    public function toJSON()
    {
        return json_encode( $this );
    }
}

?>
