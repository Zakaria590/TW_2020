<?php/*
 require('lib/fonctionsSVG.php');
 $centreX= 70;
 $centreY= 90;
 $rayon = 50;
 // inclusion de la page 
 require('views/pageFigures.php');*/
?><?php
 require('lib/fonctionsSVG.php');
 //$centreX= 70; 
 //$centreY= 90;
 //$rayon = 50;
 /* inclusion de la page */
 //require('views/pageFigures.php');//require('views/pageErreur.html');
?>
<?php

        $erreur = False;
        if(isset($_GET["cx"])) {
			$centreX = $_GET["cx"];
			 if ((!is_numeric($centreX))){
				 $erreur= True ;
			 }else $erreur= False;
			 } /* recupération des parametres*/
			 
			 
		 if(isset($_GET["cy"])) {
			$centreY = $_GET["cy"];
			 if((!is_numeric($centreY))){
				 $erreur= True ;
			 }else $erreur= False;
			 }  
			 
		 if(isset($_GET["r"])) {
			$rayon = $_GET["r"];
			 if ((!is_numeric($rayon)or $rayon<0)){
				 $erreur= True ;
			 }else $erreur= False;
			 } 
			 
		 if(isset($_GET["a"])) {
			$angle = $_GET["a"];
			}else{
				$angle=90;
			}
		
     
        if($erreur) {
          require("views/pageErreur.html");
          exit();
        }else{
			require("views/pageFigures.php");
          exit();
	  }
			
				?>
			<?php
                echo carre($_GET["cx"],$_GET["cy"],$_GET["r"],$_GET["a"]);
                ?>
		
