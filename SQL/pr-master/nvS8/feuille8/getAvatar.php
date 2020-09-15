<!-- Salah Zakaria OUAICHOUCHE -->
<?php


//download
require_once('lib/initDataLayer.php');
$avatar = $data->getAvatar($login);
if(!$avatar){
  $avatar = array();
  $avatar['mimetype']='image/png';
  $avatar['data']=fopen('./images/avatar_def.png','r');
}

affiche(fopen('./images/avatar_def.png','r'),'image/png');
exit;

function affiche($data,$mimetype){
  header('Content-Type: '.$mimetype);
  fpassthru($data);
}
?>
