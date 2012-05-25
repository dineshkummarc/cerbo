<?php

namespace sandra\kernel;

/**
 * All the modules have to extend from this class !
 */
class Content
{

    private $template;

    public function setTemplate( $template )
    {
        $this->template = $template;
    }

}


?>
