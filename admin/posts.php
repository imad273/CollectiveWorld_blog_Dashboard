<?php
   session_start();
   // Title of this page
   $title = "Posts";
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
            <div class="header">
               <h3>Manage Posts</h3>
               <a href="?action=add-post" class="btn btn-primary"><i class='bx bxs-add-to-queue'></i>Add New Post</a>
            </div>
            <div class="show-posts">
               <div class="header">
                  <h3>All Posts: <?php countItem('Posts_id', 'posts') ?></h3>
                  <div class="search-field">
                     <input type="text" class="search" name="search" oninput="search_post()" autocomplete="OFF" placeholder="Search"><button><i class='bx bx-search-alt'></i></button>
                  </div>
               </div>
               <div class="res">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">#</th>
                              <th scope="col">Title</th>
                              <th scope="col">Views</th>
                              <th scope="col">Date</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody id="table"></tbody>
                     </table>
                  </div>
                  <div class="load-more">
                     <button class="btn btn-primary" id="lm-btn" onclick="load_more()">Load More</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php
   } elseif ($link == 'add-post') { ?>
      <div class="posts">
         <?php
         // Import Navbar file
         include "include/navbar.php";
         ?>
         <div class="content" id="content">
            <div id="msg"></div>
            <div class="header">
               <a href="posts.php" class="btn btn-primary"><i class='bx bx-arrow-back'></i> Back</a>
            </div>
            <div class="add-posts">
               <div class="header">
                  <h3>Add Post</h3>
               </div>
               <div class="form">
                  <form onsubmit="return false">
                     <div class="mb-3">
                        <input type="text" name="title" class="form-control input-add-post" placeholder="Title" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <textarea name="content" class="form-control input-add-post" placeholder="Content" rows="6"></textarea>
                     </div>
                     <div class="mb-3">
                        <input type="file" name="img" class="form-control" id="img">
                     </div>
                     <div class="mb-3 sumbit">
                        <button class="btn btn-primary" onclick="add_post()">Post</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   <?php
   } elseif ($link == 'edit-post') {
      $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0; ?>

      <div class="posts">
         <?php
         // Import Navbar file
         include "include/navbar.php";
         ?>
         <div class="content" id="content">
            <div id="msg"></div>
            <div class="header">
               <a href="posts.php" class="btn btn-primary"><i class='bx bx-arrow-back'></i> Back</a>
            </div>
            <div class="add-posts">
               <div class="header">
                  <h3>Edit Post</h3>
               </div>
               <div class="form" id="form">

               </div>
            </div>
         </div>
      </div>
      <script>
         // Edit Post
         const view_edit_post = (id) => {
            let request = new XMLHttpRequest();
            let form = new FormData();

            form.append('id', id);

            request.open("POST", "requests PHP/posts-requests.php?action=edit-post", true);

            request.onreadystatechange = () => {
               if (request.readyState === 4 && request.status === 200) {
                  document.getElementById("form").innerHTML = request.responseText;

               }
            }

            request.send(form);
         }
         window.addEventListener('load', view_edit_post(<?php echo $id ?>))
      </script>
<?php
   } else {
      header('location: posts.php');
   }
} else {
   // when there's no session or admin comming from a external link
   header("location: index.php");
}

   include "include/footer.html";
?>
<script>
   // Show Posts request
   const show_post = () => {
      var request = new XMLHttpRequest();
      request.open("POST", "requests PHP/posts-requests.php?action=show-post", true);

      request.onreadystatechange = function() {
         if (request.readyState === 4 && request.status === 200) {
            if (document.getElementById("table") != null) {
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
   window.addEventListener('load', show_post());
</script>
<!-- AJAX Requests For Posts -->
<script src="js/requests/posts-requests.js"></script>