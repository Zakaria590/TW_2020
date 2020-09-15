<?php
	// OUAICHOUCHE Salah Zakaria  Groupe3
	// script invoqué par le script principal
  
	// création de la classe Exception spécifique
	class ParmsException extends Exception{};
	
	// quelques constantes utiles
	const METHOD = INPUT_GET;
	
 	const CIVILITE_VALUES = ['Mr','Mme']; // valeurs autorisées pour 'civilite'
 	const ADHESION_VALUES = ['oui', 'non', 'dejaMembre']; // valeurs autorisées pour 'adhesion'
	
	const CP_REGEXP ='/^([02][1-9]|[13-8][0-9]|9[0-5]|2A|2B|97[1-6])[0-9]{3}$/';
	// regexp définissant les valeurs autorisées pour 'cp'
	
	const FIG_VALUES = [ // valeurs autorisées pour 'fig'
        "Maître Yoda",
        "Luke Skywalker",
        "Anakin Skywalker",
        "Dark Vador",
        "Obi-Wan Kenobi",
        "Han Solo",
        "Princesse Leia",
        "Padmée Amidala",
        "Empereur Palpatine",
        "R2D2",
        "C3PO",
        "Chewbacca",
        "Rey",
        "Finn",
        "Poe Dameron",
        "Kylo Ren"
        ];
        //Question1 
	 /*  regle a respecter civilite obligatoire 'Mr' ou 'Mme' */    
	$civilite = filter_input(METHOD, 'civilite', FILTER_SANITIZE_STRING);
	if ($civilite === NULL)
		throw new ParmsException("param 'civilite' : valeur absente");
	else if (! in_array($civilite, CIVILITE_VALUES))
			throw new ParmsException("param 'civilite' : valeur incorrecte");

	/* nom obligatoire chaine non vide */
	$nom = filter_input(METHOD, 'nom', FILTER_SANITIZE_STRING);
	if ($nom === NULL || $nom === '')
		throw new ParmsException("param 'nom' :valeur absente");
	else if (trim($nom )=== '')
		throw new ParmsException("param 'nom' : valeur incorrecte");
	
	/* prenom obligatoire chaine non vide */
	$prenom = filter_input(METHOD, 'prenom', FILTER_SANITIZE_STRING);
	if ($prenom === NULL || $prenom === '')
		throw new ParmsException("param 'prenom' :valeur absente");
	else if (trim($prenom ) === '')
		throw new ParmsException("param 'prenom' : valeur incorrecte");
		
	/* voie obligatoire chaine non vide */
		$voie = filter_input(METHOD, 'voie', FILTER_SANITIZE_STRING);
	if ($voie === NULL || $voie === '')
		throw new ParmsException("param 'voie' :valeur absente");
	else if (trim($voie) === '')
		throw new ParmsException("param 'voie' : valeur incorrecte");
		
	/* ville obligatoire chaine non vide */
	$ville = filter_input(METHOD, 'ville', FILTER_SANITIZE_STRING);
	if ($ville === NULL || $ville === '')
		throw new ParmsException("param 'ville' :valeur absente");
	else if (trim($ville) === '')
		throw new ParmsException("param 'ville' : valeur incorrecte");
	
	
	/* complAd facultatif chaine */
	$complAd = filter_input(METHOD, 'complAd', FILTER_SANITIZE_STRING);
	if ($complAd === NULL)
		$complAd = '';
		
	/* cp obligatoire code postal */	
	$cp = filter_input( METHOD, 'cp' , FILTER_VALIDATE_REGEXP, ['options'=>['regexp'=>CP_REGEXP]]);
	if ($cp === NULL)
		throw new ParmsException("param 'cp': valeur absente");
	
	
	/*
	 adhesion facultatif 'oui','non','dejaMembre' 	
	 */
	 
	$adhesion = filter_input(METHOD , 'adhesion', FILTER_UNSAFE_RAW);
	if ($adhesion === NULL)
		$adhesion ='non';
	else if (! in_array($adhesion,ADHESION_VALUES))
		throw new ParamsException("param 'adhesion' :valuer incorrecte");
		
		
		
		
	/* fig obligatoire nom parmi la liste des figures proposées */
	$fig = filter_input(METHOD, 'fig',FILTER_VALIDATE_INT, ['flags'=>FILTER_REQUIRE_ARRAY]);
	/*if (sizeof($fig) === 0)
		throw new ParmsException("param 'fig' : valeur absente");
	else
		for($i = 0; $i < $max;$i++)
			if (! in_array($fig[i],FIG_VALUES)
				throw new ParmsException("param 'fig': valeur incorrecte");*/
	
	/*
	 * à compléter, pour chaque paramètre :
	 * - tester sa présence et sa validité
	 * - initialiser une variable globale de même nom avec la valeur retenue
	 * - en cas d'erreur ou d'absence (d'un paramètre requis) : déclencher une ParmsException avec un message d'erreur
	 */
    


    /*

    //2em methode

       function checkEnum( $name, $values, $default = NULL)  {
   	$res = filter_input(METHOD, $name, FILTER_UNSAFE_RAW);   	
   	 if ( $res === NULL)
   			if (is_null($default))
   				throw new ParamsException ("param $name : valeur absente");
	  	    else
   				$res = $default;

	 else if (! in_array($res, $values))
   		throw new ParamsException("param $name : valeur incorrecte");

   	return $res;
   }



   function checkString($name){
   	$res = filter_input(METHOD, $name, FILTER_SANITIZE_STRING);
   	if ( $res === NULL)
   		$res ='';
   	return $res;
   }

   function checkNonEmptySting ($name){
   	$res = filter_input(METHOD, $name,FILTER_SANITIZE_STRING);
   	if ($res === NULL || $res ==='')
    		throw new ParamsException("param $name : valeur absente");
   	return $res;
   }

  function checkRegexp ($name, $regexp){
  	$res =filter_input( METHOD, $name , FILTER_VALIDATE_REGEXP, ['options'=>['regexp'=>$regexp]]);
  	if ( $res === NULL)
  		  throw new ParamsException("param $name : valeur absente");
   	return $res;
  }

  $civilite = checkEnum('civilite', CIVILITE_VALUES);
  $nom = checkNonEmptySting('nom');
  $prenom = checkNonEmptySting('prenom');
  $voie = checkNonEmptySting('voie');
  $ville = checkNonEmptySting('ville');
  $cp = checkRegexp('cp', CP_REGEXP);
  $complAd = checkString('complAd');


  // Question 2

  $adhesion = checkEnum('adhesion', ADHESION_VALUES);

  $name = 'fig'; //tableau 
  $res = filter_input(METHOD, $name, FILTER_UNSAFE_RAW, ['flags'=>FILTER_REQUIRE_ARRAY]);  
  foreach ($res as $k => $v) {
  	if (! in_array($v, FIG_VALUES)) {
  		throw new ParamsException ("param $name : valeur incorrecte");
  	}

  	$fig = $res;
  }	
	
*/

?>