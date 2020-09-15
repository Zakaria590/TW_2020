<?php
// Produit le code SVG d'un cercle de centre ($cx,$cy) de rayon $r
function cercle($cx,$cy,$r){
    return "<circle cx=\"$cx\" cy=\"$cy\" r=\"$r\" />";
}

function carreInscrit($cx,$cy,$l,$angle=0){
  $lbis=$l*sqrt(2);
  $cxbis=$cx-($lbis/2);
  $cybis=$cx-($lbis/2);
  return "<rect x=\"$cxbis\" y=\"$cybis\" width=\"$lbis\" height=\"$lbis\"  transform=\"rotate($angle,$cxbis,$cybis)\"/>";

}
function triangleInscrit($cx,$cy,$r,$angle=0){
  $p1=$cx;
  $p2=$cy+$r;
  $p3=$cx - ($r*sqrt(3))/2;
  $p4=$cx - $r/2;
  $p5=$cx + ($r*sqrt(3))/2;
  $p6=$cy - $r/2;
  return "<polygon points=\" $p1 $p2 $p3 $p4 $p5 $p6\" />";

}

?>
