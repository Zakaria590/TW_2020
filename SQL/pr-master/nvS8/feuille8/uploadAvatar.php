<!-- Salah Zakaria OUAICHOUCHE -->
<?php
spl_autoload_register(function ($className) {
     require_once("lib/{$className}.class.php");
 });
require('lib/watchdog_service.php');

//création des différents attribut nécessaire à l'upload
$login = $_SESSION['ident']->login;
$imageSpec = array();
$imageSpec['mimetype'] = $_FILES['image']['type'];
$imageSpec['data'] = fopen($_FILES['image']['tmp_name'],'r');

//upload
require_once('lib/initDataLayer.php');
$success = $data->storeAvatar($imageSpec,$login);

if($success){
  echo json_encode(['status'=>'ok']);
}
else{
  echo json_encode(['status'=>'error', 'message'=>'Échec de l\'upload']);
}


?>
