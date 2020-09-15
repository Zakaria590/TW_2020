<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Premier exercice PHP</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="iniPHP.css" />
    </head>
    <body>
        <header>
            <h1>Exercise 2 PHP</h1>
           <h2>Réalisé par <span class="nom">Salah Zakaria OUAICHOUCHE groupe 3
        </header>
		 <section>
			<?php
			$file = fopen('liste_noms.txt','r'); //ouverture du fichier en licture
			$ligne = fgets($file); //tentative de lecture
			$cpt = 0; $sommeLongueurs = 0;
			echo "<ul>";
			while ($ligne !== FALSE) { // une ligne a vraiment été lue
				echo "<li>".$ligne."</li>";
				$cpt++;
				$sommeLongueurs += strlen($ligne);
				$ligne = fgets($file); // tentative de lecture de la ligne suivante
								}
			fclose($file); //fermiteur du fichier
			echo"</ul>";

			if ($cpt==0){
				echo "<p>Fichier vide</p>";}
			else {
				echo "<p>$cpt lignes lues. Longueur moyenne : " . $sommeLongueurs/$cpt ."</p>";
				}
?>
		 </section>
		  <section>
		 <h2>Exercise 3</h2>
			<?php
		/*	function table_dame($longeur,$hauteur){
				$res ="";
				for($i=0;$i<$longeur;$i++){
					$res+="<td>";
					for($j=0;$j<$hauteur;$j++){
						$t=rand(0,2);
						if($t == 0){
							$res+="-"+"</td>";
						 }
						 else if ($t ==1){
							 $res+="B"+"</td>";
						 }
						 else $res+="N"+"</td>";		
						}
					}
				return $res;
				}; */
			
			
			$l=0; //longeur
			$h=0; //hauteur
			$file = fopen('terrain.txt','r'); //ouverture du fichier
			$ligne = fgets($file); //tentative de lecture
			echo "<table>";
			while ($ligne !== FALSE) { // une ligne a vraiment été lu
				echo"<tr>";
				$h++;
				for($i=0;$i<strlen($ligne);$i++){
					$l++;
					if ($ligne[$i]=='B'){
					echo"<td class='blanc'><spam>B</spam></td>";
				}
				else if ($ligne[$i]=='N'){
					echo"<td class='noir'><spam>N</spam></td>";
				}
				else if ($ligne[$i]=='-'){
					echo "<td class='vide'><spam>-</spam></td>";
				}
				}
				echo "</tr>";
				$ligne = fgets($file); // tentative de lecture de la ligne suivante
	
				};
			fclose($file);
			echo"</table>";
			if ( $h == $l){
				echo "c'est un carré";
			}
			else echo " Erreur table n'est pas un carré";
			
			?>   
        </section>

    </body>
    
</html>
