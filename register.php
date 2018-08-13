<!DOCTYPE html>
<html>
<head>
	<title>My first php website</title>
</head>
<body>
	<h2>REGISTER</h2>
	<a href="index.php"> HOME </a><br><br>
	<form action="register.php" method="POST">
		Enter Username: <input type="text" name="username" required="required" /> <br/>
		Enter Password: <input type="password" name="password" required="required" /> <br/>
		<input type="submit" name="LOGIN">
</form>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$con = mysqli_connect("localhost", "root", "") or die(mysqli_error());
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$bool = true;
	
	mysqli_select_db($con, "first_db") or die("Cannot connect to database");
	$query = mysqli_query($con, "select * from users");
	while($row= mysqli_fetch_array($query))
	{
		$table_users = $row['username'];
		if ($username == $table_users) {
			$bool = false;
			Print '<script> alert ("Username has been taken"); </script>';
			Print '<script>window.location.assign("register.php"); </script>';

			
		}
	}
if($bool)
{
	
	mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
	Print '<script> alert ("User registered successfuully"); </script>';
	Print '<script>window.location.assign("register.php"); </script>';
}
}
?>