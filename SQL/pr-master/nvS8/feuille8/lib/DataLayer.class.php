<!-- Salah Zakaria OUAICHOUCHE -->
<?php
/**
Classe destiné à recevoir une instance de la classe PDO
Elle posséde des méthodes afin de faire une requete SQL
*/
class DataLayer {

  //déclaration de l'attribut $connexion
  private $connexion;

  public function __construct(){
    //initialiser la connexion

    $this->connexion = new PDO(
        DB_DSN, DB_USER, DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
  }

  /*
   * tente d'authentifier un utilisateur, renvoie une Identite ou null
   * paramètres:
   *            $login : le login d'un utilisateur
   *            $password : son mot de passe (empreinte blowfish)
   *
   * résultat : Identite, un utilisateur
   *            ou null si l'authentification à échouer
   */
  public function authentifier($login,$password){
    $SQL = <<<EOD
    SELECT
    nom, prenom, login, password
    FROM
    s8_users
    WHERE login = :login
EOD;
    //prepare la requete
    $stmt = $this->connexion->prepare($SQL);
    $stmt->bindValue(':login',$login);
    //l'execute
    $stmt->execute();
    //initialise la variable de retour
    $res = $stmt->fetch();
    //nous devons avoir un utilisateur
    if($res && crypt($password, $res['password']) == $res['password']){
      return new Identite($res['login'],$res['nom'],$res['prenom']);
    }
    else{
      return null;
    }
  }

  /*
   * Enregistre un avatar pour l'utilisateur $login
   * paramètres:
   *            $login : le login de l'utilisateur
   *            $password : son mot de passe (empreinte blowfish)
   *            $name : son nom
   *            $prenom : son prenom
   *
   * résultat : booléen indiquant si l'opération s'est bien passée
   */
  public function createUser($login,$password,$name,$prenom){
    $SQL = <<<EOD
    INSERT INTO
    s8_users(login,password,name,prenom)
    values (':login',':password',':name',':prenom');
EOD;
    //prepare la requete
    $stmt = $this->connexion->prepare($SQL);
    $stmt->bindValue(':login',$login);
    $stmt->bindValue(':name',$name);
    $stmt->bindValue(':prenom',$prenom);
    //on crée l'empreinte
    $empreinte = password_hash($password,CRYPT_BLOWFISH);
    $stmt->bindValue(':password',$empreinte);
    //tente de l'executer
    try{
      $stmt->execute();
      return $stmt->rowCount() == 1;
    }
    catch (PDOException $e){
      return false;
    }
  }

  /*
   * Enregistre un avatar pour l'utilisateur $login
   * paramètre $imageSpec : un tableau associatif contenant deux clés :
   *                        'data' : flux ouvert en lecture sur les données à stocker
   *                        'mimetype' : type MIME (chaîne)
   * résultat : booléen indiquant si l'opération s'est bien passée
   */
  public function storeAvatar($imageSpec, $login){
    $SQL = <<<EOD
    UPDATE
    s8_users
    SET
    mimetype = :mimetype,
    avatar = :avatar
    WHERE login = :login;
EOD;
    //prepare la requete
    $stmt = $this->connexion->prepare($SQL);
    $stmt->bindValue(':mimetype',$imageSpec['mimetype']);
    $stmt->bindValue(':avatar',$imageSpec['data'], PDO::PARAM_LOB);
    $stmt->bindValue(':login',$login);

    //tente de l'executer
    try{
      $stmt->execute();
      return $stmt->rowCount() == 1;
    }
    catch (PDOException $e){
      return false;
    }
  }

  /*
   * Récupère l'avatar de l'utilisateur $login
   * résultat : un tableau associatif contenant deux clés :
   *            'data' : flux ouvert en lecture sur les données à stocker
   *            'mimetype' : type MIME (chaîne)
   * ou FALSE en cas d'échec
   */
  public function getAvatar($login){
    $SQL = <<<EOD
    SELECT
    avatar, mimetype
    FROM
    s8_users
    WHERE login = :login
EOD;
    //prepare la requete
    $stmt = $this->connexion->prepare($SQL);
    $stmt->bindValue(':login',$login);
    $stmt->bindColumn('avatar', $data, PDO::PARAM_LOB);
    $stmt->bindColumn('mimetype', $mimetype);
    try{
      //l'execute
      $stmt->execute();
      $result = $stmt->fetch();
      if($result){
        $res = array('mimetype' => $mimetype,
                     'data' => $data);

        return $res;
      }
      else{
        return false;
      }
    }
    catch (PDOException $e){
      return false;
    }
  }
}
?>
