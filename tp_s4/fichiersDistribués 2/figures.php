
<?php

 require('lib/fonctionsSVG.php');

$erreur =False;

if (isset($_GET['centreX']) && is_numeric($_GET['centreX'])) {
	$centreX = $_GET['centreX'];
}else{
	$erreur = TRUE;	
}

if (isset($_GET['centreY']) && is_numeric($_GET['centreY'])) {
	$centreY = $_GET['centreY'];
}else{
	$erreur = TRUE;	
}

if (isset($_GET['rayon']) && is_numeric($_GET['rayon'])) {
	$rayon = $_GET['rayon'];
}else{
	$erreur = TRUE;	
}

if (isset($_GET['angle'])) {
	if (is_numeric($_GET['angle'])) {
		$angle = $_GET['angle'];
	}
	else {
		$erreur=TRUE;
	}
} else {
	$angle =0;
}

const FIGURES = ["cercle","carre","triangle"];

$figAllowed = FIGURES;
$figAllowed[] = "all";

if (isset($_GET['fig']) && $_GET['fig']!="") {
	if (! in_array($_GET['fig'], $figAllowed)) {
		$erreur = TRUE;
	}
	$fig = $_GET['fig'];
}
else{
	$fig = 'all';
}
if ($fig == 'all') 
	$toDraw = FIGURES;
else
	$toDraw = [$fig];
if ($erreur)
	require("views/pageErreur.html");
else
	require('views/pageFigures.php');
?>
