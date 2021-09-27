// Validate And Request The Login Form
const login = () => {
   // Get input value
   let login_input = document.getElementsByClassName("input-login");
   // Create Form
   let form = new FormData();
   for (let i = 0; i < login_input.length; i++) {
      // Set each input value into the Form
      form.append(login_input[i].name, login_input[i].value);
   }

   let request = new XMLHttpRequest();

   request.open("POST", "././requests PHP/login-request.php", true);
   document.getElementById('botn').innerHTML = "Loading";
   request.onreadystatechange = () => {
      if (request.readyState === 4 && request.status === 200) {
         document.getElementById("msg").innerHTML = request.responseText;
         // if reponse is empty that mean the Login is success, And give access to enter the Dashboard
         if(request.responseText == ""){
            window.location = "dashboard.php";
         }
      }
   }
   request.send(form);
   document.getElementById('botn').innerHTML = "Login";
}