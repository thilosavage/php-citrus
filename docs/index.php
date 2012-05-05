<?php 

session_start();

include('config.php');

$route = new route();

$controller = factory::build($route);

// if an error happened in setup
$controller->run($route);

// now gtfo
exit;
?>