<?php
   session_start();
   require "../../config.php";
   if ($_SERVER["REQUEST_METHOD"] == "POST") { 
      // Get data form
      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $pass     = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

      $stmt = $con->prepare("SELECT * FROM users WHERE UserName = ? AND Member_type = ?");
      $stmt->execute(array($username, 1));
      $rows = $stmt->fetch();
      
      // Form Validate
      $form_error = array();
      if(empty($username) && empty($pass)){
         $form_error[] = "Please Enter Your Username and Password";
      } elseif(empty($username)){
         $form_error[] = "Please Enter the Username";
      } elseif(empty($pass)){
         $form_error[] = "Please Enter the password";
      }
      // Print the error if exist
      foreach($form_error as $error){
         echo "<div class='container alert-msg'>";
            echo "<div class='alert alert-danger'><i class='bx bxs-comment-error'></i>" . $error . "</div>";
         echo "</div>";
      }
      if(empty($form_error)){
         // check if username exist in database
         if ($stmt->rowCount() > 0) {
            // Verify Password if true or false
            if(password_verify($pass, $rows['Password'])){
               $_SESSION['adminid'] = $rows['UserID'];
            } else{
               echo "<div class='container alert-msg'>";
                  echo "<div class='alert alert-danger'><i class='bx bxs-comment-error'></i>Password is wrong</div>";
               echo "</div>";
            }
         } else {
            echo "<div class='container alert-msg'>";
               echo "<div class='alert alert-danger'><i class='bx bxs-comment-error'></i>Username is wrong</div>";
            echo "</div>";
         }
      }
   }
?>