<?php require"mainmenu.php";?>
<?php
	if(isset($_POST["sc"]))
	{
		$str=$_POST["name"];
		$nm=explode(" ",$str);
		$firstname="";
		$secondname="";
		for($i=0;$i<count($nm);$i++)
		{
			if($i==0)
				$firstname=$nm[$i];
			else
				$secondname=$secondname." ".$nm[$i];
		}
		$email=$_POST["email"];
		$mob=$_POST["mob"];
		$address=$_POST["address"];

		$u_name=$_SESSION['username'];
		$password=$_SESSION['password'];
		$con=mysql_connect("localhost","root","");
		if(!$con)
			die(mysql_error());
		mysql_select_db("product_details",$con) or die(mysql_error());
		$sql="update members SET firstname='".$firstname."',secondname='".$secondname."',email='".$email."',mob='".$mob."',address='$address' where username='$u_name' and password='$password'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($result)
		{
			$sql="select mem_id,firstname,secondname,address,email,mob,password from members where username='$u_name' and password='$password'";
			$result2=mysql_query($sql)or die(mysql_error());
			$rec=mysql_fetch_row($result2);
			$_SESSION['mem_id']=$rec[0];
			$_SESSION['firstname']=$rec[1];
			$_SESSION['secondname']=$rec[2];
			$_SESSION['address']=$rec[3];
			$_SESSION['email']=$rec[4];
			$_SESSION['mob']=$rec[5];
			$_SESSION['password']=$rec[6];
			$_SESSION['username']=$u_name;
			echo"<script>alert('Account Updated');</script>";
		}
		else
			echo"<script>alert('Something went wrong');</script>";
		
	
	
	
	}
?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/modernizr.custom.63321.js"></script>
<script>
function validate(form)
{
	var name=(form["name"].value).trim();
	var email=form["email"].value;
	var mob=form["mob"].value;
	var pat= /\D/;
	var result=mob.search(pat);
	var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
	
	
	
	
	var sppos=name.indexOf(" ");
	if(sppos==-1)
	{
		alert('Full name required');
		return false;
	}
	
	

	if(result!=-1 || mob.length!=10)
	{
        alert("Not a valid Mobile Number");
        return false;	
	
	}
	
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) 
	{
        alert("Not a valid e-mail address");
        return false;
    }
	



}
</script>
</head>
<body style='background-color:#99CCFF;'>
<div class='container' style='width:30%;background-color:white;'>
<form role='form' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validate(this)" class='form'>
<div class='form-group'>
<label class='control-label' for='name'>Name</label>
<input type='text' class='form-control lgn' id='name' name="name" value="<?php echo $_SESSION['firstname'].' '.$_SESSION['secondname']; ?>" required>
</div>
<div class='form-group'>
<label class='control-label' for='email'>E-mail</label>
<input type='email' id='email' class='form-control lgn' name="email" value="<?php echo $_SESSION['email']; ?>" required>
</div>
<div class='form-group'>
<label class='control-label' for='mob'>Mobile</label>
<input type='tel' id='mob' class='form-control lgn' name="mob" value="<?php echo $_SESSION['mob']; ?>" required>
</div>
<div class='form-group'>
<label class='control-label' for='address'>Address</label>
<textarea id='address' class='form-control lgn' name="address" required><?php echo $_SESSION['address']; ?></textarea>
</div>
<div class='form-group'>
<input type="submit" class='btn btn-primary' value="Save Changes" name="sc">
</div>
</form>
</div>
	
	
</body>
</html>