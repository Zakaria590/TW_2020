<!-- Salah Zakaria OUAICHOUCHE -->
<?php
/**
Classe gérant des paramètres d'identification pour un nouveau utilisateur.
 - login : obligatoire, chaîne non vide
 - password : obligatoire, chaîne non vide
 - nom : obligatoire, chaîne non vide
 - prenom : obligatoire, chaîne non vide
*/
class ArgSetCreatUser extends AbstractArgumentSet{

  protected function definitions() {
     $this->defineNonEmptyString('login');
     $this->defineNonEmptyString('password');
     $this->defineNonEmptyString('nom');
     $this->defineNonEmptyString('prenom');
  }

}
?>
