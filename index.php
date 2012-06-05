<?php

// Autoload mecanism (kernel and extensions)
require_once 'autoload.php';

// Load configuration parameters
\cerbo\kernel\Configuration::load();

$db = \cerbo\kernel\DataSource::getInstance();
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
$engine = new \cerbo\kernel\Cerbo();
$engine->render();

?>
