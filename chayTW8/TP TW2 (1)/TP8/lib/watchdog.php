<?php
session_start();
if(!isset($_SESSION['ident'])){ //visiteur non encore authentifié
  //$login=filter_input(INPUT_POST,'login');
  //$password=filter_input(INPUT_POST,'password');
  $person=NULL;
}if($login != '' || $password != ''){
  $person=$data->authentifier($login,$password);
  if($person==NULL){//mauvais login/password
    $_SESSION['echec']= true;
  }
}
if ($person==NULL) { //authentification echoué => inclusion page de login et sortie
  require('views/pageLogin.php');
  exit();
}else { //authentification réussie
  $_SESSION['ident']=$person;
  unset($_SESSION['echec']);
}

?>



/
