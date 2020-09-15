<?php

 require('lib/fonctionsSVG.php');
 $centreX= $_GET['centreX'];
 $centreY=$_GET['centreY'];
 $rayon =$_GET['rayon'];
 $figure=$_GET['figure'];
 if(isset($_GET['angle'])){
   $angle=$_GET['angle'];

 }else{
   $angle=90;
 }
 /* inclusion de la page */

if(isset($centreX) && isset($centreY) && is_numeric($centreX) && is_numeric($centreY) && isset($rayon) && is_numeric($rayon) && $rayon>-1){
   require('views/pageFigures.php');}

 else{
   require('views/pageErreur.html');
 }


/*   $centreX=$_POST['centreX'];
   $centreY=$_POST['centreY'];
   $rayon = $_POST['rayon'];
  */









?>
