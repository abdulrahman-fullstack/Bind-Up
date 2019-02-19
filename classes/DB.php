<?php
class DB {

   private static function connect(){
      $con = new PDO('mysql:host=127.0.0.1;dbname=bindup;charset=utf8' , 'root' , 'dvssa');
      return $con;
   }

   public static function query($query,$params=array()){
      $stmt = self::connect()->prepare($query);
      $stmt->execute($params);

      if(explode(' ',$query)[0]=='SELECT'){
         $data = $stmt->fetchAll();
         return $data;
      }
      return $stmt->rowCount();
   }
}

?>
