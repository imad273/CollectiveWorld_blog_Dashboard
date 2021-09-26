// Delete Post 
const delete_user = (id) => {
   let form = new FormData();
   form.append("id", id);

   let request = new XMLHttpRequest();
   request.open("POST", "././requests PHP/users-requests.php?action=delete-user", true);

   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         // disble Confirm Message
         let popup      = document.getElementsByClassName("popup");
         
         for(var i = 0; i < popup.length; i++){
            popup[i].style.display = 'none';
         }
         show_users();
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
   
   request.open("POST", "././requests PHP/users-requests.php?action=load-more");

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

// Search in Posts
const search_users = () => {
   // Get input value
   let search_element = document.getElementsByClassName("search");
   // Create Form
   let form = new FormData();
   for (let i = 0; i < search_element.length; i++) {
      // Set each input value into the Form
      form.append(search_element[i].name, search_element[i].value);
   }

   let request = new XMLHttpRequest();

   request.open("POST", "././requests PHP/users-requests.php?action=search-user", true);

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