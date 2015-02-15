<?php session_start();?>
<?php require"config.php";?>
<?php
	$dt=date("y-m-d");
	if(isset($_SESSION["username"]))
	{
		$unm=$_SESSION["username"];
		$sql="update admin set last_logged='$dt' where username='$unm'";
		mysql_query($sql,$con) or die(mysql_error);
		session_unset();
		session_destroy();
	}
	echo"<script>alert('Bye!');window.location.href='index.php';</script>";


?>