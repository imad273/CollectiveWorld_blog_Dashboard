<?php
   session_start();
   // Import the required filess of this page
   require "../../config.php";

   $link = isset($_GET['action']) ? $_GET['action'] : false;
   if ($link == 'show-settings') { 
      $id = $_SESSION['adminid'];
      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");
      $stmt->execute(array($id));
      $ftc = $stmt->fetch(); ?>

      <form onsubmit="return false" class="mt-3">
         <div class="mb-3">
            <label for="input1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control input-profile" id="input1" value="<?php echo $ftc['UserName'] ?>">
         </div>
         <div class="mb-3">
            <label for="input2" class="form-label">First Name</label>
            <input type="text" name="firstName" class="form-control input-profile" id="input2" value="<?php echo $ftc['FirstName'] ?>">
         </div>
         <div class="mb-3">
            <label for="input3" class="form-label">Last Name</label>
            <input type="text" name="lastName" class="form-control input-profile" id="input3" value="<?php echo $ftc['LastName'] ?>">
         </div>
         <div class="mb-3">
            <label class="form-label d-block">Password</label>
            <a href="settings.php?action=change-pass" class="btn btn-danger">Change The Password</a>
         </div>
         <div class="submit">
            <button class="btn btn-primary" onclick="save_data()">Save</button>
         </div>
      </form>
<?php
   } elseif ($link == 'insert-data') {
      $id = $_SESSION['adminid'];
      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");
      $stmt->execute(array($id));
      $ftc = $stmt->fetch();

      $username   = $_POST['username'];
      $firstName  = $_POST['firstName'];
      $lastName   = $_POST['lastName'];
      
      if($username == $ftc['UserName'] && $firstName == $ftc['FirstName'] && $lastName == $ftc['LastName']) {
         echo "<div class='container alert-msg'>
            <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>No Update to Save</div>";
         echo "</div>";
      } else {
         $stmt = $con->prepare("UPDATE users SET UserName = ?, FirstName = ?, LastName = ? WHERE UserID = '$id'");
         $stmt->execute(array($username, $firstName, $lastName)); 

         echo "<div class='container alert-msg'>
                  <div class='alert alert-success'><i class='bx bxs-comment-check'></i>Update Save</div>
               </div>";
      }
   
   } elseif ($link == 'change-pass') {
      $id = $_SESSION['adminid'];
      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");
      $stmt->execute(array($id));
      $ftc = $stmt->fetch();

      $crt_pass = $_POST['cur-pass'];
      $new_pass = $_POST['new-pass'];
      $cnf_pass = $_POST['con-pass'];

      if(empty($crt_pass) && empty($new_pass) && empty($cnf_pass)) {
         echo "<div class='container alert-msg'>
         <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>No Update To Save</div>";
         echo "</div>";
      } else {
         if(password_verify($crt_pass, $ftc['Password'])) {
            if(empty($new_pass) && empty($cnf_pass)) {
               echo "<div class='container alert-msg'>
                  <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>Please Enter a new Password</div>";
               echo "</div>";
            } else {
               if($new_pass === $cnf_pass) {

                  $new_pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                  $stmt = $con->prepare("UPDATE users SET Password = ? WHERE UserID = '$id'");
                  $stmt->execute(array($new_pass_hash)); 

                  echo "<div class='container alert-msg'>
                           <div class='alert alert-success'><i class='bx bxs-comment-check'></i>Password Changed Successfully</div>
                        </div>";

               } else {
                  if(empty($cnf_pass)) {
                     echo "<div class='container alert-msg'>
                        <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>Please Enter The Confirm Field</div>";
                     echo "</div>";
                  } else {
                     echo "<div class='container alert-msg'>
                     <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>The New Password not match With The Confirm Field</div>";
                     echo "</div>";
                  }
                  
               }
            }
         } else {
            echo "<div class='container alert-msg'>
            <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>Current Passwod is Wrong</div>";
            echo "</div>";
         }
      }
   }
