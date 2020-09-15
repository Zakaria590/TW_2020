<?php  // script principal
	//activer pour la partie 2
	if (filter_input(INPUT_GET, 'valid')===NULL){
			require ('views/formulaireStarWars.php');
			exit();
	}
	try {
		 require('lib/verifyParms.php');
		 //require('views/pageTest.php');       // mettre en commentaire pour la partie 2
		 require('views/pageFactureStarWars.php');   // activer pour la partie 2

 } catch (ParmsException $e){
		 $errorMessage = $e->getMessage();
			//require('views/pageTestErreur.php');  // mettre en commentaire pour la partie 2
			require('views/formulaireStarWars.php');  // activer pour la partie 2
}

?>