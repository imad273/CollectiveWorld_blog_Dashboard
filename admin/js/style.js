// Disble Welcom Message Function
// Disble the Welcom Message after 2.5 secend before login
var wlcMessage = document.getElementById("welc");
if(wlcMessage != null){
   setTimeout( ()=> {
      wlcMessage.style.opacity = "0";
      wlcMessage.style.visibility = "hidden";
   }, "2500");
}

// Dark swtich
var swtch = document.getElementById("switch");
var sqr = document.getElementById("sqr");
var body = document.body;
if(swtch && sqr != null){
   swtch.addEventListener("click", ()=> {
      if(body.className = "light-mode" && sqr.style.left == "2px"){
         sqr.style.left = "23px";
         body.className = "dark-mode";
      } else {
         sqr.style.left = "2px";
      }
   })
}
// Animation onload
var content = document.getElementById("content");
if(content != null){
   window.onload = () => {
      content.style.left = "0px";
      content.style.opacity = "1";
   }
}

// Open Menu
let humb = document.getElementById("humb");
let menu = document.getElementById("nav");
let clse = document.getElementById("close");
humb.addEventListener("click", () => {
   if(menu.style.width = "5%") {
      menu.style.width = "75%";
      humb.style.display = "none";
      clse.style.display = "block";
      document.getElementById("brand").style.display = "block";
      document.getElementById("links").style.marginLeft = "0px";
      document.getElementById("switch").style.marginLeft = "0px";
   }
})
// Close Menu
clse.addEventListener("click", () => { 
   if(menu.style.width = "75%") {
      menu.style.width = "5%";
      humb.style.display = "block";
      clse.style.display = "none";
      document.getElementById("brand").style.display = "none";
      document.getElementById("links").style.marginLeft = "50px";
      document.getElementById("switch").style.marginLeft = "50px";
   }
})