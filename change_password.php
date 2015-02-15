<?php require"mainmenu.php";?>
<?php require"config.php";?>
<?php
	if(isset($_SESSION["password"])&&isset($_POST["change"]))
	{
		$opwd=$_POST["opwd"];
		$new_password=$_POST["npwd"];
		$confirm_password=$_POST["cpwd"];
		if(($opwd==$_SESSION["password"])&&($new_password==$confirm_password))
		{
			$mem_id=$_SESSION["mem_id"];
			$sql="update members set password='$new_password' where mem_id='$mem_id'";
			$result=mysql_query($sql,$con);
			if($result)
			{
				$_SESSION["password"]=$new_password;
				echo"<script>alert('Your password is updated');</script>";
			}
		}

	}

?>
<html>
<head>
<title>Change Password</title>
<script>
function validate(form)
{
	var spwd=form["spwd"].value;
	var opwd=form["opwd"].value;
	var npwd=form["npwd"].value;
	var cpwd=form["cpwd"].value;
	

	var span_opwd=document.getElementById("span_opwd");
	var div_opwd=document.getElementById("div_opwd");

	var span_cp=document.getElementById("span_cp");
	var div_cp=document.getElementById("div_cp");
	

	
	span_cp.className="";
	div_cp.style.display="none";
	
	span_opwd.className="";
	div_opwd.style.display="none";
	
	if(!(spwd == opwd))
	{
		span_opwd.className="glyphicon glyphicon-exclamation-sign form-control-feedback";
		div_opwd.style.display="inherit";

		return false;
	}
	if(!(npwd == cpwd))
	{
		span_cp.className="glyphicon glyphicon-exclamation-sign form-control-feedback";
		div_cp.style.display="inherit";
		return false;
	}

}
</script>
</head>
<body style='background-color:#99CCFF'>
<div class='container' style='width:30%;background-color:white;color:black;'>
<form role='form' class='form' action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST' onsubmit='return validate(this)'>
<input type='hidden' name='spwd' value='<?php echo $_SESSION["password"];?>'>

<div class='form-group has-feedback'>
<label for='opwd'>Old Password</label>
<input type="password" class='form-control' id='opwd' name="opwd" placeholder="Password" required>
<span id='span_opwd'></span>
<div id='div_opwd' class='alert alert-danger' style='display:none;'>This is not your current password</div>
</div>

<div class='form-group has-feedback'>
<label for='npwd'>New Password</label>
<input type="password" class='form-control' id='npwd' name="npwd" placeholder="Password" required>
</div>

<div class='form-group has-feedback'>
<label for='cpwd'>Confirm New Password</label>
<input type="password" class='form-control' id='cpwd' name="cpwd" placeholder="Confirm Password" required>
<span id='span_cp'></span>
<div id='div_cp' class='alert alert-danger' style='display:none;'>This password should match the password above</div>
</div>

<div class='form-group'>
<input type="submit" class='btn btn-primary' name="change" value="Change Password">
</div>
</form>
</div>
</body>
</html>