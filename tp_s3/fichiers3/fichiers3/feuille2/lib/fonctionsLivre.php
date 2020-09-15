<?php
//Salah Zakaria OUAICHOUCHE Groupe3
/*renvoie une table de table php représentant un livre dont les clés sont les noms
des propriétés.
*/
  /*function readBook($file){
    $ligne = fgets($file);
    $tab = array();
    while ($ligne!==FALSE && trim($ligne)!=""){
      if(strpos($ligne,":")!==FALSE){
        $ligneTab = explode(":",$ligne);
        $tab[trim($ligneTab[0])]= trim($ligneTab[1]);
      }
      else{
        throw new Exception("Livre erroné");

      }
      $ligne = fgets($file);
    }
    return $tab;
  }*/


  /*renvoie une table php représentant un livre dont les clés sont les noms
  des propriétés.
  */
  function readBook($file){
    $str = fgets($file);
    if ($str==FALSE)
      return FALSE;
    else {
      $i=0;
      while ($str!=FALSE) {
        if (trim($str)==""){
          $str=fgets($file);
          $i+=1;
          $found = FALSE;
        }
        else {
          $pos = strpos($str, ":");
          if ($pos==FALSE){
            throw new Exception("La description de ligne est incorrecte");
          }
          else{
            $tabLigne = explode(":", $str);
            $propriete[$i][trim($tabLigne[0])]=trim($tabLigne[1]);
            $str = fgets($file);
            $found = TRUE;
            }
        }
      }
    }
    if (!$found)
      return $found;
    else
      return $propriete;

  }

  /*
  retourne une chaine contenant le code HTML d'un element de type $elementType
  et de contenu $content
  */
  function elementBuilder($elementType, $content, $elementClass=""){
    $ifClass = ($elementClass=="")? "" : "class=".$elementClass;
    return "<".$elementType." ".$ifClass.">".$content."</".$elementType.">";
  }
  /*
  renvoie une chaine contenant le code HTML représentant les auteurs.
  */
  function authorsToHTML($authors){
    $tab = explode("-",$authors);
    return "<span>".implode("</span><span>",$tab)."</span>";
  }

  /*
  retourne une chaine de caractere contentant le code HTML représentant l'image
  de couverture
  */
  function coverToHTML($fileName){
    return '<img src="couvertures/'.$fileName.'" alt="image de couverture" />';
  }

  /*
  renvoie une chaine de caractere contentant le code HTML représentant la proprieté
  */
  function propertyToHTML($propName, $propValue){
    if ($propName=="titre")
      return elementBuilder('h2',$propValue,$propName);
    elseif ($propName=="couverture")
      return elementBuilder('div',coverToHTML($propValue),$propName);
    elseif ($propName=="auteurs")
      return elementBuilder('div',authorsToHTML($propValue),$propName);
    elseif ($propName=="année")
      return elementBuilder('time',$propValue, $propName);
    else
      return elementBuilder('div',$propValue,$propName);
  }
  /*
  renvoie une chaine de caractère qui contient le code HTML d'un element article
  et qui décrit un livre
  */
  function bookToHTML($book){
    //if $book !==FALSE
    $str = "";
    foreach ($book as $key => $value) {
      if ($key!="couverture")
        $str.=propertyToHTML($key,$value);
      else
        $s=propertyToHTML($key,$value);
    }
    $str = propertyToHTML("description",$str);
    $s.=$str;
    return elementBuilder("article",$s,"livre");
  }

  /*
  renvoie une chaine de caractère qui contient le code HTML présentant l'ensemble
  des livres du fichier deja ouvert sur le descripteur $file
  */
  function libraryToHTML($file){
    $p = readBook($file);
    $str = "";
    for ($i=0; $i<count($p); $i++){
      $str.=bookToHTML($p[$i]);
    }
    return $str;
  }

 /* function loadBiblio($file){
    $srt= array();
  $book= readBook($file);
  while ($book != false) {
    $srt[]=$book;
    $book=readBook($file);
  }
  return $srt;
}*/

  function loadBiblio($file){
    return readBook($file);
  }


  function biblioToHTML($liste, $sort="none"){
    if ($sort == "none"){
      $tab = $liste;
    }
    elseif ($sort== "titles") {
      $tab = $liste;
      usort($tab, "compareLivreTitles");
    }
    elseif ($sort== "categories"){
      $tab = $liste;
      usort($tab, "compareLivres");
    }
    else {
      throw new Exception("invalid sort");

    }
    $str = "";
    for ($i=0; $i<count($tab); $i++){
      $str.=bookToHTML($tab[$i]);
    }
    return $str;
  }

  function compareLivreTitles($livre1,$livre2){
    return strcmp($livre1["titre"],$livre2["titre"]);
  }

  function compareLivres($livre1, $livre2){
    $cmp1 = strcmp($livre1["catégorie"], $livre2["catégorie"]);
    if ($cmp1!=0)
      return $cmp1;
    else {
      $cmp2 = strcmp($livre1["année"], $livre2["année"]);
      if ($cmp2!=0)
        return $cmp2;
      else {
        return compareLivreTitles($livre1,$livre2);
      }
    }
  }
?>
