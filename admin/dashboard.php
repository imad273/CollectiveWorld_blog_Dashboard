<?php
   session_start();
   // Title of this page
   $title = "Dashboard";
   // Import the required filess of this page
   require "func.php";
   require "../config.php";
   include "include/header.php";
   
   // check if there is a session or not
   if(isset($_SESSION['adminid'])){
      $adminid = $_SESSION['adminid'];

      if(!isset($_COOKIE['first_login'])){
         setcookie("first_login", "yes", time() + (86400 * 30));
         echo "<div id='welc' class='welcMsg'>Welcome To The Admin Dashboard </div>";
      }

      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");
      $stmt->execute(array($adminid));
      $rows = $stmt->fetch(); ?>

      <div class="dash"> 
         <?php
            // Import Navbar file
            include "include/navbar.php";
         ?> 
         <div class="content" id="content">
            <div class="header">
               <h3>Dashboard</h3>
               <div class="weather">
                  <img id="icn"></img>
                  <div id="temp"></div>|
                  <div id="lct"></div>|
                  <div id="time"></div>
               </div>
            </div>
            <div class="static">
               <div class="row">
                  <div class="col-md-4">
                     <div class="stat">
                        <i class='bx bxs-file'></i>
                        <div class="value">
                           <span> <?php echo countItem('Posts_id', 'posts') ?></span>
                           <p>Posts</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="stat">
                        <i class='bx bxs-user'></i>
                        <div class="value">
                           <span>2100</span>
                           <p>Users</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="stat">
                        <i class='bx bxs-show'></i>
                        <div class="value">
                           <span>14023</span>
                           <p>Views</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="res">
                  <h3>Recent Posts</h3>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">#</th>
                              <th scope="col">Title</th>
                              <th scope="col">Views</th>
                              <th scope="col">Date</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $stmt = $con->prepare("SELECT * FROM posts ORDER BY Posts_id DESC LIMIT 3");
                              $stmt->execute();
                              while($ftc = $stmt->fetch()) { ?>
                                 <tr>
                                    <td><?php echo $ftc['Posts_id'] ?></td>
                                    <td><?php echo $ftc['Title'] ?></td>
                                    <td><?php echo $ftc['Views'] ?></td>
                                    <td>
                                    <?php 
                                       $df_date = $ftc['Date'];
                                       $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%H:%i %b %D, %Y') AS date");
                                       $date_stmt->execute();
                                       $date = $date_stmt->fetch();
                                       echo $date['date']; ?> 
                                    </td>
                                 </tr>
                        <?php
                              }
                           ?>
                        </tbody>
                     </table>
                  </div>                  
               </div>
               <div class="res">
                  <h3>Recent Users</h3>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">Username</th>
                              <th scope="col">Fisrt Name</th>
                              <th scope="col">Last Name</th>
                              <th scope="col">Date</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php
                              $stmt = $con->prepare("SELECT * FROM users ORDER BY UserID DESC LIMIT 3");
                              $stmt->execute();
                              while($ftc = $stmt->fetch()) { ?>
                                 <tr>
                                    <td><?php echo $ftc['UserName'] ?></td>
                                    <td><?php echo $ftc['FirstName'] ?></td>
                                    <td><?php echo $ftc['LastName'] ?></td>
                                    <td>
                                    <?php 
                                       $df_date = $ftc['Date'];
                                       $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%b %D, %Y') AS date");
                                       $date_stmt->execute();
                                       $date = $date_stmt->fetch();
                                       echo $date['date']; ?> 
                                    </td>
                                 </tr>
                           <?php
                              }
                           ?>
                        </tbody>
                     </table>
                  </div>                  
               </div>
            </div>
         </div>
      </div>
<?php
   } else {
      // when there's no session or admin comming from a external link
      header("location: index.php");
   }
   // Weather API
   echo "<script src='js/weather.js'></script>";
   include "include/footer.html"; 
?>
