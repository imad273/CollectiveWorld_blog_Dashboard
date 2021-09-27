<?php
   session_start();
   // Title of this page
   $title = "Users";
   // Import the required filess of this page
   require "func.php";
   require "../config.php";
   include "include/header.php";

   // check if there is a session or not
   if (isset($_SESSION['adminid'])) {
      $link = isset($_GET['action']) ? $_GET['action'] : 'manage';
      if($link == 'manage') { ?>
         <div class="users">
            <?php
               // Import Navbar file
               include "include/navbar.php";
            ?>
            <div class="content" id="content">
               <div class="header">
                  <h3>Manage Users</h3>
               </div>
               <div class="show-users">
                  <div class="header">
                     <h3>All Users: <?php countItem('UserID', 'users') ?></h3>
                     <div class="search-field">
                        <input type="text" class="search" name="search" oninput="search_users()" autocomplete="OFF" placeholder="Search"><button><i class='bx bx-search-alt'></i></button>
                     </div>
                  </div>
                  <div class="res">
                     <div class="table-responsive">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">Username</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Full Name</th>
                                 <th scope="col">Date Regester</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody id="table">
                              
                           </tbody>
                        </table>
                     </div>
                     <div class="load-more">
                        <button class="btn btn-primary" id="lm-btn" onclick="load_more()">Load More</button>
                     </div>
                  </div>
                  <?php
                     $stmt2 = $con->prepare("SELECT COUNT(*) FROM users WHERE Member_type = 0");
                     $stmt2->execute();
                     $rows = $stmt2->fetchColumn();  ?>
                     <input type='hidden' id='all' name='all' value='<?php echo $rows ?>'>
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
   const show_users = () => {
      var request = new XMLHttpRequest();
      request.open("POST", "requests PHP/users-requests.php?action=show-users", true);

      request.onreadystatechange = function() {
         if (request.readyState === 4 && request.status === 200) {
            if(document.getElementById("table") != null) {
               document.getElementById("table").innerHTML = request.responseText;
            }
            // Confirm Message
            var confirmMsg = document.getElementById("cnfrm");
            var popup = document.getElementsByClassName("popup");
            var deleteBtn = document.getElementsByClassName("del-btn");
            var cancel = document.getElementsByClassName("cancel");

            for (var i = 0; i < deleteBtn.length; i++) {
               deleteBtn[i].addEventListener('click', (e) => {
                  var nxt = e.currentTarget.nextElementSibling;
                  nxt.style.display = 'flex';

                  for (var i = 0; i < cancel.length; i++) {
                     cancel[i].addEventListener('click', () => {
                        nxt.style.display = 'none';
                     })
                  }
               })
            }
         }
      }
      request.send();
   }
   window.addEventListener('load', show_users());
</script>
<!-- AJAX Requests For Users -->
<script src="js/requests/users-requests.js"></script>
<script>
   let all = document.getElementById("all").value;
   if(all <= 6) {
      document.getElementById("lm-btn").disabled = true;
   }
</script>