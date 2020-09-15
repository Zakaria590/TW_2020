<?php
require_once("lib/fonctionsLivre.php");
$str = elementBuilder('header', elementBuilder('h1','Bibliothèque'));
$fd = fopen('data/livres.txt','r');
$liste = loadBiblio($fd);
$str1 = biblioToHTML($liste,"titles");
$str .= elementBuilder('section', $str1);
echo $str;
 ?>
