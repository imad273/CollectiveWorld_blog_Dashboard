<?php
   session_start();
   // Import the required filess of this page
   require "../../config.php";
   $link = isset($_GET['action']) ? $_GET['action'] : false;
   if ($link == 'push-post') { 
      $title   = $_POST['title'];
      $content = $_POST['content'];
      // Image
      if(isset($_FILES['img'])) {
         $img         = $_FILES['img']['name'];
         $img_tmp     = $_FILES['img']['tmp_name'];
      }

      $form_error = array();
      if(empty($title) && empty($content) && empty($img)) {
         $form_error[] = "Please Complete the Form";
      } elseif (empty($title)) {
         $form_error[] = "Please Set The Title";
      } elseif(empty($content)) {
         $form_error[] = "Please Set The Content Of The Post";
      } elseif(empty($_FILES['img'])) {
         $form_error[] = "Please Set The Image";
      }
      
      foreach($form_error as $error) {
         echo "<div class='container alert-msg'>
            <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>". $error . "</div>";
         echo "</div>";
      }

      if(empty($form_error)) {
         $image = rand(0, 100000000) . "_" . $img;
         move_uploaded_file($img_tmp, 'uploaded_images\\' . $image);
         
         $stmt = $con->prepare("INSERT INTO posts (Title, Content, Date, Views, Comments, image) VALUE (?, ?, now(), ?, ?, ?)");
         $stmt->execute(array($title, $content, 0, 0, $image));

         echo "<div class='container alert-msg'><div class='alert alert-success'><i class='bx bxs-comment-check'></i>Post added Successefully</div></div>";
      } 

   } elseif ($link == 'show-post') {
      $stmt = $con->prepare("SELECT * FROM posts LIMIT 6");
      $stmt->execute();

      if($stmt->rowCount() > 0) {
         while($ftc = $stmt->fetch()) { 
            $id = $ftc['Posts_id']; ?>
            <tr>
               <td> <?php echo $id ?> </td>
               <td id="title" class="post-id"> <?php echo $ftc['Title'] ?> </td>
               <td> <?php echo $ftc['Views'] ?> </td>
               <td> 
                  <?php 
                     $df_date = $ftc['Date'];
                     $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%H:%i %b %D, %Y') AS date");
                     $date_stmt->execute();
                     $date = $date_stmt->fetch();
                     echo $date['date']; ?> 
               </td>
               <td class="btns">
                  <a href="posts.php?action=edit-post&id=<?php echo $id ?>" class="btn edit"><i class='bx bxs-pencil'></i></a>
                  <a class="btn btn-danger del-btn" id="del-btn"><i class='bx bxs-trash-alt'></i></a>
                  <div id="cnfrm" class="popup">
                     <div class="del-con"> 
                        <p>Are you sure you want to delete the post?</p>
                        <div class="cntr float-end">
                           <a id="cancel" class="btn btn-success cancel">Cancel</a>
                           <a class="btn btn-danger" onclick="delete_post(<?php echo $id ?>)">Delete</a>
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
      } else { ?>
         <tr >
            <p style="font-weight: 600; font-size: 20px">No Posts To Show.</p>
         </tr>
<?php
      }
   } elseif ($link == 'search-post') {
      $key = '%' . $_POST['search'] . "%";
      $stmt = $con->prepare("SELECT * FROM posts WHERE Title LIKE '$key' LIMIT 5");
      $stmt->execute();
      if($stmt->rowCount() > 0) {
         while($ftc = $stmt->fetch()) { 
            $id = $ftc['Posts_id']; ?>
            <tr>
               <td> <?php echo $id ?> </td>
               <td id="title"> <?php echo $ftc['Title'] ?> </td>
               <td> <?php echo $ftc['Views'] ?> </td>
               <td>
                  <?php 
                     $df_date = $ftc['Date'];
                     $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%H:%i %b %D, %Y') AS date");
                     $date_stmt->execute();
                     $date = $date_stmt->fetch();
                     echo $date['date'];
                  ?>    
               </td>
               <td class="btns">
                  <a href="posts.php?action=edit-post&id=<?php echo $id ?>" class="btn edit"><i class='bx bxs-pencil'></i></a>
                  <a class="btn btn-danger del-btn" id="del-btn"><i class='bx bxs-trash-alt'></i></a>
                  <div id="cnfrm" class="popup">
                     <div class="del-con"> 
                        <p>Are you sure you want to delete the post?</p>
                        <div class="cntr float-end">
                           <a id="cancel" class="btn btn-success cancel">Cancel</a>
                           <a class="btn btn-danger" onclick="delete_post(<?php echo $id ?>)">Delete</a>
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
      } else { ?>
         <tr>
            <p class="no-more" style="font-weight: 600; font-size: 20px">No Ruselt</p>
         </tr>
<?php
      }

   } elseif($link == 'delete-post') {

      $id = isset($_POST['id']) && is_numeric($_POST['id']) ? $_POST['id'] : false;
      $stmt = $con->prepare("DELETE FROM posts WHERE Posts_id = ?");
      $stmt->execute(array($id));
      $ftc = $stmt->fetch();
      $file = "uploaded_images";
      $img = $ftc['image'];
      unlink($file . "/" . $img);

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
      $stmt = $con->prepare("SELECT * FROM posts LIMIT $no, 6");
      $stmt->execute();
      while($ftc = $stmt->fetch()){
            $id = $ftc['Posts_id']; ?>
            <tr>
               <td> <?php echo $id ?> </td>
               <td id="title" class="post-id"> <?php echo $ftc['Title'] ?> </td>
               <td> <?php echo $ftc['Views'] ?> </td>
               <td>
                  <?php 
                     $df_date = $ftc['Date'];
                     $date_stmt = $con->prepare("SELECT DATE_FORMAT('$df_date', '%H:%i %b %D, %Y') AS date");
                     $date_stmt->execute();
                     $date = $date_stmt->fetch();
                     echo $date['date'];
                  ?>   
               </td>
               <td class="btns">
                  <a href="posts.php?action=edit-post&id=<?php echo $id ?>" class="btn edit"><i class='bx bxs-pencil'></i></a>
                  <a class="btn btn-danger del-btn" id="del-btn"><i class='bx bxs-trash-alt'></i></a>
                  <div id="cnfrm" class="popup">
                     <div class="del-con"> 
                        <p>Are you sure you want to delete the post?</p>
                        <div class="cntr float-end">
                           <a id="cancel" class="btn btn-success cancel">Cancel</a>
                           <a class="btn btn-danger" onclick="delete_post(<?php echo $id ?>)">Delete</a>
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

   } elseif ($link == 'edit-post') {
      $id = isset($_POST['id']) && is_numeric($_POST['id']) ? $_POST['id'] : false;
      $stmt = $con->prepare("SELECT * FROM posts WHERE Posts_id = ?");
      $stmt->execute(array($id));
      while($ftc = $stmt->fetch()) { ?>
         <form onsubmit="return false">
            <div class="mb-3">
               <input type="hidden" name="id" id="id" class="input-update" value="<?php echo $id ?>">
               <input type="text" value="<?php echo $ftc['Title'] ?>" name="title" class="form-control input-update" placeholder="Title" autocomplete="OFF">
            </div>
            <div class="mb-3">
               <textarea name="content" class="form-control input-update" placeholder="Content" rows="5"><?php echo $ftc['Content'] ?></textarea>
            </div>
            <div style="height: 315px;">
               <div class="edit-img">
                  <input type="file" name="img" id="img-update">
                  <label for="img-update" class="btn btn-primary"><i class='bx bxs-edit-alt'></i>Edit</label>
               </div>
               <img src="uploaded_images/<?php echo $ftc['image'] ?>" alt="image" class="img">
            </div>
            <div class="mb-2 sumbit">
               <button class="btn btn-primary" onclick="insert_update()">Save</button>
            </div>
         </form> 
<?php 
      }
   } elseif ($link == 'insert-update') {
      $id = $_POST['id'];
      $stmt = $con->prepare("SELECT * FROM posts WHERE Posts_id = ?");
      $stmt->execute(array($id));
      $ftc = $stmt->fetch();

      $title = $_POST['title'];
      $content = $_POST['content'];
      
      if(empty($_FILES['img']) && $title == $ftc['Title'] && $content == $ftc['Content']) {
         echo "<div class='container alert-msg'>
            <div class='alert alert-danger'><i class='bx bxs-comment-error'></i>No Update to Save</div>";
         echo "</div>";
      } else {
         
         if(isset($_FILES['img'])) {
            $img         = $_FILES['img']['name'];
            $img_tmp     = $_FILES['img']['tmp_name'];

            $image = rand(0, 100000000) . "_" . $img;
            move_uploaded_file($img_tmp, 'uploaded_images\\' . $image);
         } else {
            $image = $ftc['image'];
         }

         $stmt = $con->prepare("UPDATE posts SET Title = ?, Content = ?, Image = ? WHERE Posts_id = '$id'");
         $stmt->execute(array($title, $content, $image)); 

         echo "<div class='container alert-msg'>
                  <div class='alert alert-success'><i class='bx bxs-comment-check'></i>Update Save</div>
               </div>";
      }
   }
?>