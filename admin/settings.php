<?php
   session_start();
   // Title of this page
   $title = "Settings";
   // Import the required filess of this page
   require "func.php";
   require "../config.php";
   include "include/header.php";

   // check if there is a session or not
   if (isset($_SESSION['adminid'])) {
      $link = isset($_GET['action']) ? $_GET['action'] : 'manage';
      if ($link == 'manage') {  ?>
         <div class="posts">
            <?php
               // Import Navbar file
               include "include/navbar.php";
            ?>

            <div class="content" id="content">
               <div id="msg"></div>
               <div class="header">
                  <h3>Settings</h3>
               </div>
               <div class="settings">
                  <div class="header">
                     <h3>Profile</h3>
                  </div>
                  <div id="form">
                     
                  </div>
               </div>
            </div>
         </div>   
   <?php
      } elseif ($link == 'change-pass') { ?>
         <div class="posts">
            <?php
               // Import Navbar file
               include "include/navbar.php";
            ?>

            <div class="content" id="content">
               <div id="msg"></div>
               <div class="settings">
                  <div class="header">
                     <h3>Cahnge Password</h3>
                  </div>
                  <div class="pass">
                     <form onsubmit="return false" class="mt-3">
                        <div class="mb-3">
                           <label for="input1" class="form-label">Current Password</label>
                           <input type="password" name="cur-pass" class="form-control input-pass" id="input1" autocomplete="OFF">
                        </div>
                        <div class="mb-3">
                           <label for="input2" class="form-label">New Password</label>
                           <input type="password" name="new-pass" class="form-control input-pass" id="input2" autocomplete="OFF">
                        </div>
                        <div class="mb-3">
                           <label for="input3" class="form-label">Confirm Password</label>
                           <input type="password" name="con-pass" class="form-control input-pass" id="input3" autocomplete="OFF">
                        </div>
                        <div class="submit">
                           <button class="btn btn-primary" onclick="Change_pass()">Save</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
   <?php
      }
   } else {
      // when there's no session or admin comming from a external link
      header("location: index.php");
   }

   include "include/footer.html";
?>
<script>
   // Show Posts request
   const show_settings = () => {
      var request = new XMLHttpRequest();
      request.open("POST", "requests PHP/settings-requests.php?action=show-settings", true);

      request.onreadystatechange = function() {
         if (request.readyState === 4 && request.status === 200) {
            if (document.getElementById("form") != null) {
               document.getElementById("form").innerHTML = request.responseText;
            }
         }
      }
      request.send();
   }
   window.addEventListener('load', show_settings());
</script>
<!-- AJAX Requests For settings -->
<script src="js/requests/settings-requests.js"></script>