<?php require"mainmenu.php";?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/modernizr.custom.63321.js"></script>
<script>
function validate(form)
{
	var mob=form["mob"].value;
	var username=form["username"].value;
	var pass=form["pwd"].value;
	var cpass=form["cpwd"].value;
	var pat= /\D/;
	var mob_result=mob.search(pat);
	var pass_result=pass.match(cpass);
	if(!pass_result)
	{	
		alert("Passwords don't match");
		return false;
	}
	if(mob_result!=-1 || mob.length!=10)
	{
        alert("Not a valid Mobile Number");
        return false;	
	
	}
}
function username_validate(username_obj)
{
	var username=username_obj.value;
	var udiv=document.getElementById("username_div");
	var warning=document.getElementById("warning");
	var glyph=document.getElementById("glyph");
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var response=xmlhttp.responseText;
			if(response.match("true"))
			{
				udiv.className="form-group has-error has-feedback";
				glyph.className="glyphicon glyphicon-exclamation-sign form-control-feedback";
				warning.style.display="inherit";
				username_obj.value="";
				warning.innerHTML="Username '"+username+"' already exists";
			}
			else if(response.match("false"))
			{
				udiv.className="form-group has-success has-feedback";
				glyph.className="glyphicon glyphicon-ok form-control-feedback";
				warning.style.display="none";
				warning.innerHTML="";
			}
		}
	}
	xmlhttp.open("GET","username_validate.php?username="+username,true);
	xmlhttp.send();
}
</script>
</head>
<body style='background-color:#99CCFF'>
<div class='container' style='width:35%;background-color:white;'>
<form role='form' action="confirm_email.php" method="POST" onsubmit='return validate(this)' class='form'>

<div class='form-group'>
<label class='control-label' for='fn'>First Name</label>
<input type="text" name="fname" class='form-control lgn' id='fn' placeholder="John" required>
</div>
<div class='form-group'>
<label class='control-label' for='sn'>Last Name</label>
<input type="text" name="sname" id='sn' class='form-control' placeholder="Doe" required>
</div>
<div class='form-group'>
<label class='control-label' for='em'>E-mail</label>
<input type="email" id='em' class='form-control' name="email" placeholder="something@example.com" required>
</div>
<div id='username_div' class='form-group has-feedback'>
<label for='un'>Username</label>
<input type="text" class='form-control' onchange='username_validate(this)' name="username" id='un' placeholder="For login purpose" required>
<span id='glyph'></span>
<div class='alert alert-danger' style='display:none;' id='warning'></div>
</div>
<div class='form-group'>
<label for='mob'>Mobile</label>
<input type="tel" maxlength='10' class='form-control' id='mob' name="mob" placeholder="10-digit number" required>
</div>
<div class='form-group'>
<label for='addr'>Address</label>
<textarea class='form-control' id='addr' placeholder='Address' name="address" required>
</textarea>
</div>
<div class='form-group'>
<label for='pass'>Password</label>
<input type="password" class='form-control' id='pass' name="pwd" placeholder="Password" required>
</div>
<div class='form-group'>
<label class='control-label' for='cp'>Confirm Password</label>
<input type="password" class='form-control' id='cp' name="cpwd" placeholder="Confirm Password" required>
</div>
<div class='form-group'>
<input type="submit" class='btn btn-primary' name="su" value="Sign Up" style="//margin-top:15px;//margin-left:48%;//width:130px;//height:40px;//background-color:blue;//color:white;">
</div>
</form>
</div>
</body>
</html>