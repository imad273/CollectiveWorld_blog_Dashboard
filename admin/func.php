<?php 
   require "../config.php";
   /* *Set Title of pages Function */
   function setTitle () {
      global $title;
      if(isset($title)){
         echo $title;
      } else {
         echo "Default";
      }
   }

   /* *Count items fuction */
   function countItem($item, $table) {
      global $con;
      $stmt = $con->prepare("SELECT COUNT($item) FROM $table");
      $stmt->execute();
      echo $stmt->fetchColumn();
   }

   
?>