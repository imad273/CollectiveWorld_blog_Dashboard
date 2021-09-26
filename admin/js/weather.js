window.addEventListener('load', weather());
async function weather() {
   var success = (position) => {
      var lat = position.coords.latitude;
      var lon = position.coords.longitude;

      var link = "http://api.weatherapi.com/v1/current.json?key=67a022a41e8d4d40901194810211009&q=" + lat + "," + lon + "&aqi=no";
      fetch(link).then((response) => {
         return response.json();
      }).then((data) => {
         document.getElementById('icn').src = data.current.condition.icon;
         document.getElementById('temp').innerHTML = data.current.temp_c + " °C";
         document.getElementById('lct').innerHTML = data.location.region + ", " + data.location.country;
         // Get the time
         setInterval( ()=> {
            var time = new Date(),
            hours = time.getHours(),
            minute = time.getMinutes();
            if (minute < 10) {
               minute = "0" + minute;
            };
            document.getElementById('time').innerHTML = hours + ":" + minute;
         }, 1000)
      })
   }

   var error = () => {
      document.getElementById('icn').src = "";
      document.getElementById('temp').innerHTML = "error";
      document.getElementById('lct').innerHTML = "Can't adjust the weather";
   }

   navigator.geolocation.getCurrentPosition(success, error);

}