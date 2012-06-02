<?php

// Autoload mecanism (kernel and extensions)
require_once 'autoload.php';

// Load configuration parameters
\sandra\kernel\Configuration::load();

$db = \sandra\kernel\DataSource::getInstance();
$db->select( 'content', array(

    'toto' => array( '=', 'tata' ),

    'and' => array( 

        'tata' => array( '=', 'truc' ),

        'or' => array(

            'mironton' => array( '=', 'barjabule' ),
            'barjabule' => array( '=', 'mironton' )

        )

    )

) );

// Create the engine and render it
$engine = new \sandra\kernel\Sandra();
$engine->render();

?>
