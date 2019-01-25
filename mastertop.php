<?php

include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
h1,h2,h3,h4,h5,h6 {font-family: Verdana}
body{
background-color: #e6e6e6;
  margin:0;
  font-family:Tahoma;
}
.fa-clock-o,.fa-tasks {font-size:200px}
.topnav {
  background-color: #3b3a30;
  color:white;
}
ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #3b3a30;
}

.activetop {
    background-color: gray;
}
</style>
</head>


<body>
<div class="w3-top">
  <div class="w3-bar w3-card w3-left-align w3-large topnav">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-gray" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="/index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white">Home</a>
    <a href="/planner/menu.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Optimal Tasking</a>
    <a href="/logout.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" style="float:right;">Log Out</a>
  </div>

  <!-- Navbar on small screens  -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="/planner/menu.php" class="w3-bar-item w3-button w3-padding-large">Optimal Tasking</a>
    <a href="/logout.php" class="w3-bar-item w3-button w3-padding-large">Log Out</a>
    
  </div>
</div>
<br><br>
<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

