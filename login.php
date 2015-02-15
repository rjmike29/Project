<?php 
	require"mainmenu.php";
?>
<?php
if(isset($_POST["login"]))
{
	$u_name="'".$_POST["username"]."'";
	$password="'".$_POST["password"]."'";
	$con=mysql_connect("localhost","root","");
	if(!$con)
		die(mysql_error());
	mysql_select_db("product_details",$con) or die(mysql_error());
	$sql="select mem_id,firstname,secondname,address,email,mob,password from members where username=$u_name and password=$password";
	$result=mysql_query($sql)or die(mysql_error());
	$rec=mysql_fetch_row($result);
	if($rec==null)
	{
		echo"<script>alert('Wrong username or password');</script>";
	}
	else
	{
		$_SESSION['mem_id']=$rec[0];
		$_SESSION['firstname']=$rec[1];
		$_SESSION['secondname']=$rec[2];
		$_SESSION['address']=$rec[3];
		$_SESSION['email']=$rec[4];
		$_SESSION['mob']=$rec[5];
		$_SESSION['password']=$rec[6];
		$_SESSION['username']=$_POST["username"];
		echo"<script>alert('Welcome $rec[1]');window.location.href='e2.firstpage.php';</script>";

	}
}
	

?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/modernizr.custom.63321.js"></script>
</head>
<body style='background-color:#99CCFF'>
<div class='container' style='width:30%;background-color:white;color:black;'>
<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST" role='form' class='form'>

<div class='form-group'>
<label for='username'>Username</label>
<input type="text" id='username' class='form-control' name="username" placeholder="Username" required></td>
</div>

<div class='form-group'>
<label for='password'>Password</label>
<input type="password" class='form-control' id='password' name="password" placeholder="password" required>
</div>

<div class='form-group'>
<input type="submit" class='form-control btn btn-primary' value="Login" name="login">
</div>

</form>
<a href="signup.php">Don't have an account?</a>
</div>
</body>
</html>
