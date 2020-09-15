<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
   <title>formulaireVlille</title>
   <meta charset="UTF-8" />
   <link rel="stylesheet" href="lib/style.css" />
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
   <script src='scriptCarteVLille.js'></script>

</head>


 <body>
   <?php
      function valuesToHTML($name, $values){

        $s='<div class="'.$name.'">'."\n";
        $s.= '<fieldset id="'.$name.'">'."\n";
        $s.='<legend>'.strtoupper($name).'</legend>'."\n";
        for ($i=0; $i<count($values);$i++){
          $id = '"'.$name.$i.'"';
          $value = '"'.$values[$i].'"';
          $s.='<label for='.$id.'>'. $values[$i].'</label>';
          $s.= '<input type="checkbox" name="'.$name.'[]" id='.$id. 'value='.$value.'/></br>';

        }
        $s.= "</fieldset>\n";
        $s.= "</div>\n";
        return $s;

      }
    ?>
    <?php
    if (isset($errorMessage)){
    	echo "<section id='errorMessage'>\n";
   		echo "  	<p> Erreur : $errorMessage</p>\n"; // à améliorer
    	echo "</section>\n";
   }

  ?>
   <form action="vlille.php" method = "get">
     <fieldset id ="libelle">
        <label for="libelle"> libelle </label>
        <input type="text" name="libelle" id="libelle">

        <label for="nom"> Nom </label>
        <input type="text" name="nom" id="nom">

        <label for="commune"> Commune </label>
        <input type="text" name="commune" id="commune">

        <label for="adresse"> Adresse </label>
        <input type="text" name="adresse" id="adresse">

        <?php
        function listToCheckBox($name, $values){
          for ($i=0;$i<count($values);$i++){
            $value = '"'.$values[$i].'"';
            echo '<label for='.$value.'>'. $values[$i].'</label>'."\n";
            echo '<input type="checkbox" name="'.$name.'[]" id='.$value. 'value='.$value.'/>';
          }
        }
        listToCheckBox('type', TYPES);
        listToCheckBox('etat', ETATS);
        listToCheckBox('etatconnexion', ETATCONNEXIONS);
         ?>

         <label for="nbvelosdispo"> nb Vélos disponibles </label>
         <input type="text" name="nbvelosdispo" id="nbvelosdispo">

         <label for="nbplacesdispo"> nb places disponibles </label>
         <input type="text" name="nbplacesdispo" id="nbplacesdispo">
         <fieldset>
           <p> Trier par </p>

           <label for="libelle"> Libelle </label>
           <input type="radio" name="tri" id="libelle" value="libelle" selected="selected">

           <label for="nom"> Nom </label>
           <input type="radio" name="tri" id="nom" value="nom">

           <label for="commune"> Commune </label>
           <input type="radio" name="tri" id="commune" value="commune">

           <label for="adresse"> Adresse </label>
           <input type="radio" name="tri" id="adresse" value="adresse">

           <label for="nbVelos"> Nb Vélos dispo </label>
           <input type="radio" name="tri" id="nbVelos" value="nbVelos">

           <label for="nbPlaces"> Nb places dispo </label>
           <input type="radio" name="tri" id="nbPlaces" value="nbPlaces">
        </fieldset>

     </fieldset>

     <fieldset>
      <button type="reset">Effacer</button>
      <button type="submit" name="valid" value="envoyer">Envoyer</button>
    </fieldset>



   </form>

   <?php
   //codition pour les autres fonctions d'affichage à tester
   if (isset($fields2))
    echo fieldsToTable($fields2);
    ?>

    <section id= 'GrandeCarte'>
		    <div id='carteVLille'></div>

	<section id='infoComplete'>
	<div id='miniCarte'></div>


		<p id='Informations'></p>
	</section>
	</section>






</body>
