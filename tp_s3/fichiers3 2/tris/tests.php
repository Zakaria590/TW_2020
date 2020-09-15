<?php
header("Content-type: text/plain;charset=UTF-8");
require("lib/fonctionsComparaison.php");
/*$tab = array(6,0,-3,12,-15,25,-1,44,19,-8);
echo "tableau de nombres initial : ";
print_r($tab);
echo "tableau trié par la fonction sort : ";
sort($tab);
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison compareAbs : ";
usort($tab,'compareAbs');
print_r($tab);


$tab = array("abcd","00","bdef","efghij","z","aa","abcde","xyz");
echo "tableau de chaînes initial : ";
print_r($tab);
echo "tableau trié par la fonction sort : ";
sort($tab);
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison strcmp : ";
usort($tab, 'strcmp');
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison comparerChainesParLongueur";
usort($tab, 'comparerChainesParLongueur');
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison comparerChainesParLongueurPlus";
usort($tab, 'comparerChainesParLongueurPlus');
print_r($tab);*/

//require_once("../feuille2/lib/fonctionsLivre.php");
//$str = elementBuilder('header', elementBuilder('h1','Bibliothèque'));
$fd = fopen('../feuille2/data/livres.txt','r');
//$liste = loadBiblio($fd);
//print_r($liste);
//$tab = usort($liste, "compareLivreTitles");
//print_r($tab);
$tab = array(array("titre"=> "zz"), array("titre"=>"bb"));
print_r($tab);
function compareLivreTitles($livre1,$livre2){
  return strcmp($livre1["titre"],$livre2["titre"]);
}

usort($tab, "compareLivreTitles");
print_r($tab);



?>
