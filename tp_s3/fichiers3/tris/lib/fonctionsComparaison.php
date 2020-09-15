<?php
require("fonctionsLivre.php");
   function compareAbs($i,$j){
      return abs($i)-abs($j);
}
  function coparestrcmp($i,$j){
      return strcmp($i, $j);
  }

  /*function comparerChainesParLongueur($i,$j){
    return strlen($i)-strlen($j);
}

function comparerChainesParLongueurplus($i,$j){
  $res = strlen($i)-strlen($j);
  if ($res == 0){
    return strcmp($j,$i);
  }else{
    return $res;
  }
}

  function loadBiblio($file){
    $res= array();
  $book= readBook($file);
  while ($book != false) {
    $res[]=$book;
    $book=readBook($file);
  }
  return $res;
}
function biblioToHTML($liste){
  $res ="";
  foreach ($liste as $book) {
  $res.=bookToHTML($book);
  }
return $res;
}

function comparelivres($i,$j){
  return strcmp($i["titles"],$j["titles"]);
}*/
?>
