<?php require 'mainmenu.php'; ?>
<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<title>Confirm Order</title>
<style>
#pc
{
	background-color:green;
	color:white;
	width:120px;
	height:40px;
}
#pc:hover
{
	opacity:0.9;
}
</style>
<script>
function validate(form)
{
	var name=(form["name"].value).trim();
	var email=form["email"].value;
	var mob=form["mob"].value;
	var qty=form["qty"].value;
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
	result=qty.search(pat);
	if(result!=-1)
	{
		alert("Invalid quantity");
		return false;
	}
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) 
	{
        alert("Not a valid e-mail address");
        return false;
    }
}


function qtv()
{
	var qty=document.getElementById('qty');
	var newVal=qty.value;
	var oldVal=qty.defaultValue;
	var pat=/\D/;
	var result=newVal.search(pat);
	if(result!=-1 || newVal==0 || newVal=="")
		qty.value=oldVal;
	else
	{
		qty.defaultValue=newVal;
		window.location.href='order.php?ch_qty='+newVal;
		//window.location.reload(true);
		//$('#subtotal').html("<?php $tp=$_SESSION['total_price'];$op='Rs. '.$tp;echo $op;?>");
		
	}
		
		
}
</script>
</head>
<?php 
if(isset($_SESSION['pr_id']))	
{
	$con=mysql_connect("localhost","root","");
	if(!$con)
		die(mysql_error());
	mysql_select_db("product_details") or die(mysql_error());
	$pr_id=$_SESSION['pr_id'];
	if(isset($_GET['ch_qty']))
	{
		$_SESSION['pr_qty']=$_GET['ch_qty'];
		//echo"<script>alert('Qty changed');</script>";
		$_SESSION['total_price']=$_SESSION['pr_qty']*$_SESSION['pr_price'];
		unset($_GET['ch_qty']);
		//echo"<script>window.location.reload(true);</script>";
		
	}
	$sql="select pr_mod_no,pr_name,pr_price,img_src from product_entry where pr_id='$pr_id'";
	$result=mysql_query($sql,$con) or die(mysql_error());
	$rec=mysql_fetch_row($result);
	$_SESSION['img_src']=$rec[3];
	$_SESSION['pr_name']=$rec[1];
}
?>
<body>
<form action="placeorder2.php" onsubmit="return validate(this)" class='form' method="POST">
<table class='table' style="//border-style:solid;//border-spacing:60px 60px;//margin:10px;">
<tr>
<th colspan='2'>Item</th>
<th>Price</th>
<th>Quantity</th>
<th>Sub Total</th>
</tr>
<tr>
<td>
<?php echo "<img src='$rec[3]'>";?>
</td>
<td>
<?php echo $rec[1];?>
</td>
<td id="price">
<?php $_SESSION['pr_price']=$rec[2];echo "Rs. $rec[2]";?>
</td>
<td>
<?php $qty=$_SESSION['pr_qty'];echo"<input type='number' min='1' max='5' value='$qty' id='qty' name='qty' onchange='qtv()' style='width:30px;height:30px;background-color:white;color:black;'>";?>
</td>
<td id="subtotal">
<?php $_SESSION['total_price']=$_SESSION['pr_qty']*$rec[2];$tp=$_SESSION['total_price'];echo "Rs. $tp";?>
</td>
</tr>
</table>
<table class='table' style="//border-spacing:30px;">
<tr>
<th colspan='4'>Delivery details </th>
</tr>
<tr>
<td>
<div class='form-group'>
<input type='text' class='form-control' name='name' style="width:250px;height:50px;" placeholder='Full Name' required value='<?php if(isset($_SESSION['firstname'])){ $nm=$_SESSION['firstname']." ".$_SESSION['secondname'];echo $nm;}?>'>
</div>
</td>
<td>
<div class='form-group'>
<input type='tel' name='mob' class='form-control' style="width:250px;height:50px;" placeholder='Mobile' required value='<?php if(isset($_SESSION['mob'])) echo $_SESSION['mob'];?>'>
</div>
</td>
<td>
<div class='form-group'>
<input type='email' name='email' class='form-control' style="width:250px;height:50px;" placeholder='email' required value='<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>'>
</div>
</td>
<td>
<div class='form-group'>
<textarea placeholder='Address' class='form-control' name="address" cols="33" rows="3" required>
<?php if(isset($_SESSION['address'])) echo $_SESSION['address'];?>
</textarea>
</div>
</td>

</tr>
<tr>
<td>
<input type='submit' id='pc' value='Place Order' name='pc'>
</td>
</tr>
</table>
</form>
</body>
</html>