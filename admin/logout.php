<?php 
   session_start();
   // Delete the cookie of first time login
   setcookie("first_login", "", time() - 3600);

   session_unset();
   session_destroy();

   header("location: index.php");
   exit();
?>