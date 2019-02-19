<?php

class DB {

   private $pdo;

   public function __construct($host,$dbname,$user,$pass){
      $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8" , $user , $pass);
      $this->pdo = $pdo;
   }

   public function query($query,$params=array()){
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);

      if(explode(' ',$query)[0]=='SELECT'){
         $data = $stmt->fetchAll();
         return $data;
      }
      return $stmt->rowCount();
   }
}

?>
