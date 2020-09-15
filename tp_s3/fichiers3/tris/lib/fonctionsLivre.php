<?php  


// Salah Zakaria OUAICHOUCHE Groupe 3

/*function readBook ($file){
	$ligne = fgets($file); //Récupère la ligne courante sur laquelle se trouve le pointeur du fichier
	$book = array ();
	while ($ligne!==FALSE){
		if (strlen(trim($ligne))==0){ // Calcule la taille d'une chaîne + Supprime les espaces
			return $book;
		}
		else {
			if(strpos($ligne,":")===FALSE){ // ligne ne contien pas : est incorrecte
				$erreur="Erreur: [".$ligne."]";
				throw new Exception ($erreur);
			}
			else {
				$kabim = explode(':',$ligne);// Scinde une chaîne de caractères en segments
				$book[trim($kabim[0])]=trim($kabim[1]);
			}
		}
		$ligne = fgets($file);
	}
	return $book;
}

//implode — Rassemble les éléments d'un tableau en une chaîne


/* function readBook($file){
	$line = fgets($file);
	$result = array();
	while ($line !== FALSE && trim($line)!=""{
	
	}


}*/

function readBook ($file){
	$ligne = fgets($file);//Stockage ligne par ligne
	$book = array (); //Initialisation du tableau
	if ($ligne==FALSE){
		return FALSE;
	}
	while (($ligne!==FALSE)&&(strlen(trim($ligne)))==0){ 
		$ligne=fgets($file);
	}

	if ($ligne==FALSE){
		return FALSE;
	}
	while ($ligne!==FALSE){ //tant que le fichier n'a pas été parcouru intégralement
		if (strlen(trim($ligne))==0){
			return $book;
		}
		else {
			if(strpos($ligne,":")===FALSE){ // position des deux points dans la chaine de caractères
				$erreur="Erreur: [".$ligne."]";// s'il n'y a pas de deux points
				throw new Exception ($erreur);
			}
			else {
				$kabim = explode(':',$ligne);
				$kabim[0]=trim($kabim[0]);
				$kabim[1]=trim($kabim[1]);
				$book[$kabim[0]]=$kabim[1];
			}
		}
		$ligne = fgets($file);
	}
	return $book;
}

function elementBuilder($elementType, $content, $elementClass=""){
	if ($elementClass!=""){
		return "<$elementType class=\"$elementClass\">$content</$elementType>";}
	return "<$elementType>$content</$elementType>";}

function authorsToHtmL($authors){
	return '<span>'.implode("</span><span>",explode(" - ",$authors)).'</span>';
}



function coverToHTML($filename){
	return '<img src="couvertures/'.$filename.'" alt=" image de couverture" />';
}
function  propertyToHTML($propName,$propValue){
	if ($propName=='titre'){
		return elementBuilder("h2",$propValue,$propName);
	}
	elseif ($propName=='année'){
		return elementBuilder("time",$propValue,$propName);
	}
	elseif ($propName=='couverture'){
		return elementBuilder("div",coverToHTML($propValue),$propName);
	}
	elseif ($propName=='auteurs'){
		return elementBuilder("div",authorsToHtmL($propValue),$propName);
	}
	else {
		return elementBuilder("div",$propValue,$propName);
	}
}

function bookToHTML($book){
	$text = propertyToHTML('couverture',$book['couverture']);
	$text.='<div class="description">';
	foreach ($book as $key => $value) {
		if ($key!='couverture'){
			$text .=propertyToHTML($key,$value);
		}
	}
	return "<article class=\"livre\">".$text."</div></article>";
}

function libraryToHTML($file){
	$texte="";
	$verif=readBook($file);
	while ($verif!=FALSE){
		$texte.=bookToHTML($verif);
		$verif=readBook($file);
	}
	return $texte;
}

?>


