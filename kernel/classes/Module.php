<?php

namespace sandra\kernel;

/**
 * All the modules have to extend from this class !
 */
class Module
{

    public function __construct( $uri )
    {

    }

    public function isModule( $uri )
    {
        // TODO Detect modules
        return true;
    }

}

interface ModuleInterface
{

    public function run();
    public function submited();
    public function toJSON();
    public function toXML();

}

?>
