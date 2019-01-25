<?php include 'mastertop.php'; ?>
<title>Cyber Optimal</title>

<body>
<header class="w3-container w3-center" style="padding:128px 16px; background-color:#c0ded9;">
  <h1 class="w3-margin w3-jumbo" style="">CYBER OPTIMAL</h1>
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
