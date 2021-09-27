<?php
   session_start();
   // Title of this page
   $title = "Login";
   // Import the required filess of this page
   require "../config.php";
   require "func.php";
   include "include/header.php";

   if(isset($_SESSION['adminid'])) {
      header("location: dashboard.php");
   }
?>

   <section class="login">
      <div id="msg"></div>
      <div class="logo">
         <img src="../images/logo.png" alt="Logo">
      </div>
      <form class="form" onsubmit="return false">
         <div class="mb-3">
            <label for="inputEmail1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control input-login" id="inputEmail1" aria-describedby="emailHelp" autocomplete="OFF">
         </div>
         <div class="mb-3">
            <label for="inputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control input-login" id="inputPassword1">
         </div>
         <button class="btn btn-primary w-100" id="botn" onclick="login()">Login</button>
      </form>
      
   </section>

<?php
   include "include/footer.html";
?>
<!-- AJAX Requests -->
<script src="js/requests/login-request.js"></script>