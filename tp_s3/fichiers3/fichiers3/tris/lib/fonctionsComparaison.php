<?php
//Salah Zakaria OUAICHOUCHE Groupe3
function compareAbs($x, $y){
$cmp = abs($x)-abs($y);
if ($cmp != 0)
  return $cmp;
else
  return $x - $y;
}

function comparerChainesParLongueur($str1,$str2){
  return strlen($str1)-strlen($str2);
}

function comparerChainesParLongueurPlus($str1,$str2){
  $cmp = comparerChainesParLongueur($str1,$str2);
  if ($cmp!=0)
    return $cmp;
  else
    return strcmp($str2,$str1);
}
?>
