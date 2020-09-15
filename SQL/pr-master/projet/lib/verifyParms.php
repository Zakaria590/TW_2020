<?php

//script invoqué par le script principal

//création de la classe Exception spécifique
class ParmsException extends Exception{};

const METHOD = INPUT_GET;

//lire la ressource distante
$reponse = file_get_contents("http://vlille.fil.univ-lille1.fr");

//decodage de la resource en une table php
$tab = json_decode($reponse,true);

//creation des "constantes"
//!!!!!!!!!!!!!!classes????
$communes =[];
for ($i=0; $i <count($tab) ; $i++) {
  $fields = $tab[$i]["fields"];

  $libelles[] = $fields["libelle"];
  $noms[]=$fields["nom"];
  $c = $fields["commune"];
  if (! in_array($c,$communes))
    $communes[]=$fields["commune"];
  $adresses[] = $fields["adresse"];
  //$nbVelos[]= $fields["nbvelosdispo"];
  //$nbPlaces[] = $fields["nbplacesdispo"];
}





const TYPES = ["AVEC TPE", "SANS TPE"];
const ETATS = ["EN SERVICE", "HORS SERVICE"];
const ETATCONNEXIONS = ["CONNECTED", "DISCONNECTED"];



//teste si la valeur de $name est entiere et si elle existe des les valeurs prédéfinies
  function intExactFilter($name, $values){
    if (! isset($_GET[$name]) || $_GET[$name]=="")
        $value = [];
      else{
      $valueTab = explode(",", $_GET[$name]);
      for ($i=0; $i<count($valueTab); $i++){
        $s = trim($valueTab[$i]);
        //votre nieme valeur est incorrecte
        if (! (is_numeric($s)) || !(in_array($s, $values)))
          throw new ParmsException("param '".$name."' : valeur incorrecte");
        else {
          $value[]=$name."=".$s;
        }
      }
    }
    return $value;
  }


  function subStringFilter($name,$values){
    if (! isset($_GET[$name]) || $_GET[$name]==""){
        $value = [];
      }
    else {
      $valueTab = explode(',', $_GET[$name]);
      for ($j=0; $j<count($valueTab); $j++){
        $s = strtoupper(trim($valueTab[$j]));

        $found = false;
        for ($i=0; $i<count($values); $i++){
          $pos = strpos($values[$i], $s);
          if ($pos!==false){
            $value[] = $name.'='.$values[$i];
            $found = true;
          }
        }
        if ($found == false){
          throw new ParmsException("param '".$name."' : valeur incorrecte");
        }

        }
    }
    return $value;
  }


  function prefixFilter($name, $values){
    if (! isset($_GET[$name]) || $_GET[$name]==""){
        $value = [];
      }
    else {
      $valueTab = explode(',', $_GET[$name]);
      for ($j=0; $j<count($valueTab); $j++){
        $s = strtoupper(trim($valueTab[$j]));

        $found = false;
        for ($i=0; $i<count($values); $i++){
          $pos = strpos($values[$i], $s);
          if ($pos === 0){
            $value[] = $name."=".$values[$i];
            $found = true;
          }

        }
        if ($found == false){
          throw new ParmsException("param '".$name."' : valeur incorrecte");
        }

        }
    }
    return $value;
  }


  function exactStringFilter($name, $values){
    $value = filter_input(METHOD,$name,FILTER_UNSAFE_RAW, ['flags'=> FILTER_REQUIRE_ARRAY]);
    if ($value === NULL)
      $value=[];
      else {
        for ($i=0;$i<count($value);$i++){
          if (! in_array($value[$i], $values))
            throw new ParmsException("param '".$name."' : valeur incorrecte");
          else {
            $value[$i]=$name."=".$value[$i];
          }
        }
      }
      return $value;
  }

  function intMinFilter($name){
      if (! isset($_GET[$name]) || $_GET[$name]=="")
        $value = [];
      else{
      $valueTab = explode(",", $_GET[$name]);
      for ($i=0; $i<count($valueTab); $i++){
        $s = trim($valueTab[$i]);
        //votre nieme valeur est incorrecte
        if (! (is_numeric($s)))
          throw new ParmsException("param '".$name."' : valeur incorrecte");
        else {
          $value[]=$name."=".$s;
        }
      }
    }
    return $value;
  }

  function tabToRequete($tab){
    return implode('&',$tab);
  }

  $libelle = tabToRequete(intExactFilter("libelle", $libelles));



  $nom = tabToRequete(subStringFilter('nom', $noms));



  $commune = tabToRequete(prefixFilter("commune", $communes));



  $adresse = tabToRequete(subStringFilter('adresse', $adresses));


  $type = tabToRequete(exactStringFilter('type', TYPES));


  $etat = tabToRequete(exactStringFilter('etat', ETATS));



  $etatConnexion = tabToRequete(exactStringFilter('etatconnexion', ETATCONNEXIONS));

  $nbVelosDispo = tabToRequete(intMinFilter('nbvelosdispo'));


  $nbPlacesDispo = tabToRequete(intMinFilter('nbplacesdispo'));



  $requete = "http://vlille.fil.univ-lille1.fr/?";


  //classe?
  ///!!!!!!!!tableau ou classes avec l'autre classes

  $tabRequete = array("libelle"=>$libelle, "nom"=>$nom, "commune"=>$commune, "adresse"=>$adresse, "type"=>$type, "etat"=>$etat, "etatConnexion"=>$etatConnexion, "nbvelosdispo"=>$nbVelosDispo, "nbPlacesDispo"=>$nbPlacesDispo);

  foreach ($tabRequete as $key => $value) {
    if($tabRequete[$key]==""){
      unset($tabRequete[$key]);
    }
  }


  $suiteRequete = tabToRequete($tabRequete);

  $requete.=$suiteRequete;





  $requete = str_replace(" ","%20",$requete);

  print_r($requete);
  echo "<br>";
  echo "<br>";
  echo "<br>";
  //lire la ressource distante
  $reponse = file_get_contents($requete);

  //decodage de la resource en une table php
  $tab2 = json_decode($reponse,true);

  //print_r($tab2);


  //$communes =[];
  for ($i=0; $i <count($tab2) ; $i++) {
    $fields2[] = $tab2[$i]["fields"];

    //$libelles[] = $fields["libelle"];
    //$noms[]=$fields["nom"];
    //$c = $fields["commune"];
    //if (! in_array($c,$communes))
    //  $communes[]=$fields["commune"];
  //  $adresses[] = $fields["adresse"];
    //$nbVelos[]= $fields["nbvelosdispo"];
    //$nbPlaces[] = $fields["nbplacesdispo"];
  }






  function compareFieldsNumber($field1, $field2, $name){
    return $field1[$name]-$field2[$name];
  }

  function compareFieldsString($field1, $field2, $name){
    return strcmp($field1[$name],$field2[$name]);
  }


  function compareFieldsLibelle($field1,$field2){
    return compareFieldsNumber($field1, $field2, "libelle");
  }

  function compareFieldsNom($field1,$field2){
    return compareFieldsString($field1, $field2, "nom");
  }

  function compareFieldsCommune($field1,$field2){
    return compareFieldsString($field1, $field2, "commune");
  }

  function compareFieldsAdresse($field1,$field2){
    return compareFieldsString($field1, $field2, "adresse");
  }

  function compareFieldsNbVelos($field1,$field2){
    return compareFieldsNumber($field1, $field2, "nbvelosdispo");
  }

  function compareFieldsNbPLaces($field1,$field2){
    return compareFieldsNumber($field1, $field2, "nbplacesdispo");
  }








  //usort($fields2, compareFieldsLibelle);

  $tri = $_GET["tri"];

  if ($tri=="nom")
    usort($fields2, compareFieldsNom);
  else if ($tri=="commune")
    usort($fields2, compareFieldsCommune);
  else if ($tri=="adresse")
    usort($fields2, compareFieldsAdresse);
  else if ($tri=="nbVelos")
    usort($fields2, compareFieldsNbVelos);
  else if ($tri=="nbPlaces")
    usort($fields2, compareFieldsNbPLaces);
  else
    usort($fields2, compareFieldsLibelle);



















/*
  //!!!!!!!!!!!!!!!!classeeees
  $communes =[];
  for ($i=0; $i <count($tab) ; $i++) {
    $fields = $tab[$i]["fields"];

    $libelles[] = $fields["libelle"];
    $noms[]=$fields["nom"];
    $c = $fields["commune"];
    if (! in_array($c,$communes))
      $communes[]=$fields["commune"];
    $adresses[] = $fields["adresse"];
    $nbVelos[]= $fields["nbvelosdispo"];
    $nbPlaces[] = $fields["nbplacesdispo"];
  }

  $fields = array("libelle"=>$libelle, "nom"=>$nom, "commune"=>$commune, "adresse"=>$adresse, "nbvelosdispo"=>$nbVelosDispo, "nbPlacesDispo"=>$nbPlacesDispo);

  print_r($fields);
  function compareFieldLibelle($field1,$field2){
    return strcmp($field1["libelle"],$field2["libelle"]);
  }



*/















/*if (! isset($_GET['commune']) || $_GET['commune']=="")
    $commune = [];
else {
  $communeTab = explode(',', $_GET['commune']);
  for ($j=0; $j<count($communeTab); $j++){
    $value = strtoupper(trim($communeTab[$j]));
    $i=0;
    $found = false;
    while ($i<count($communes) &&  $found==false){
      $pos = strpos($communes[$i], $value);
      if ($pos === 0){
        $found = true;
        $commune[] = $communes[$i];
      }
      else {
        $i+=1;
      }
    }
    if ($found == false){
      throw new ParmsException("param '".'commune'."' : valeur incorrecte");
    }

    }
}*/


//cherche si la valeur de $name est sous chaine d'une des valeurs de $values



//cherche si la valeur de $name est prefixe d'une des valeurs de values


/*
///on en a besoin???§§§§§§§§§§§§§!!!!!!!!!!!!
//verifie si la valeur de $name existe dans $values et retourne la valeur
function stringExactFilter($name, $values){
  $value = filter_input(METHOD, $name, FILTER_UNSAFE_RAW);
  if (($value ===false) || (!(in_array($value, $values))))
    throw new ParmsException("param '".$name."' : valeur incorrecte");
  return $value;
}

//verifie si la valeur est entiere et est minimum parmis les valeurs disponibles
function intMinFilter($name, $values){
  $value = filter_input(METHOD, $name, FILTER_VALIDATE_INT);
  if (($value ===false) || ($value<min($values)))
    throw new ParmsException("param '".$name."' : valeur incorrecte");
  return $value;
}




//verification de libelle: valeur entiere exacte
$libelle = intExactFilter('libelle', $libelles);

//verification de nom: sous chaine
$nom = subStringFilter('nom', $noms);


//verification de commune:prefixe
$commune = prefixFilter('commune', $communes);


//verification de adresse: sous chaine
$adresse = subStringFilter('adresse', $adresses);


//!!!!!!!!!!!!!!!!!!
//verification de type: chaine exacte
$type = stringExactFilter('type', TYPES);

//verification de etat: chaine exacte
$etat = stringExactFilter('etat', ETATS);

//verification de etatConnexion: chaine exacte
$etatConnexion = stringExactFilter('etatconnexion', ETATCONNEXIONS);

//verification de nbvelosdispo: valeur entière minimum
$nbVelosDispo = intMinFilter('nbvelosdispo',$nbVelos);

//verification de nbplacesdispo: valeur entière minimum
$nbPlacesDispo = intMinFilter('nbvelosdispo',$nbPlaces);

*/











 ?>
