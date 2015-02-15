<?php session_start();?>
<?php require"config.php"?>
<?php
	if(isset($_POST["login"]))
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$sql="select admin_id from admin where username='$username' and password='$password'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$rec=mysql_fetch_row($result);
		if($rec==null)
		{
			echo"<script>alert('Wrong username or password');</script>";
		}
		else
		{
			$_SESSION['admin_id']=$rec[0];
			$_SESSION['username']=$username;
			echo"<script>alert('Welcome $username');window.location.href='admin.php';</script>";
		}
	}
?>
<html>
<head>
<title>Admin Login</title>
</head>
<body>
<h1 style="font-family:Lucida Console;font-size:xx-large;margin-top:10%;margin-left:40%;">
Welcome Admin
</h1>
<br/>
<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST">
<table style="margin-left:40%;">
<tr>
<td style="padding:5px 0px 10px;"><input type="text" required name="username" placeholder="Username" style="width:250px;height:50px;" required></td>
</tr>
<tr>
<td>
<input type="password" required name="password" placeholder="password" style="width:250px;height:50px;" required>
</td>

</tr>
<tr>
<td style="padding:15px 82px 5px;"><input type="submit" value="Login" name="login" style="width:85px;height:50px;background-color:blue;color:white;"></td>
</tr>
<tr>
<td style="padding:10px 50px 0px;">
</table>
</form>


</body>
</html>