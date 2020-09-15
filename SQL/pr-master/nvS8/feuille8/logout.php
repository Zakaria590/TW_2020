<!-- Salah Zakaria OUAICHOUCHE -->
<?php
spl_autoload_register(function ($className) {
     include("lib/{$className}.class.php");
 });
require('lib/watchdog.php');
unset($_SESSION['ident']);

?>
