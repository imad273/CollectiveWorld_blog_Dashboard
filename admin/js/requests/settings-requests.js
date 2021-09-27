// Add New Post
const save_data = () => {
   // Get input value
   let edit_info_element = document.getElementsByClassName("input-profile");

   // Create Form
   let form = new FormData();
   for (let i = 0; i < edit_info_element.length; i++) {
      // Set each input value into the Form
      form.append(edit_info_element[i].name, edit_info_element[i].value);
   }

   let request = new XMLHttpRequest();

   request.open("POST", "././requests PHP/settings-requests.php?action=insert-data", true);

   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         document.getElementById("msg").innerHTML = request.responseText;
      }
   }
   request.send(form); 
}

const Change_pass = () => {
   // Get input value
   let edit_pass_element = document.getElementsByClassName("input-pass");

   // Create Form
   let form = new FormData();
   for (let i = 0; i < edit_pass_element.length; i++) {
      // Set each input value into the Form
      form.append(edit_pass_element[i].name, edit_pass_element[i].value);
   }
   
   let request = new XMLHttpRequest();

   request.open("POST", "././requests PHP/settings-requests.php?action=change-pass", true);

   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         document.getElementById("msg").innerHTML = request.responseText;
      }
   }
   request.send(form); 
}