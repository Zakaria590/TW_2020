<!-- Salah Zakaria OUAICHOUCHE -->
<?php

$args = new ArgSetCreateUser();
if($args->isValid()){
  require_once('lib/initDataLayer.php');
  $echec = $data->createUser($args->login,
                             $args->password,
                             $args->name,
                             $args->prenom);
  if(!$echec){
    require('views/pageCreateOK.php');
  }
  else{
    require('register.php');
  }

}



?>
