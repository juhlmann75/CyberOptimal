<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cyber Optimal</title>
<style>
body {
    font-family: Helvetica;
    background-color:#b3b3b3;
    color:white;
}
.clearfix:before, .clearfix:after 
{ 
    content: ""; display: table; 
}
.clearfix:after 
{ 
    clear: both; 
}
a {
    color:lightblue; text-decoration:none;
}
a:hover {
    text-decoration:underline;
}
.form{
    width: 600px; 
    margin:auto;
    margin-top:10%;
    padding:100px;
    background-color:#333;
    text-align:center;
    border-radius:20px;
}
input[type='text'], input[type='email'], input[type='password'] {
    width: 200px; border: none; padding: 10px; color: #333; font-size: 14px; margin-top: 10px;
}
input[type='submit']{
    padding: 10px 25px 8px; color: white; background-color: gray;  font-size: 16px; margin-top: 10px; cursor:pointer; border:none;
    }
input[type='submit']:hover {
    background-color: darkgray;
}
</style>
</head>
<body>
<?php
	require('db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
        		$row = $result->fetch_assoc();
			$_SESSION['username'] = $username;
			$_SESSION['userid'] = $row["id"];
			header("Location: index.php"); // Redirect user to index.php
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				}
    }else{
?>
<div class="form">
<h1>Cyber Optimal</h1>
<h3>Log In</h3>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required /><br>
<input type="password" name="password" placeholder="Password" required /><br><br>
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>

</div>
<?php } ?>


</body>
</html>
