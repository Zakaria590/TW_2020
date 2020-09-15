<?php
// Produit le code SVG d'un cercle de centre ($cx,$cy) de rayon $r
function cercle($cx,$cy,$r){
    return "<circle cx=\"$cx\" cy=\"$cy\" r=\"$r\" />";
}

function carreInscrit($cx, $cy, $r, $angle=0) {
	$cote = $r*sqrt(2);
	$x = $cx - ($cote/2);
	$y = $cy - ($cote/2);
	return"<rect x=\"$x\" y=\"$y\" width=\"$cote\" height=\"$cote\" transform=\"rotate($angle,$cx $cy)\"/>";
}
/*
function triangleInscrit($cx, $cy, $r,$angle=0){

	$cote = $r*sqrt(3);
	$x0 = $cx;
	$y0 = $cy + $r;
	$x1 = $cx - $cote/2;
	$y1 = $cy - $r/2;
	$x2 = $cx + $cote/2;
	$y2 = $y1;
	return "<polygon points=\"$x0,$y0 $x1,$y1 $x2,$y2 \" transform=\"rotate($angle,$cx,$cy)\"/>";
}*/

function triangleInscrit($cx,$cy,$r,$angle=0){
	$a= $cy + $r;
	$b= ($cx -$r*sqrt(3)/2);
	$c= ($cy - $r/2);
	$d= ($cx +$r*sqrt(3)/2);
	return "<polygon points= \"$cx $a $b $c $d $c\" transform=\"rotate($angle,$cx,$cy)\" />";
}
?>