<?php

session_start();

if (isset($_SESSION['ident']))  // si la page était protégée, on ne devrait même pas faire ce test
  return;

$args = new ArgSetAuthent();
if($args->isValid() && $args->login != ""){
  require_once('lib/initDataLayer.php');
  $identite = $data->authentifier($args->login,$args->password);
  if($identite){
    $_SESSION['ident'] = $identite;
    unset($_SESSION['echec']);
    return;
  }
  else{
    $_SESSION['echec'] = true;
  }
}

echo json_encode(['status'=>'error', 'message'=>'Échec de l\'authentification']);
exit();


?>
