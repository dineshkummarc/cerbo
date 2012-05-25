<?php

interface ModuleInterface
{

    public function run();
    public function submited();
    public function toJSON();
    public function toXML();

}

?>
