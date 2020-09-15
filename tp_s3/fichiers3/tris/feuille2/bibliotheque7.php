<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Livre unique</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="" />
    </head>
    <body>
        <header><h1>Bibliothèque</h1></header>
        <section>
<?php
require_once("lib/fonctionsLivre.php"); 
$LU = fopen('data/livres.txt','r');
echo libraryToHTML($LU);
fclose($LU);
?>		</section>
    </body>
</html>