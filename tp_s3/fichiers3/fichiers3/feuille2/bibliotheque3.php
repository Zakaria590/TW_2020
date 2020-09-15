<?php
require_once("lib/fonctionsLivre.php");
$str = elementBuilder('header', elementBuilder('h1','Bibliothèque'));
$fd = fopen('data/livres.txt','r');
$liste = loadBiblio($fd);
$ordre = $_GET['ordre'];
if ($ordre == "titres")
  $str1 = biblioToHTML($liste,"titles");
elseif ($ordre == "categories")
  $str1 = biblioToHTML($liste,"categories");
elseif (!(isset($ordre)) || $ordre=="aucun")
  $str1 = biblioToHTML($liste);
else
  $str1 = "";
$str .= elementBuilder('section', $str1);
echo $str;
 ?>
