<?php


/**
 *
 */
class DataLayer
{
  private $connexion;

  // établit la connexion à la base en utilisant les infos de connexion des constantes DB_DSN, DB_USER, DB_PASSWORD
  // susceptible de déclencher une PDOException
  public function __construct()
  {
    $this->connexion = new PDO(
               DB_DSN, DB_USER, DB_PASSWORD,
               [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // déclencher une exception en cas d'erreur
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // chaque ligne du résultat sera une table associative
               ]
             );
  }
  //s’il existe dans s8_users un utilisateur avec le login ET le mot de passe fournis, alors le résultat
  //est une instance de la classe Identite avec les informations concernant cet utilisateur.
  //sinon le résultat est NULL.
  function authentifier($login, $password){
    $sql = <<<EOD
        select login , password
        from s8_users
        where login=:login and password=:password
EOD;
        $stmt = $this->connexion->prepare($sql);
        $strmt->bindValue(':login',$login);
        $strmt->bindValue(':password',$password);
        $stmt->execute();                        
        $info = $stmt->fetch();
        if($info){
          return new new Identite($info['login',$info['nom'],$info['prenom']]);
        }else{
          return NULL;
        }
  }
  }


  /*function authentifier($login, $password){
    $result = mysql_query("SELECT * FROM s8_users ");
  if (!$result) {
     echo 'Impossible d\'exécuter la requête : ' . mysql_error();
     exit;
  }
  $row = mysql_fetch_row($result);//tab php
  if($row[0]==$login && $row[1]==$password){
    Identite $identite= new Identite($row[0],$row[2],$row[3]);
    return $identite;
  }else{
    return NULL;
  }*/





 ?>
