<?php
//OUAICHOUCHE
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });
require_once('lib/watchdog.php');
require('views/pageAccueil.php');

?>
