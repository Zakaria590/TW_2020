<?php

//creation de table



function fieldToCell($field){
  return "<td>".$field."</td>";
}

function fieldToThCell($field){
  return "<th>".$field."</th>";
}
function lineToTableLine($line){
  return "<tr>".$line."</tr>\n";
}

function lineWithDataClasstoTabLine($line, $data){
  $dataLine ="";
  foreach ($data as $key => $value) {
    $dataLine.= "data-".$key.'="'.$value.'" ';
  }
  return "<tr ".$dataLine. ">".$line."</tr>\n";
}


function fieldsToTable($fields){
  $s = "<table id=\"tableauVLille\">\n";
  $s .= "<thead>\n";
  $line = fieldToThCell("Libelle").fieldToThCell("Nom").fieldToThCell("Commune").fieldToThCell("Adresse").fieldToThCell("Type").fieldToThCell("Etat").fieldToThCell("Etat Connexion").fieldToThCell("nb Vélos dispo").fieldToThCell("nb Places dispo");


  $s .= lineToTableLine($line);
  $s .= "</thead>\n";
  $s .= "<tbody>\n";

  for ($i=0; $i <count($fields) ; $i++) {

    $lat = $fields[$i]["localisation"][0];
    $lon = $fields[$i]["localisation"][1];
    $libelle= $fields[$i]["libelle"];
    //$libelle = fieldToCell($fields[$i]["libelle"]);

    $nom=$fields[$i]["nom"];
    $commune=$fields[$i]["commune"];
    $adresse = $fields[$i]["adresse"];
    $type = $fields[$i]["type"];
    $etat = $fields[$i]["etat"];
    $etatConnexion = $fields[$i]["etatconnexion"];


    $nbVelo = $fields[$i]["nbvelosdispo"];
    $nbPlace = $fields[$i]["nbplacesdispo"];

    //ajouter libelle!!!!!!!!!!!!et le reste!!!!!!!
    $data = array("lat"=>$lat, "lon"=>$lon, "nameStation"=>$nom, "etat"=>$etat, "connexion"=>$etatConnexion, "commune"=>$commune, "adresse"=>$adresse, "typeCB"=>$type, "velodispo"=>$nbVelo, "espace"=>$nbPlace , "libelle"=>$libelle );
    $line = fieldToCell($libelle).fieldToCell($nom).fieldToCell($commune).fieldToCell($adresse).fieldToCell($type).fieldToCell($etat).fieldToCell($etatConnexion).fieldToCell($nbVelo).fieldToCell($nbPlace);

    $s.= lineWithDataClasstoTabLine($line, $data);
  }
  $s .= "</tbody>\n";
  $s.="</table>\n";

  return $s;
}


 ?>
