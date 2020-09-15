<?php
require_once("lib/fonctionsLivre.php");
$str = elementBuilder('header', elementBuilder('h1','Bibliothèque'));
$fd = fopen('data/livres.txt','r');
$str1 = libraryToHTML($fd);
$str .= elementBuilder('section', $str1);
echo $str;
 ?>
