<?php

if(!isset($_SESSION)){ 
    session_start(); 
}

if(!isset($_SESSION["username"])){
	header('Location: login.php');
	exit();
}
$_SESSION['message']="";
?>

<html>
<head>
<title>WEATHER APP</title>
<style>
	
#map{
	height:100%;
	width:50%;
}
body{background-color: #FEF9E7;}
	 
#w 
{position: absolute;
      	margin-top: -300px;
      	margin-left:60%;
   width: 300px;
    border: 25px solid green;
    padding: 25px;
    
}
#b
{position:absolute;
    width: 10%;
    background-color: green;
    color: white;
    padding: 14px 20px;
    margin-top:-30%;
    margin-left: 75%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
#btn4
{  position:absolute;
    width: 10%;
    background-color: green;
    color: white;
    padding: 14px 20px;
    margin-top: -45%;
    margin-left: 88%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
#btn3
{  position:absolute;
    width: 10%;
    background-color: green;
    color: white;
    padding: 14px 20px;
    margin-top: -45%;
    margin-left: 77%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
#btn1
{position:absolute;
    width: 11%;
    background-color: green;
    color: white;
    padding: 14px 20px;
    margin-top:-26.1%;
    margin-left: 60%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
#btn2
{position:absolute;
    width: 10%;
    background-color: green;
    color: white;
    padding: 14px 20px;
    margin-top:-26.1%;
    margin-left: 72%;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=text], select 
{position:absolute;
    margin-top: -30%;
    margin-left:60%;
    width: 13%;
    padding: 12px 20px;
  display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
h2 
{ position: absolute;
    display: block;
    font-size: 0.7em;
    margin-top: -39%;
    margin-left: 60%;
    font-weight: bold;
    font-size: 25px;
}
        .title{
            text-align: center;
            font-family: 'Arial, Helvetica, sans-serif';
            letter-spacing: 0.2em;
            font-size: 4em;
            padding: 5px;
            color: darkblue;
             margin-bottom: 1%;
        }
                        .tagline{
            text-align: center;
            color: black;
            font-family: 'Times New Roman';
            letter-spacing: 0.2em;
            font-size: 2em;
            padding: 5px;
            margin-bottom: 2%;
        }

      
      
</style>
</head>
<body>
	    <h1 class="title">TRIP PLANNER</h1>
          <div class="tagline">Plan your Trips based on Weather and Reviews</div>
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

function logout()
{window.location = "logout.php";
}
function viewmy()
{window.location = "viewmy.php";
}
function view()
{window.location = "view.php";
}
function add()
{window.location = "add.php";
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
      <button id="btn3" onclick="viewmy();">MY REVIEWS</button>
      <button id="btn4" onclick="logout();">LOGOUT</button>

<input type="text" id="city" name="cit">
<button onclick="displayWeather()" id="b">SEARCH</button> 

      
      <button id="btn1" onclick="view();">VIEW REVIEWS</button>
      <button id="btn2" onclick="add();">ADD REVIEWS</button>


<h2>CLICK ON THE MAP MARKER TO VIEW THE WEATHER AT THAT LOCATION, OR SEARCH BY THE CITY NAME</h2>
<div id="w">WEATHER DETAILS</div>
</body>
</html>