<?php

$con=mysqli_connect("localhost","root","","cyber");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($_POST['start'])){
    $sql = "UPDATE planner set in_progress = 1, todo = 0 where id = '{$_POST['taskid']}'";
    if ($con->query($sql) === TRUE) {
	echo "Record updated successfully";
    } 
    else {
	echo "Error updating record: " . $con->error;
    }
    
}
else if(isset($_POST['todo'])){
    $sql = "UPDATE planner set in_progress = 0, todo = 1 where id = '{$_POST['taskid']}'";
    if ($con->query($sql) === TRUE) {
	echo "Record updated successfully";
    } 
    else {
	echo "Error updating record: " . $con->error;
    }
}
else if(isset($_POST['delete'])){
    $sql = "DELETE FROM planner WHERE id = '{$_POST['taskid']}'";
    if ($con->query($sql) === TRUE) {
	echo "Record updated successfully";
    } 
    else {
	echo "Error updating record: " . $con->error;
    }
}
else if(isset($_POST['deletecat'])){
    $catid = mysqli_real_escape_string($con, $_POST["catid"]);
    $id = mysqli_real_escape_string($con, $_POST["deletecat"]);
    
    $sql = "DELETE FROM category WHERE id = '$catid' and uid = '$id'";
    
    if ($con->query($sql) === TRUE) {
	echo "Record updated successfully";
    } 
    else {
	echo "Error updating record: " . $con->error;
    }
    $sql = "DELETE FROM planner WHERE cid = '$catid' and uid = '$id'";
    if ($con->query($sql) === TRUE) {
	echo "Record updated successfully";
    } 
    else {
	echo "Error updating record: " . $con->error;
    }
    header("Location: menu.php");
    exit();
}
else if(isset($_POST['done'])){
    $sql = "UPDATE planner set done = 1, in_progress = 0 where id = '{$_POST['taskid']}'";
    if ($con->query($sql) === TRUE) {
	echo "Record updated successfully";
    } 
    else {
	echo "Error updating record: " . $con->error;
    }
}
else if (isset($_POST['add'])){
    $user_id = $title = $description = $duedate = $priority = $catid ="";
    
    $user_id = mysqli_real_escape_string($con, $_POST["add"]);

    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $duedate = mysqli_real_escape_string($con, $_POST["duedate"]);
    $priority = mysqli_real_escape_string($con, $_POST["priority"]);
    $catid = mysqli_real_escape_string($con, $_POST["catid"]);
	if($duedate == ''){
		$sql = "INSERT INTO planner (uid, cid, title, description, priority) VALUES ('$user_id', '$catid', '$title', '$description', '$priority')";
	}
	else{
		$sql = "INSERT INTO planner (uid, cid, title, description, due_date, priority) VALUES ('$user_id', '$catid', '$title', '$description', '$duedate', '$priority')";
	}
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
}
else if (isset($_POST['edit'])){
   $user_id = $title = $description = $duedate = $priority = $catid = "";
    
    $id = mysqli_real_escape_string($con, $_POST["taskid"]);

    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $duedate = mysqli_real_escape_string($con, $_POST["duedate"]);
    $priority = mysqli_real_escape_string($con, $_POST["priority"]);
    $catid = mysqli_real_escape_string($con, $_POST["catid"]);
    if(isset($_POST['edit'])){
        $sql = "UPDATE planner SET title='$title',description='$description',due_date='$duedate',priority='$priority' WHERE id = '$id'";
    } 
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
}
else if (isset($_POST['editcat'])){
   $user_id = $name = $catid = "";
    
    $id = mysqli_real_escape_string($con, $_POST["catid"]);
    $uid = mysqli_real_escape_string($con, $_POST["userid"]);
    $name = mysqli_real_escape_string($con, $_POST["title"]);
    
    
    $sql = "UPDATE category SET name='$name' WHERE id = '$id' and uid = '$uid'";
   
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
}
else if(isset($_POST['addcategory'])){
    $userid = $catname = "";
    $userid = mysqli_real_escape_string($con, $_POST["userid"]);
    $catname = mysqli_real_escape_string($con, $_POST["catname"]);
    
    $sql = "INSERT INTO category(uid, name) VALUES ('$userid', '$catname')";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
}
else if(isset($_POST['changebar'])){
	$taskid = mysqli_real_escape_string($con, $_POST["taskid"]);
	$perc = mysqli_real_escape_string($con, $_POST["perc" . $taskid]);
	
	$sql = "UPDATE planner SET bar='$perc' WHERE id = '$taskid'";
   
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

if(isset($_REQUEST["destination"])){
  header("Location: {$_REQUEST["destination"]}");
}else if(isset($_SERVER["HTTP_REFERER"])){
 header("Location: {$_SERVER["HTTP_REFERER"]}");
}else{
/* some fallback, maybe redirect to index.php */
header("Location: http://www.cyberoptimal.com/planner/menu.php"); /* Redirect browser */
}
exit();
?>