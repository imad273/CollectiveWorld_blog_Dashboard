<?php
   $dsn = "mysql:host=localhost;dbname=clcworld";
   $user = "root";
   $password = "";
 
   try{
      $con = new PDO($dsn, $user, $password);
   } catch (PDOException $e){
      echo "error: " . $e->getMessage();
   }

?>