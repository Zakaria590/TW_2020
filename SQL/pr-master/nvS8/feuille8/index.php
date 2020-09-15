<!-- Salah Zakaria OUAICHOUCHE -->
<?php
spl_autoload_register(function ($className) {
     require_once("lib/{$className}.class.php");
 });
require('lib/watchdog.php');
require('views/pageAccueil.php');
?>
