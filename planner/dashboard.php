<?php include 'plannertop.php'; 

$con=mysqli_connect("localhost","root","","cyber");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_GET['category']) && $_GET['category'] == ""){
    unset($_GET['category']);
}
?>
<html>
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.divadd{
    padding:5px;
}
.add{
    background-color:#333;
    padding: 5px;
    color:white;
    font-weight: bold;
    text-decoration:none;
}
.preview{
  margin-top:10px;
  border: 1px solid black;
  border-radius: 10px;
  width:400px;
  min-height:600px;
  font-family:"Trebuchet MS", Helvetica, sans-serif;
  margin-left:auto;
  margin-right:auto;
  padding:5px;
}
.task{
  border: 1px solid black;
  border-radius: 10px;
  padding: 5px;
  margin-top: 10px;
}
.title{
  word-wrap: break-word;
  width:240px;
  padding:5px;
  display: inline-block;
}


.lineup{
    float:left;

}
.contain{
  float:left;
  width: 33%;
}
@media (max-width: 1265px) { 
  .contain{
    width:100%;
  }
}
.menuselect{
    padding:5px;
    margin:15px;
    font-size:20pt;
    background-color:#e6e6e6;
    font-weight:bold;
}
.options{
  display: inline-block;
  position:relative;

}
.options>ul.optionlist { 
  cursor: context-menu;
  display:none;
  position:absolute; left:40px; top:-58px; z-index:999;
  width:150px;
  margin:0; padding:10px; list-style:none;
  background:#fff; color:#333;
  -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;
  -moz-box-shadow:0 0 5px #999; -webkit-box-shadow:0 0 5px #999; box-shadow:0 0 5px #999
}
.options>ul.optionlist li {
  padding:10px;
  border-bottom: solid 1px #ccc;
}
.options>ul.optionlist li:hover {
  background:#3b3a30; color:white;
}
.options>ul.optionlist li:last-child { border:none }
.optionlist:after {
  right: 100%;
  top: 50%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(255, 255, 255, 0);
  border-right-color: #ffffff;
  border-width: 20px;
  margin-top: -20px;
}
.hide{
  display:none;
}
hr {
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}



</style>
</head>
<body>


<div style="margin-top:20px;">
  <!---<div ng-app="myApp" ng-controller="myCtrl" style="text-align:center;overflow:auto;margin-left: auto; margin-right:auto;">
    <h1>{{theTime}}</h1>
  </div>--->
  <center>
  <form method="get" action="dashboard.php" style="width:300px;display:inline;">
  <select class="menuselect" name="category" onchange="this.form.submit()">
  <?php 
  $currcat = "";
  if(isset($_GET['category'])){
      $sql = "SELECT id, name from category where id = '{$_GET['category']}'"; 
      $result = $con->query($sql);
      $row = $result->fetch_assoc();
      $currcat = $row['name'];
  ?>
      <option value="<?php echo $row['id'];?>" selected="selected"><?php echo $row['name'];?></option>
      <option value="">All</option>
  <?php
  }
  else {
  ?>
  <option value="">All</option>
  <?php
  }
  $sql = "SELECT id, name from category where uid = '{$_SESSION['userid']}' order by name";
  $result = $con->query($sql);
  while($row = $result->fetch_assoc()) {
      if($row['name'] != $currcat) {
  ?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
  <?php } 
     }
   
  ?>
      
  
  </select>
  </form>

  <br>
  
  <?php if(isset($_GET['category'])){ ?>
  <form method="POST" id="deletecatform" action="action.php">
      <input type="hidden" name="catid" value="<?php echo $_GET['category'];  ?>" >
      <input type="hidden" name="deletecat" value="<?php echo $_SESSION['userid']; ?>">
  </form>
  <button id="myBtn" class="add" style="">Add Task</button>
  <button id="catBtn" class="add" style="margin-left:10px;">Edit Category</button>
  <button id="" class="add" onclick="document.getElementById('deletecatform<?php echo $row["id"] ?>').submit();" style="background-color:red;margin-left:10px;">Delete</button> <?php }else{?>
  <button class="add" onclick="location.href = 'menu.php';">Menu</button><?php } ?>
  </center>
<br>
<div class="contain">
  <div class="preview" style="border: 1px solid black;">
    <?php
    	if(isset($_GET['category'])){
	    $sql = "SELECT id, title, due_date, priority, description FROM planner where uid = '{$_SESSION['userid']}' and todo = 1 and cid = '{$_GET['category']}'order by priority, due_date desc";
	}
	else{
	    $sql = "SELECT id, title, due_date, priority, description FROM planner where uid = '{$_SESSION['userid']}' and todo = 1 order by priority, due_date desc";
	}
	$result = $con->query($sql);
	$num_result = $result->num_rows;
    ?>
    <span style="font-weight:bold; color:black;">To-Do (<?php echo $num_result; ?>)</span>
    <hr>
    <?php
	
	while($row = $result->fetch_assoc()) {
    ?>
    <div class="task" id="task<?php echo $row["id"] ?>"  style="background-color:#eaece5;">
        <div style="width:100%;">
          <div class="title unselectable" onclick="showDesc(<?php echo $row["id"] ?>)" style="width:340px;">
            <span style="color:<?php if($row['priority'] <= 3){echo 'red';}else if($row['priority'] > 3 && $row['priority'] < 7){echo '#b3b300';}else{echo 'green';}?>;">[<?php echo $row["priority"]; ?>]</span> <?php echo $row["title"];  ?>
          </div>
          <div class="options">
            <i onclick="options(<?php echo $row["id"] ?>);" class="fa fa-bars" style="font-size:20px"></i>
            <ul class="optionlist" id="options<?php echo $row["id"] ?>">
              <li onclick="document.getElementById('startform<?php echo $row["id"] ?>').submit();">
                  <form method="POST" action="action.php" id="startform<?php echo $row["id"] ?>">
	              <input type="hidden" name="start" value="1"/>
	              <input type="hidden" name="taskid" value="<?php echo $row["id"];  ?>" >
	              Start <i class="fa fa-arrow-right"></i>
	          </form>
              </li>
              <li onclick="document.getElementById('editform<?php echo $row["id"] ?>').submit();">
              <form method="POST" id="editform<?php echo $row["id"] ?>" action="dashboard.php<?php if(isset($_GET['category'])){ echo "?category=" . $_GET['category']; }?>">
                  <input type="hidden" name="taskid" value="<?php echo $row["id"]; ?>">
                  <?php if(isset($_GET['category'])){ ?>
              	  <input type="hidden" name="catid" value="<?php echo $_GET['category'];?>">
              	  <?php } ?>
              	  <input type="hidden" name="edit" value="1">
          	  Edit <i class="fa fa-edit"></i>
              </form>
              </li>
              <li style="color:red" onclick="document.getElementById('deleteform<?php echo $row["id"] ?>').submit();">
                  <form method="POST" id="deleteform<?php echo $row["id"] ?>" action="action.php">
            	      <input type="hidden" name="taskid" value="<?php echo $row["id"];  ?>" >
            	      <input type="hidden" name="delete" value="1">
            	      Delete <i class="fa fa-close"></i>
                  </form>
              </li>
            </ul>
          </div>
        
        </div>
        <div id="desc<?php echo $row["id"] ?>" style="display:none;">
          
          
          <div style="width:100%;"><b>Due Date:</b> <?php if($row["due_date"] == "") {echo "None";}else{ echo $row["due_date"]; } ?> 
             
              	 
          </div> 
          
          <b>Priority:</b> <span><?php echo $row["priority"]  ?> </span><br>
          <div style="word-wrap:break-word;width:350px"><?php 
                    	if($row["description"] == "")
                    	{
                    		echo "No Description.";
                    	}
                    	else{
                    		echo $row["description"];  
                    	}
                    	
                    ?></div>
        </div> 
      </div>
      <?php } ?>
  </div>
</div>
<div class="contain">
  <div class="preview" style="border: 1px solid black;">
  <?php 
  	if(isset($_GET['category'])){
            $sql = "SELECT id, title, due_date, priority, description, bar FROM planner where uid = '{$_SESSION['userid']}' and in_progress = 1 and cid = '{$_GET['category']}' order by priority, due_date desc";
        }
        else {
            $sql = "SELECT id, title, due_date, priority, description, bar FROM planner where uid = '{$_SESSION['userid']}' and in_progress = 1 order by priority, due_date desc";
        }
	$result = $con->query($sql);
	$num_result = $result->num_rows;
  ?>
    <span style="font-weight:bold; color:black;">In Progress (<?php echo $num_result; ?>)</span>
    <hr>
    <?php
	while($row = $result->fetch_assoc()) {
    ?>
    <div class="task" id="task<?php echo $row["id"];  ?>" style="background-color:#c0ded9;">
        <div style="width:100%;">
          <div class="title unselectable" onclick="showDesc(<?php echo $row["id"];  ?>)" style="width:340px;">
            <span style="color:<?php if($row['priority'] <= 3){echo 'red';}else if($row['priority'] > 3 && $row['priority'] < 7){echo '#cccc00';}else{echo 'green';}?>;">[<?php echo $row["priority"]; ?>]
			</span> <?php echo $row["title"];  ?>
			<div class="w3-light-grey" style="background-color:#b2c2bf;">
			  <div id="myBar<?php echo $row["id"];  ?>" class="w3-container w3-center" style="background-color:#b2c2bf;width:<?php echo $row["bar"]; ?>%"><?php if($row["bar"] != 10){ echo $row["bar"];?>%<?php }else{ ?>&nbsp<?php } ?></div>
			</div>
          </div>
          <div class="options">
            <i onclick="options(<?php echo $row["id"] ?>);" class="fa fa-bars" style="font-size:20px"></i>
            <ul class="optionlist" id="options<?php echo $row["id"] ?>" style="position:absolute; left:40px; top:-78px; z-index:999;">
              <li onclick="document.getElementById('startform<?php echo $row["id"] ?>').submit();">
                  <form method="POST" action="action.php" id="startform<?php echo $row["id"] ?>">
	              <input type="hidden" name="done" value="1"/>
	              <input type="hidden" name="taskid" value="<?php echo $row["id"];  ?>" >
	              Done <i class="fa fa-arrow-right"></i>
	          </form>
              </li>
              <li onclick="document.getElementById('todoform<?php echo $row["id"] ?>').submit();">
                  <form method="POST" action="action.php" id="todoform<?php echo $row["id"] ?>">
	              <input type="hidden" name="todo" value="1"/>
	              <input type="hidden" name="taskid" value="<?php echo $row["id"];  ?>" >
	              To-Do <i class="fa fa-arrow-left"></i>
	          </form>
	      </li>
              <li onclick="document.getElementById('editform<?php echo $row["id"] ?>').submit();">
              <form method="POST" id="editform<?php echo $row["id"] ?>" action="dashboard.php<?php if(isset($_GET['category'])){ echo "?category=" . $_GET['category']; }?>">
                  <input type="hidden" name="taskid" value="<?php echo $row["id"]; ?>">
                  <?php if(isset($_GET['category'])){ ?>
              	  <input type="hidden" name="catid" value="<?php echo $_GET['category'];?>">
              	  <input type="hidden" name="edit" value="<?php echo $_GET['category'];?>">
              	  <?php } ?>
          	  Edit <i class="fa fa-edit"></i>
              </form>
              </li>
              <li style="color:red" onclick="document.getElementById('deleteform<?php echo $row["id"] ?>').submit();">
                  <form method="POST" id="deleteform<?php echo $row["id"] ?>" action="action.php">
            	      <input type="hidden" name="taskid" value="<?php echo $row["id"];  ?>" >
            	      <input type="hidden" name="delete" value="1">
            	      Delete <i class="fa fa-close"></i>
                  </form>
              </li>
            </ul>
          </div>
        </div>  
        <div id="desc<?php echo $row["id"];  ?>" style="display:none;">
			<div style="width:100%;">
			<form method="POST" action="action.php" id="barform<?php echo $row["id"] ?>">
				<input type="hidden" name="taskid" value="<?php echo $row["id"]; ?>" >
				<input type="hidden" name="changebar">
				<input type="hidden" value="<?php echo $row["bar"]; ?>" id="perc<?php echo $row["id"]; ?>" name="perc<?php echo $row["id"]; ?>">
			</form>
			<button class="add" onclick="moveLeft(<?php echo $row["id"]; ?>)" style="width:15%;padding:1px;">-10%</button> 
			<button class="add" style="margin-left:21%;width:15%;padding:1px;" onclick="document.getElementById('barform<?php echo $row["id"] ?>').submit();">Save</button>
			<button class="add" onclick="moveRight(<?php echo $row["id"]; ?>)" style="margin-left:21%;width:15%;padding:1px;">+10%</button> 
			</div>
          <div style="width:100%;"><b>Due Date:</b> <?php if($row["due_date"] == "") {echo "None";}else{ echo $row["due_date"]; } ?> 
              
      	    
              
          </div> 
        
          <b>Priority:</b> <span><?php echo $row["priority"]  ?> </span><br>
          <div style="word-wrap:break-word;width:350px"><?php 
                    	if($row["description"] == "")
                    	{
                    		echo "No Description.";
                    	}
                    	else{
                    		echo $row["description"];  
                    	}
                    	
                    ?></div>
        </div> 
      </div>
      <?php } ?>
  </div>
</div>
<div class="contain">
  <div class="preview" style="border: 1px solid black;">
   <?php
   	if(isset($_GET['category'])){
            $sql = "SELECT id, title, due_date, priority, description FROM planner where uid = '{$_SESSION['userid']}' and done = 1 and cid = '{$_GET['category']}' order by priority, due_date desc ";
        }
        else {
            $sql = "SELECT id, title, due_date, priority, description FROM planner where uid = '{$_SESSION['userid']}' and done = 1 order by priority, due_date desc ";
        }
    	
	$result = $con->query($sql);
	$num_result = $result->num_rows;
   ?>
    <span style="font-weight:bold; color:black;">Done (<?php echo $num_result; ?>)</span>
    <hr>
    <?php 
	while($row = $result->fetch_assoc()) {
    ?>
    <div class="task" id="task<?php echo $row["id"];  ?>" style="background-color:#b2c2bf;">
        <div style="width:100%;">
          <div class="title unselectable" onclick="showDesc(<?php echo $row["id"];  ?>)" style="width:330px;">
            <span style="color:<?php if($row['priority'] <= 3){echo 'red';}else if($row['priority'] > 3 && $row['priority'] < 7){echo '#e6e600';}else{echo 'green';}?>;">[<?php echo $row["priority"]; ?>]</span> <?php echo $row["title"];  ?>
          </div>
          <div style="display: inline-block;position:absolute;">
            <div class="lineup" style="margin-top:3px;">
            <form method="POST" action="action.php">
            	<input type="hidden" name="taskid" value="<?php echo $row["id"];  ?>" >
            	<button name="delete" class="delete"><i class="fa fa-close" style="color:white;"></i></button>
            </form>
            </div>
          </div>
        </div>
        <div id="desc<?php echo $row["id"];  ?>" style="display:none;">
          <B>Due Date:</b> <span><?php if($row["due_date"] == "") {echo "None";}else{ echo $row["due_date"]; } ?></span><br>
          <b>Priority:</b> <span><?php echo $row["priority"]  ?> </span><br>
          <div style="word-wrap:break-word;width:350px"><?php 
                    	if($row["description"] == "")
                    	{
                    		echo "No Description.";
                    	}
                    	else{
                    		echo $row["description"];  
                    	}
                    	
                    ?></div>
        </div> 
      </div>
      <?php } ?>
  </div>
 </div>
</div>
</body>
</html>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Get the modalcat
var modalcat = document.getElementById('catModal');

// Get the button that opens the modal
var catbtn = document.getElementById("catBtn");

// Get the <span> element that closes the modal
var catspan = document.getElementsByClassName("close")[1];

// When the user clicks the button, open the modal 
catbtn.onclick = function() {
    modalcat.style.display = "block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalcat) {
        modalcat.style.display = "none";
    }
}

function showDesc(id){
  $("#desc" + id).slideToggle("medium");
}
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $interval) {
  $scope.theTime = new Date().toLocaleTimeString();
  $interval(function () {
      $scope.theTime = new Date().toLocaleTimeString();
  }, 1000);
});

function options(id){
  var optionlists = document.getElementsByClassName("optionlist");
  var length = optionlists.length;
  for(var i = 0; i < length; i++)
  {
    optionlists[i].style.display = "none";
  }
  $("#options" + id).fadeToggle("medium");

}

// Detect all clicks on the document
document.addEventListener("click", function(event) {
  // If user clicks inside the element, do nothing
  if (event.target.closest(".options")) return;

  // If user clicks outside the element, hide it!
  var optionlists = document.getElementsByClassName("optionlist");
  var length = optionlists.length;
  for(var i = 0; i < length; i++)
  {
    optionlists[i].style.display = "none";
  }
  
});

function moveRight(id) {
  var elem = document.getElementById("myBar" + id); 
  var val = parseInt(document.getElementById("perc" + id).value);
  if(val != 100){
	var width = val + 10;
    document.getElementById("perc" + id).value = width;
  
    elem.style.width = width + '%'; 
    elem.innerHTML = width * 1  + '%'; 
  }
  
}
function moveLeft(id) {
  var elem = document.getElementById("myBar" + id);   
  var val = parseInt(document.getElementById("perc" + id).value);
  
  if(val == 20){
	var width = val - 10;
    document.getElementById("perc" + id).value = width;
  
    elem.style.width = width + '%'; 
    elem.innerHTML = "&nbsp"; 
  }
  else if(val == 10){
	  
  }
  else{
	var width = val - 10;
    document.getElementById("perc" + id).value = width;
  
    elem.style.width = width + '%'; 
    elem.innerHTML = width * 1  + '%'; 
  }
}
</script>