<!DOCTYPE html>
<html>
<title>Cyber Optimal</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
h1,h2,h3,h4,h5,h6 {font-family: Verdana}
body{font-family: Tahoma}
.fa-clock-o,.fa-tasks {font-size:200px}
.topnav {
  background-color: #3b3a30;
  color:white;
}
</style>
<body>
<div class="w3-top">
  <div class="w3-bar w3-card w3-left-align w3-large topnav">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-gray" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="/index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="/login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Optimal Tasking</a>
    <a href="/login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" style="float:right;">Log In</a>
  </div>

  <!-- Navbar on small screens  -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="/login.php" class="w3-bar-item w3-button w3-padding-large">Log In</a>
    <a href="/login.php" class="w3-bar-item w3-button w3-padding-large">Optimal Tasking</a>
  </div>
</div>

<header class="w3-container w3-center" style="padding:128px 16px; background-color:#c0ded9;">
  <h1 class="w3-margin w3-jumbo" style="">CYBER OPTIMAL</h1>
  <button class="w3-button w3-padding-large w3-large w3-margin-top" style="background-color:#3b3a30;color:white;" onclick="location.href = '/registration.php';">Register Now</button>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container" style="background-color:#eaece5;">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Time Management</h1>
      <h5 class="w3-padding-32">Cyber Optimal helps you manage your time with various online tools.</h5>

      <p class="w3-text-grey">To access these tools, you will need to register an account. You'll be able to access Cyber Optimal on a computer, tablet, or phone, as long
      as you are connected to the internet.
      </p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-clock-o w3-padding-64" style="color:#3b3a30;"></i>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-padding-64 w3-container" style="background-color:#b2c2bf;">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-tasks w3-padding-64 w3-margin-right" style="color:#3b3a30;"></i>
    </div>

    <div class="w3-twothird">
      <h1>Optimal Tasking</h1>
      <h5 class="w3-padding-32">Allows you to manage your tasks.</h5>

      <p style="color:#4d4d4d;">Tasks are organized into categories such as Work, School, Personal, etc. You are able to create your own categories. 
      Within those categories, tasks are sorted by To-Do, In Progress, and Done. Creating a task will automatically appear under To-Do. When you start the task, it will appear under In Progress.
      Once you complete the task, it will appear under Done. You can either leave the task there or delete it.</p>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Coming Soon</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  

</footer>

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

</body>
</html>
