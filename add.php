
<?php

if(!isset($_SESSION)){ 
    session_start(); 
}

if(!isset($_SESSION["username"])){
	header('Location: login.php');
	exit();
}

$db = mysqli_connect('localhost', 'root', '', 'travel');
$username = $_SESSION["username"];


// Adding


if (isset($_POST['added'])) {
  $username=$_SESSION['username'];

  $place = mysqli_real_escape_string($db, $_POST['cit']);
  $descr = mysqli_real_escape_string($db, $_POST['descr']);
  $comm="";
  $likes=0;


$query = "INSERT INTO data (username, place, descr, comm, likes) 
          VALUES('$username','$place','$descr','$comm',$likes)";
    mysqli_query($db, $query);
    header('location: home.php');
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Add</title>
	<style type="text/css">
	* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}
body {
  font-size: 120%;
  background: #F8F8FF;
  background-image: url("bg.jpg");
              background-repeat: no-repeat;
    background-size: cover;
}
        .title{
            text-align: center;
            font-family: 'Arial, Helvetica, sans-serif';
            letter-spacing: 0.2em;
            font-size: 4em;
            padding: 5px;
            color: white;
        }
                                .tagline{
            text-align: center;
            color: white;
            font-family: 'Times New Roman';
            letter-spacing: 0.2em;
            font-size: 2em;
            padding: 5px;
            margin-bottom: 2%;
        }

        .header:after {
  content: "";
  display: table;
  clear: both;
}
form {
  width: 700px;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
        .header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
        input {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}

.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
#btn2
{position:absolute;
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
  cursor: pointer;
    margin-top:1%;
    margin-left: 24%;
}
</style>
</head>
<body>
        <h1 class="title">TRIP PLANNER</h1>
          <div class="tagline">Plan your Trips based on Weather and Reviews</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeCrcG5O2a3UmxHsCTMz3VgVu8Jz6jkqg&libraries=places&callback=initMap"
    async defer></script>

<div id="map"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeCrcG5O2a3UmxHsCTMz3VgVu8Jz6jkqg&libraries=places&callback=initMap"
    async defer></script>
<script>
var geocoder;
var cityName;
  var country;
  var des;
  var temp;

function home()
{window.location = "home.php";
}

  
function initMap()
{var infoWindow;
var options={
  zoom:8,
  center:{lat:13.0827,lng:80.2707}
}

geocoder      =   new google.maps.Geocoder(); 
var map=new google.maps.Map(document.getElementById("map"),options);
var autocomplete = new  google.maps.places.Autocomplete(document.getElementById("city"),{ types: ['(cities)']});

google.maps.event.addListener(map,'click',function(event){

var apiCall='http://api.openweathermap.org/data/2.5/weather?lat=' + event.latLng.lat() + '&lon=' + event.latLng.lng() + '&appid=c3990fa461f26dbc4d72849f5b4b137a';
$.getJSON(apiCall,weatherCallBack);
function weatherCallBack(weatherData)
{    cityName=weatherData.name;
   country=weatherData.sys.country;
   des=weatherData.weather[0].description;
   temp=weatherData.main.temp;
}
  
  var marker=new google.maps.Marker({
    position:event.latLng,
    map:map
  });

  
  marker.addListener('click',function(event2){

var apiCall2='http://api.openweathermap.org/data/2.5/weather?lat=' + event2.latLng.lat() + '&lon=' + event2.latLng.lng() + '&appid=c3990fa461f26dbc4d72849f5b4b137a';
$.getJSON(apiCall2,weatherCallBack2);
function weatherCallBack2(weatherData1)
{ 
  var temp=weatherData1.main.temp;
    var cel1=temp-273.15;
  var cel=cel1.toFixed(2);
  infoWindow=new google.maps.InfoWindow({
    content:'<div id="info"> Place: '+weatherData1.name+ '<br></br>'+ 'Country: '+ weatherData1.sys.country+ '<br></br>' + 'Current Weather: '+ weatherData1.weather[0].description + '<br></br>'+ 'Temperature: '+ cel + ' C'+ '</div>' 
  });
  infoWindow.open(map,marker);
}
});
});
}

function displayWeather()
{document.getElementById("w").value="";
  var inputCity=document.getElementById("city").value;

  var apiCall='http://api.openweathermap.org/data/2.5/weather?q=' + inputCity + '&appid=c3990fa461f26dbc4d72849f5b4b137a';                                         

$.getJSON(apiCall,weatherCallBack);
function weatherCallBack(weatherData)
{   
  var cityName=weatherData.name;
  var country=weatherData.sys.country;
  var des=weatherData.weather[0].description;
  var temp=weatherData.main.temp;
  var cel1=temp-273.15;
  var cel=cel1.toFixed(2);
  
document.getElementById("w").innerHTML="Place: "+ cityName + "<br></br>" + ' Country: ' + country + '<br></br>' + 'Current Weather: '+ des+ '<br></br>' + 'Temperature: '+ cel + ' C';
}}
</script>

<div class="header">
  	<h2>ADD REVIEW</h2>
  </div>
	 

    <form method="post" action="add.php">
        <div class="input-group">
      <label>City Name</label>
      <input type="text" id="city" name="cit">
    </div>
  	<div class="input-group">
  		<label>Description</label>
  		<input type="text" name="descr" >
  	</div>
    <br>
    <div class="input-group">
  		<button type="submit" class="btn" name="added">ADD</button>
  	</div>
  </form>
  <button id="btn2" onclick="home();">BACK TO HOME</button>

</body>
</html>