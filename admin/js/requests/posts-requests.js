// Add New Post
const add_post = () => {
   // Get input value
   let add_post_element = document.getElementsByClassName("input-add-post");
   let form_img = document.getElementById("img");
   // Create Form
   let form = new FormData();
   for (let i = 0; i < add_post_element.length; i++) {
      // Set each input value into the Form
      form.append(add_post_element[i].name, add_post_element[i].value);
   }
   // append the image
   form.append(form_img.name, form_img.files[0]);

   let request = new XMLHttpRequest();

   request.open("POST", "././requests PHP/posts-requests.php?action=push-post", true);

   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         document.getElementById("msg").innerHTML = request.responseText;
         
            for (let i = 0; i < add_post_element.length; i++) {
               add_post_element[i].value = "";
            }
            form_img.value = ""; 
      }
   }
   request.send(form); 
}
// Search in Posts
const search_post = () => {
   // Get input value
   let search_element = document.getElementsByClassName("search");
   // Create Form
   let form = new FormData();
   for (let i = 0; i < search_element.length; i++) {
      // Set each input value into the Form
      form.append(search_element[i].name, search_element[i].value);
   }

   let request = new XMLHttpRequest();

   request.open("POST", "././requests PHP/posts-requests.php?action=search-post", true);

   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         document.getElementById("table").innerHTML = request.responseText;
         // Confirm Message
         let deleteBtn  = document.getElementsByClassName("del-btn");
         let cancel     = document.getElementsByClassName("cancel");
         
         for(let i = 0; i < deleteBtn.length; i++){
            deleteBtn[i].addEventListener('click', (e) => {
               let nxt = e.currentTarget.nextElementSibling;
               nxt.style.display = 'flex';

               for(let i = 0; i < cancel.length; i++){
                  cancel[i].addEventListener('click', () => {
                     nxt.style.display = 'none'; 
                  })
               }
            })
            
         }
      }
   }
   request.send(form);
}

// Load More Data
const load_more = () => {
   let form_element_value = Number(document.getElementById("counter-item").value) + 6;
   let form_element_name = document.getElementById("counter-item").name;

   let AllCont = document.getElementById("all").value;

   let request = new XMLHttpRequest;
   let form = new FormData();

   form.append(form_element_name, form_element_value);
   
   request.open("POST", "././requests PHP/posts-requests.php?action=load-more");

   request.onreadystatechange = () => {
      if(request.readyState == 4 && request.status == 200){
         
         document.getElementById("table").innerHTML = request.responseText;      
         // Confirm Message
         let deleteBtn  = document.getElementsByClassName("del-btn");
         let cancel     = document.getElementsByClassName("cancel");
         
         for(let i = 0; i < deleteBtn.length; i++){
            deleteBtn[i].addEventListener('click', (e) => {
               var nxt = e.currentTarget.nextElementSibling;
               nxt.style.display = 'flex';

               for(let i = 0; i < cancel.length; i++){
                  cancel[i].addEventListener('click', () => {
                     nxt.style.display = 'none'; 
                  })
               }
            })
         }

         if(form_element_value >= AllCont) {
            document.getElementById("lm-btn").disabled = true; 
         }
      }
   }
   request.send(form); 
}

// Delete Post 
const delete_post = (id) => {
   let form = new FormData();
   form.append("id", id);

   let request = new XMLHttpRequest();
   request.open("POST", "././requests PHP/posts-requests.php?action=delete-post", true);

   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         // disble Confirm Message
         let popup      = document.getElementsByClassName("popup");
         
         for(var i = 0; i < popup.length; i++){
            popup[i].style.display = 'none';
         }
         show_post();
      }
   }
   request.send(form);
}

// Insert the update Data
const insert_update = () => {

   let form_element = document.getElementsByClassName("input-update");
   let form_img = document.getElementById("img-update");
   let id = document.getElementById("id").value;

   let request = new XMLHttpRequest;
   let form = new FormData();

   for(let i = 0; i < form_element.length; i++) {
      form.append(form_element[i].name, form_element[i].value);
   }

   form.append(form_img.name, form_img.files[0]);
   
   

   request.open("POST", "././requests PHP/posts-requests.php?action=insert-update");

   request.onreadystatechange = () => {
      if(request.readyState == 4 && request.status == 200){
            document.getElementById('msg').innerHTML = request.responseText;
            view_edit_post(id);
         }
      }
   
   request.send(form);
}