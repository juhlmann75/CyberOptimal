<?php include 'plannertop.php'; 

$con=mysqli_connect("localhost","root","","cyber");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT id, name FROM category WHERE uid = '{$_SESSION['userid']}' order by name";
$result = $con->query($sql);

?>
<title>Optimal Tasking</title>
<style>
.menuoption1{
    background-color:#eaece5;
    
    padding-top:10px;
    padding-bottom:10px;
    text-align:center;
}
.menuoption2{
    background-color:#b2c2bf;
    
    padding-top:10px;
    padding-bottom:10px;
    text-align:center;
}
.menuoption3{
    background-color:#c0ded9;
   
    padding-top:10px;
    padding-bottom:10px;
    text-align:center;
}
.addoption {
    background-color:gray;
    
    padding-top:50px;
    padding-bottom:50px;
    text-align:center;

    font-size: 20pt;
    font-weight:bold;
}
.menu{
    padding-left:10%;
    padding-right:10%;
    background-color:#3b3a30;
}
.menuoption1:hover{
    background-color:#3b3a30;
    color:white;
}
.menuoption2:hover{
    background-color:#3b3a30;
    color:white;
}
.menuoption3:hover{
    background-color:#3b3a30;
    color:white;
}
</style>

<div class="menu">
<?php
    $sql = "SELECT id, title, due_date, priority, description FROM planner where uid = '{$_SESSION['userid']}' and todo = 1 order by priority, due_date desc";
?>
<div class="menuoption1" style="cursor: pointer;padding-top:25px;padding-bottom:25px;" onclick="window.location='dashboard.php';"><h1><b>All</b></h1> </div>
<?php 
$optionCount = 2;
while($row = $result->fetch_assoc()) { 

    $sql1 = "SELECT 1 FROM planner where uid = '{$_SESSION['userid']}' and todo = 1 and cid = '{$row['id']}'";
    $sql2 = "SELECT 1 FROM planner where uid = '{$_SESSION['userid']}' and in_progress = 1 and cid = '{$row['id']}'";
    $result1 = $con->query($sql1);
    $result2 = $con->query($sql2);
    $num_result1 = $result1->num_rows;
    $num_result2 = $result2->num_rows;
?>
    <div class="menuoption<?php echo $optionCount;?>" style="cursor: pointer;" onclick="window.location='dashboard.php?category=<?php echo $row["id"]; ?>';">
        <h1><b><?php echo $row["name"]; ?></b></h1>
        <p>To-Do: <?php echo $num_result1; ?> | In Progress: <?php echo $num_result2; ?></p>
    </div>
 <?php 
 if($optionCount == 3){
     $optionCount = 0;
 }
 $optionCount++;
 } ?>  
    <div class="addoption">
        <form method="post" action="action.php">
            <input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>">
            <input type="text" style="width:250px;padding:10px;font:20pt;" name="catname" placeholder="New Category">
            <input type="submit" name="addcategory" value="Add" style="width:100px;padding:10px;margin-top:10px;" class="add">
        </form> 
    </div>
</div>