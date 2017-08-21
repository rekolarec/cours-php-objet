<?php
class CRUD{ // créer, lire, mettre à jour et supprimer
  private $host;
  private $user;
  private $password; 
  public $database;
  private $pdo;

  function __construct($host, $user, $password, $database){
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
    $this->database = $database;
    $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->user,$this->password, 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));// mettre un ERRMODE_WARNING pour avoir un message erreur php
  }

  public function select($champs = '*', $table = '', $where){
      $theChamps = $this->arrayToString($champs); 
    $theWhere =$this->arrayToString($where,3); 
    $result = $this->pdo->query("SELECT $theChamps FROM $table WHERE $theWhere");
    return $result->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($data);
    //die();// arret total du script
  }


  // fonction d'insertion
  public function insert($champs = '*', $valeu, $table = ''){
    $theChamps = $this->arrayToString($champs);
    $theValeu = $this->arrayToString($valeu, 2);
  try{
    $result = $this->pdo->prepare("INSERT INTO $table ($theChamps) VALUE ($theValeu)");
    
    $result->execute();
    //$data = $result->fetchAll(PDO::FETCH_ASSOC);
    echo $this->pdo->lastInsertId();
  }catch(Exception $e){
    echo 'Votre traitement n\a pas aboutit : ', $e->getMessage(), "\n" ;  
  }
 
}

// requete de suppression

  public function delete($champs, $table = ''){
    $theChamps = $this->arrayToString($champs,3);
  try{
     $result = $this->pdo->prepare("DELETE FROM $table WHERE $theChamps");
    
     $result->execute();
    echo $theChamps;
  }catch(Exception $e){
    echo 'Votre traitement n\a pas aboutit : ', $e->getMessage(), "\n" ;  
  }
 
}

// requete d'Update

public function update($champs, $where, $table = ''){
  $theChamps = $this->arrayToString($champs,4);
  $where = $this->arrayToString($where,3);
try{
   $result = $this->pdo->prepare("UPDATE $table SET $theChamps WHERE $where");
  
   $result->execute();
}catch(Exception $e){
  echo 'Votre traitement n\a pas aboutit : ', $e->getMessage(), "\n" ;  
}

}

//****************** on fait une fonction pour traiter le tableau ...
private function arrayToString($champs, $type ="select"){
  $theChamps ="";
  /* cas ou chanps est un tableau*/
  if(is_array($champs)){
    if($type == 1)
        foreach ($champs as $valeu )
        $theChamps = $theChamps.$valeu.',';

      elseif ($type == 3){
        foreach ($champs as $key=>$valeu )
          $theChamps = $theChamps.$key."='".$valeu."' AND ";
        $theChamps = substr($theChamps,0,-4);
      } 
      elseif ($type == 4 ){
        foreach ($champs as $key=>$valeu )
          $theChamps = $theChamps.$key."='".$valeu."',";
      }else 
          foreach ($champs as $valeu )
            $theChamps = $theChamps."'".$valeu."',";
          $theChamps = substr($theChamps,0,-1);
    
  
}else 
  $theChamps = $champs;

  return $theChamps;
}


}


// requete affichage
$bd = new CRUD("localhost","root","","mike-js");
 //$bd->select(array("nom","prenom"), "users");

// requete insertion
//$bd = new CRUD("localhost","root","","mike-js");
//$bd->insert(array("nom","prenom"),array("cale","marie"),"users");


// requete de suppression
//$bd->delete(array("nom"=>"gn"),"users");

// requete d'update
$bd->update(array("nom"=>"jerome"),array("id"=>"2"),"users");

  
  // commande dans le shell
// installer le git shell...

// vérifier la bonne installation de git
// git puis entrée

// localisation du fichier d'emplacement
// cd C:\xwamp\...

// vérifier avec dir
// dir puis entrée

// vérifier la connexion 
// git status 

// ajoute à la file d'attente
// git add -A

// préparer un fichier 
// git commit -m

// envoi
// git push