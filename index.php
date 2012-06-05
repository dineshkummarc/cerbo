<?php

// Autoload mecanism (kernel and extensions)
require_once 'autoload.php';

// Load configuration parameters
\cerbo\kernel\Configuration::load();

// Create the engine and render it
$engine = new \cerbo\kernel\Cerbo();
$engine->render();

?>
