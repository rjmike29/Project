<?php require 'mainmenu.php';?>
<?php require 'config.php';?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	 <script src="bootstrap/dist/js/bootstrap.min.js"></script>
<style>
input
{
	//background-color:green;
	//color:white;
	//width:160px;
	//height:40px;
}
input:hover
{
	//opacity:0.9;
}
</style>
</head>
<body style='background-color:#99CCFF;'>
<?php
	echo"<div class='container'>";
	if(isset($_POST['su']))
	{
		$firstname=$_POST['fname'];
		$secondname=$_POST['sname'];
		$email=$_POST['email'];
		$arr=explode('@',$email);
		$web_site=$arr[1];
		$username=$_POST['username'];
		$pwd=$_POST['cpwd'];
		$mob=$_POST['mob'];
		$address=$_POST['address'];
		$confirm_code=md5(uniqid(rand()));
		$sql="insert into temp_members values('$confirm_code','$username','$firstname','$secondname','$email','$pwd','$mob','$address')";
		$result=mysql_query($sql,$con);

		if($result)
		{
			$to=$email;
			$subject="Confirm Your e-mail";
			$message="Welcome to SnapKart! You are one step away from joining us and getting exciting offers. \r\n";
			$message.="Click on this link to activate your account: \r\n";
			$message.="http://localhost/project/confirm_email.php?passkey=$confirm_code";
			$sentmail=mail($to,$subject,$message);
			if($sentmail)
			{
				echo"<div class='alert alert-success'><b>We have sent you a confirmation link to your email address.<br/>Check your inbox</div></b><br/><br/>";
				echo"<a href='http://www.$web_site'><button class='btn btn-success'><span class='glyphicon glyphicon-envelope'></span> Check your mailbox</button></a><br/>";
				echo"<br/><a href='e2.firstpage.php'><button class='btn btn-warning' style='width:170px;'>Browse Products</button></a>";
			}
			else
			{
				echo"Your given mail id doesn't exist";
				echo"<a href='signup.html'><button class='btn btn-danger'>Resubmit Form</button></a>";
			}
		}
		else
		{
			echo"<div class='alert alert-danger'><b>It looks like you've signed up before. We have already sent you a confirmation link to your email address.</b><br/>Check your inbox</div></b><br/><br/>";
			echo"<a href='http://www.$web_site'><button class='btn btn-success'><span class='glyphicon glyphicon-envelope'></span> Check your mailbox</button></a>";
		}
		
		unset($_POST['su']);
	}
	if(isset($_GET['passkey']))
	{
		$confirm_code=$_GET['passkey'];
		$sql="select * from temp_members where confirm_code='$confirm_code'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$rc=mysql_fetch_row($result);
		if($rc!=null)
		{
			$username=$rc[1];
			$firstname=$rc[2];
			$secondname=$rc[3];
			$email=$rc[4];
			$password=$rc[5];
			$mob=$rc[6];
			$address=$rc[7];
			$sql="insert into members (firstname,secondname,address,email,mob,username,password) values('$firstname','$secondname','$address','$email','$mob','$username','$password')";
			$result=mysql_query($sql,$con) or die(mysql_error());
			if($result)
			{
				$sql="delete from temp_members where confirm_code='$confirm_code'";
				mysql_query($sql,$con) or die(mysql_error());
				//$_SESSION['mem_id']=$rec[0];
				$_SESSION['firstname']=$rc[2];
				$_SESSION['secondname']=$rc[3];
				$_SESSION['address']=$rc[7];
				$_SESSION['email']=$rc[4];
				$_SESSION['mob']=$rc[6];
				$_SESSION['password']=$rc[5];
				$_SESSION['username']=$rc[1];
				echo"<script>alert('You are now a registered member');window.location.href='account_details.php';</script>";
			}
			else	
				echo"<script>alert('Oops!Something went wrong');window.location.href='signup.php';</script>";
		}
		else	
			echo"<script>alert('Invalid Confirmation Code');</script>";	
	}
	echo"</div>";
?>
</body>
