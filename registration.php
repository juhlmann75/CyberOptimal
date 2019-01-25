

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
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post"><br>
<input type="text" name="username" placeholder="Username" required /><br>
<input type="email" name="email" placeholder="Email" required /><br>
<input type="password" name="password" placeholder="Password" required /><br><br>
<input type="submit" name="submit" value="Register" />
</form>

</div>
<?php } ?>
</body>
</html>
