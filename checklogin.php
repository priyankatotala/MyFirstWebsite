<?php
session_start();

$con = mysqli_connect("localhost", "root","") or die(mysqli_error());

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

mysqli_select_db($con, "first_db") or die(mysqli_error());
$query = mysqli_query($con, "SELECT * FROM users where username='$username'");
$exists = mysqli_num_rows($query);
$table_user = "";
$table_password = "";
if($exists > 0) 
{
	while($row = mysqli_fetch_assoc($query)) 

	{
		$table_users= $username;
		$table_password = $password;
	}
	if(($username == $table_users) && ($password == $table_password))
	{
		if($password == $table_password) 
		{
			$_SESSION['user'] = $username;
			header("location: home.php");
		}
	} 

	else
	{
		Print '<script> alert("incorrect password");</script>';
		Print '<script>window.assign.location("login.php");</script>';
	}

}

else
{
		Print '<script> alert("incorrect username");</script>';
		Print '<script>window.assign.location("login.php");</script>';
}
?>