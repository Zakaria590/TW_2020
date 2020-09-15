<?php
try{
  require('lib/verifyParms.php');
  //require('views/pageVlille.php');
  require('lib/functions.php');
  require('views/formulaireVlille.php');

}catch (ParmsException $e){
  $errorMessage = $e->getMessage();
	require('views/formulaireVlille.php');
}
 ?>
