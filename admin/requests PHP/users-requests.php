<?php
   session_start();
   // Import the required filess of this page
   require "../../config.php";
   $link = isset($_GET['action']) ? $_GET['action'] : false;
   if ($link == 'show-users') {
      $stmt = $con->prepare("SELECT * FROM users LIMIT 6");
      $stmt->execute();

      if($stmt->rowCount() > 0) {
         while($ftc = $stmt->fetch()) { 
            $id = $ftc['UserID']; ?>
            <tr>
               <td> <?php echo $ftc['UserName'] ?> </td>
               <td> <?php echo $ftc['Email'] ?> </td>
               <td> <?php echo $ftc['FirstName'] . " " . $ftc['LastName'] ?> </td>
               <td> 
                  <?php 
                     $df_date = $ftc['Date'];
                     $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%b %D, %Y') AS date");
                     $date_stmt->execute();
                     $date = $date_stmt->fetch();
                     echo $date['date']; ?> 
               </td>
               <td class="btns">
                  <a class="btn edit"><i class='bx bxs-pencil'></i></a>
                  <a class="btn btn-danger del-btn" id="del-btn"><i class='bx bxs-trash-alt'></i></a>
                  <div id="cnfrm" class="popup">
                     <div class="del-con"> 
                        <p>Are you sure you want to delete the post?</p>
                        <div class="cntr float-end">
                           <a id="cancel" class="btn btn-success cancel">Cancel</a>
                           <a class="btn btn-danger" onclick="delete_user(<?php echo $id ?>)">Delete</a>
                        </div>
                     </div>
                  </div>
               </td>
            </tr> 
<?php
         }

         echo "<input type='hidden' id='counter-item' name='result_no' value='0'>";
         $stmt2 = $con->prepare("SELECT COUNT(Posts_id) FROM posts");
         $stmt2->execute();
         $rows = $stmt2->fetchColumn();  ?>
         <input type='hidden' id='all' name='all' value='<?php echo $rows ?>'>
<?php
      }
   } elseif ($link == 'delete-user') {
      $id = isset($_POST['id']) && is_numeric($_POST['id']) ? $_POST['id'] : false;
      $stmt = $con->prepare("DELETE FROM users WHERE UserID = ?");
      $stmt->execute(array($id));

   } elseif ($link == 'search-user') {
      $key = '%' . $_POST['search'] . "%";
      $stmt = $con->prepare("SELECT * FROM users WHERE UserName LIKE '$key' LIMIT 5");
      $stmt->execute();
      if($stmt->rowCount() > 0) {
         while($ftc = $stmt->fetch()) { 
            $id = $ftc['UserID']; ?>
            <tr>
               <td> <?php echo $ftc['UserName'] ?> </td>
               <td> <?php echo $ftc['Email'] ?> </td>
               <td> <?php echo $ftc['FirstName'] . " " . $ftc['LastName'] ?> </td>
               <td> 
                  <?php 
                     $df_date = $ftc['Date'];
                     $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%b %D, %Y') AS date");
                     $date_stmt->execute();
                     $date = $date_stmt->fetch();
                     echo $date['date']; ?> 
               </td>
               <td class="btns">
                  <a class="btn edit"><i class='bx bxs-pencil'></i></a>
                  <a class="btn btn-danger del-btn" id="del-btn"><i class='bx bxs-trash-alt'></i></a>
                  <div id="cnfrm" class="popup">
                     <div class="del-con"> 
                        <p>Are you sure you want to delete the post?</p>
                        <div class="cntr float-end">
                           <a id="cancel" class="btn btn-success cancel">Cancel</a>
                           <a class="btn btn-danger" onclick="delete_user(<?php echo $id ?>)">Delete</a>
                        </div>
                     </div>
                  </div>
               </td>
            </tr> 
            
<?php
            echo "<input type='hidden' id='counter-item' name='result_no' value='0'>";
            $stmt2 = $con->prepare("SELECT COUNT(Posts_id) FROM posts");
            $stmt2->execute();
            $rows = $stmt2->fetchColumn();  ?>
            <input type='hidden' id='all' name='all' value='<?php echo $rows ?>'>
<?php
         }
      } else { ?>
         <tr>
            <p class="no-more" style="font-weight: 600; font-size: 20px">No Ruselt</p>
         </tr>
<?php
      }
   } elseif ($link == 'load-more') {
      $no = $_POST['result_no'];
      $stmt2 = $con->prepare("SELECT COUNT(*) FROM posts");
      $stmt2->execute();
      $rows = $stmt2->fetchColumn(); 
      if($no > $rows) {
         echo "<tr>
                  <p class='no-more' style='font-weight: 600; font-size: 20px'>No More Posts to show</p>
               </tr>";
      }
      $stmt = $con->prepare("SELECT * FROM users LIMIT $no, 6");
      $stmt->execute();
      while($ftc = $stmt->fetch()){
         $id = $ftc['UserID']; ?>
         <tr>
            <td> <?php echo $ftc['UserName'] ?> </td>
            <td> <?php echo $ftc['Email'] ?> </td>
            <td> <?php echo $ftc['FirstName'] . " " . $ftc['LastName'] ?> </td>
            <td> 
               <?php 
                  $df_date = $ftc['Date'];
                  $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%b %D, %Y') AS date");
                  $date_stmt->execute();
                  $date = $date_stmt->fetch();
                  echo $date['date']; ?> 
            </td>
            <td class="btns">
               <a class="btn edit"><i class='bx bxs-pencil'></i></a>
               <a class="btn btn-danger del-btn" id="del-btn"><i class='bx bxs-trash-alt'></i></a>
               <div id="cnfrm" class="popup">
                  <div class="del-con"> 
                     <p>Are you sure you want to delete the post?</p>
                     <div class="cntr float-end">
                        <a id="cancel" class="btn btn-success cancel">Cancel</a>
                        <a class="btn btn-danger" onclick="delete_user(<?php echo $id ?>)">Delete</a>
                     </div>
                  </div>
               </div>
            </td>
         </tr>
<?php
      }
      echo "<input type='hidden' id='counter-item' name='result_no' value='" . $no . "'>";
      $stmt2 = $con->prepare("SELECT COUNT(Posts_id) FROM posts");
      $stmt2->execute();
      $rows = $stmt2->fetchColumn(); ?>

      <input type='hidden' id='all' name='all' value='<?php echo $rows ?>'>
<?php   
   }
