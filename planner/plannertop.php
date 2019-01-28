<?php 

include '../mastertop.php'; 
?>
<title>Optimal Tasking</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 25%;
    border-radius:10px;
    overflow: auto;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
ul.sidenav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #b2c2bf;
}

li.sidenav {
    float: left;
}

li a.sidenav {
    display: block;
    color: #3b3a30;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-weight:550;
}
.unselectable {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.delete{
  background-color:red;
  margin-left:5px;
  margin-right:5px;
  border:none;

}
.switch{
  margin-left:5px;
  margin-right:5px;
  margin-top:5px;
  border:none;
}
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
</style>
<!---
<ul class="sidenav" style="">
  <li class="sidenav"><a class="sidenav" href="dashboard.php" style="background-color:<?php if(strpos($_SERVER['REQUEST_URI'], 'dashboard')) { echo '#e6e6e6;color:#3b3a30;';}else{echo '#b2c2bf;';} ?>">Dashboard</a></li>
  <li class="sidenav"><a href="todo.php" class="sidenav" style="background-color:<?php if(strpos($_SERVER['REQUEST_URI'], 'todo')) { echo '#e6e6e6;color:#3b3a30;';}else{echo '#b2c2bf;';} ?>">To-Do</a></li>
  <li class="sidenav"><a href="inprog.php" class="sidenav" style="background-color:<?php if(strpos($_SERVER['REQUEST_URI'], 'inprog')) { echo '#e6e6e6;color:#3b3a30;';}else{echo '#b2c2bf;';} ?>">In Progress</a></li>
  <li class="sidenav"><a href="done.php" class="sidenav" style="background-color:<?php if(strpos($_SERVER['REQUEST_URI'], 'done')) { echo '#e6e6e6;color:#3b3a30;';}else{echo '#b2c2bf;';} ?>">Done</a></li>
  <li class="sidenav" style="border-right:none;"><a href="guide.php" class="sidenav" style="border-right:none;background-color:<?php if(strpos($_SERVER['REQUEST_URI'], 'guide')) { echo '#e6e6e6;color:#3b3a30;';}else{echo '#b2c2bf;';} ?>">User&#39;s Guide</a></li>
</ul>--->
<div id="myModal" class="modal">
        <div class="modal-content">
        <form method="post" action="action.php">
            <input type="hidden" name="add" value="<?php echo $_SESSION['userid']; ?>">
            <?php if(isset($_GET['category'])){?>
            <input type="hidden" name="catid" value="<?php echo $_GET['category']; ?>">
            <?php }?> 
            <span class="close">&times;</span>
            <div style="padding:10px;">
                <div class="divadd">
                    <b>Title</b><br>
                    <input name="title" type="text" style="width:80%;" maxlength="35" required="required">
                </div>
                <div class="divadd">
                <b>Description</b> <br>
                <textarea name="description" ng-model="message" cols="50" rows="4" style="width:80%" maxlength="200"></textarea>
                </div>
                <div class="divadd" style="float:left;padding-right:25%;">
                <b>Due Date</b><br><input type="date" name="duedate">
                </div>
                <div class="divadd" style="float:left;">
                    <b>Priority</b><br>
                    <select name="priority" style="width: 100px; padding: 2px;">
	               <?php
	                for($i = 1; $i <= 10; $i++){
	                    echo '<option value="' . $i . '">' . $i . "</option>";
	                }
                    	?>
                    </select> 
                </div>
            </div><br><br>
            <div style="margin-top:25px">
                <center><input type="submit" value="Add" class="add" style="width:80px;height:40px;"> </center>
            </div>
        </form>
        </div>
    </div>
 
<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost","root","","cyber");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $id = mysqli_real_escape_string($con, $_POST["taskid"]);
    $sql = "SELECT title, due_date, priority, description FROM planner where uid = '{$_SESSION['userid']}' and id = '$id'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
?>
<div id="editModal" class="modal" style="display:block;">
        <div class="modal-content">
        <form method="post" action="action.php">
            <input type="hidden" name="taskid" value="<?php echo $id; ?>">
            <input type="hidden" name="catid" value="<?php echo $_GET['category']; ?>">
            <span class="close" onclick="cancel();">&times;</span>
            <div style="padding:10px;">
                <div class="divadd">
                    <b>Title</b><br>
                    <input name="title" type="text" style="width:80%;" maxlength="35" value="<?php echo $row["title"]; ?>" required="required">
                </div>
                <div class="divadd">
                <b>Description</b> <br>
                <textarea name="description" ng-model="message" cols="50" rows="4" style="width:80%" maxlength="200"><?php echo $row["description"]; ?></textarea>
                </div>
                <div class="divadd" style="float:left;padding-right:25%;">
                <b>Due Date</b><br><input type="date" name="duedate" value="<?php echo $row["due_date"]; ?>">
                </div>
                <div class="divadd" style="float:left;">
                    <b>Priority</b><br>
                    <select name="priority" value="<?php echo $row["priority"]; ?>" style="width: 100px; padding: 2px;">
	               <?php
	                for($i = 1; $i <= 10; $i++){
	                    if($i == $row["priority"])
	                    {
	                    	echo '<option selected="selected" value="' . $i . '">' . $i . "</option>";
	                    }
	                    else{
	                    	echo '<option value="' . $i . '">' . $i . "</option>";
	                    }
	                    
	                }
                    	?>
                    </select> 
                </div>
            </div><br><br>
            <div style="margin-top:25px">
                <center><input type="submit" name="edit" value="Edit" class="add" style="width:80px;height:40px;"> </center>
            </div>
        </form>
        </div>
    </div>
<?php }
?>
<?php
    $con = mysqli_connect("localhost","root","","cyber");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	if(isset($_GET['category'])){
		$sql = "SELECT id, uid, name FROM category where uid = '{$_SESSION['userid']}' and id = '{$_GET['category']}'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
	}
    
?>
<div id="catModal" class="modal">
        <div class="modal-content">
        <form method="post" action="action.php">
            <input type="hidden" name="catid" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="userid" value="<?php echo $row['uid']; ?>">
            <span class="close" onclick="cancelcat()">&times;</span>
            <div style="padding:10px;">
                <div class="divadd">
                    <b>Category Name</b><br>
                    <input name="title" type="text" style="width:80%;" maxlength="35" value="<?php echo $row['name']; ?>" required="required">
                </div>
            </div>
            <div style="margin-top:25px">
                <center><input type="submit" name="editcat" value="Edit" class="add" style="width:80px;height:40px;"> </center>
            </div>
        </form>
        </div>
    </div>
<script>
function cancel(){
document.getElementById("editModal").style.display = "none";
}
function cancelcat(){
document.getElementById("catModal").style.display = "none";
}
</script>

