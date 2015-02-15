<?php require"mainmenu.php";?>
<?php require"config.php";?>
<html>
<head>

<title>Checkout</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<?php
	if(isset($_POST["co"]))
	{
		$str=$_POST['name'];
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
		$flag=0;
		$sum=0;
		$out_of_stock=array();
		if(isset($_COOKIE["cart_items"]))
		{
			$cookie=$_COOKIE["cart_items"];
			$items=json_decode($cookie,true);
			foreach($items as $pr_id => $pr_qty)
			{
				$sql="select stock from product_entry where pr_id='$pr_id'";
				$result=mysql_query($sql,$con) or die(mysql_error());
				$rec=mysql_fetch_row($result);
				$stock=$rec[0];
				if($pr_qty<=$stock)
				{
					$stock=$stock-$pr_qty;
					$sql="update product_entry SET stock='$stock' where pr_id='$pr_id'";
					mysql_query($sql,$con) or die(mysql_error());
					$order_dt=date_create(date('Y-m-d H:i:s'));
					$order_dt=date_format($order_dt,"Y-m-d");
					$sql="select pr_price from product_entry where pr_id='$pr_id'";
					$result=mysql_query($sql,$con) or die(mysql_error());
					$rec=mysql_fetch_row($result);
					$pr_price=$rec[0];
					$total_price=$pr_price*$pr_qty;
					$sum=$sum+$total_price;
					$sql="insert into cust_order (`Cst_fnm`,`Cst_snm`,`Cst_adrs`,`cust_mob`,`Cst_email`,`pr_id`,`pro_qnty`,`total_price`,`order_dt`) values('$firstname','$secondname','$address','$mob','$email','$pr_id','$pr_qty','$total_price','$order_dt')";
					$result=mysql_query($sql,$con) or die(mysql_error());
					$flag=1;
				}
				else
				{
					$out_of_stock[$pr_id]=$pr_qty;
				}
			}
			$_SESSION['net_sum']=$sum;
			setcookie("cart_items","value",time()-3600);			
			if($out_of_stock!=null)
			{
				$json=json_encode($out_of_stock);
				$_SESSION['out_of_stock']=$json;
				header("Location:items_ordered.php?flag=$flag");
			
			}
			else
				header("Location:items_ordered.php?all_success=true");
		}
	}
?>
</head>

<body>

<div class='container' id='container'>
<?php if(!isset($_COOKIE["cart_items"])) header("Location:e2.firstpage.php");?>
<form class='form' action='checkout.php' method='POST'>
<div class='container'>
<table class='table'>
<tr>
<th colspan="2">Delivery Details</th>
</tr>
<tr>
<div class='form-group'>
<label for='name'><td>Name<td></label>
<td>
<input type='text' id='name' class='form-control' placeholder='John Doe' name='name' required value='<?php if(isset($_SESSION['firstname'])){ $nm=$_SESSION['firstname']." ".$_SESSION['secondname'];echo $nm;}?>'>
</div>
</td>
</tr>
<tr>
<div class='form-group'>
<label for='number'><td>Mobile<td></label>
<td>
<input type='tel' size='10' maxlength='10' placeholder='10-digit number' name='mob' class='form-control' id='number' required value='<?php if(isset($_SESSION['mob'])) echo $_SESSION['mob'];?>'>
</td>
</div>
</tr>
<tr>
<div class='form-group'>
<label for='email'><td>E-mail<td></label>
<td>
<input type='email' placeholder='something@example.com' class='form-control' id='email' name='email' required value='<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>'>
</td>
</div>
</tr>
<tr>
<div class='form-group'>
<label for='address'><td>Address<td></label>
<td>
<textarea placeholder='Address' class='form-control' id='address' name="address" cols="33" rows="3" required>
<?php if(isset($_SESSION['address'])) echo $_SESSION['address'];?>
</textarea>
</td>
</div>
</tr>
<tr>
<td>
<h1>Total Amount: <strong><?php if(isset($_GET["sum"])) echo $_GET["sum"];?></strong></h1>
</td>
</tr>
<tr>
<td>
<button type='submit' class='btn btn-success' name='co'>
<span class='glyphicon glyphicon-ok'></span> Place Order
</button>
</td>
</tr>
</table>
</form>
</div>
</div>

</body>

</html>