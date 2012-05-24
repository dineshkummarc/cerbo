<?php

// Autoload mecanism (kernel and extensions)
require_once 'autoload.php';

// Load configuration parameters
\sandra\kernel\Configuration::load();

// Create the engine and render it
$engine = new \sandra\kernel\Sandra();
$engine->render();

?>
