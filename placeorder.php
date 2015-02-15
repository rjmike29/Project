<?php require 'mainmenu.php'; ?>
<html>
<head>
<title>Order Confirmed</title>
</head>
<body>
<?php
if(isset($_SESSION['pr_qty']))
{
	$con=mysql_connect("localhost","root","");
	if(!$con)
		die(mysql_error());
	mysql_select_db("product_details",$con) or die(mysql_error());
	$pr_id=$_SESSION['pr_id'];
	$pr_qty=$_SESSION['pr_qty'];
	$total_price=$_SESSION['total_price'];
	$sql="select stock from product_entry where pr_id='$pr_id'";
	$result=mysql_query($sql,$con) or die(mysql_error());
	$rec=mysql_fetch_row($result);
	$stock=$rec[0];
if($pr_qty<=$stock)
{
	$stock=$stock-$pr_qty;
	$sql="update product_entry SET stock='$stock' where pr_id='$pr_id'";
	mysql_query($sql,$con) or die(mysql_error());
	$firstname=$_SESSION['firstname'];
	$secondname=$_SESSION['secondname'];
	$mob=$_SESSION['mob'];
	$email=$_SESSION['email'];
	$address=$_SESSION['address'];
	$order_dt=date_create(date('Y-m-d H:i:s'));
	$order_dt=date_format($order_dt,"Y-m-d");
	$sql="insert into cust_order (`cust_id`,`Cst_fnm`,`Cst_snm`,`Cst_adrs`,`cust_mob`,`Cst_email`,`pr_id`,`pro_qnty`,`total_price`,`order_dt`) values('$pr_id','$firstname','$secondname','$address','$mob','$email','$pr_id','$pr_qty','$total_price','$order_dt')";
	$result=mysql_query($sql,$con) or die(mysql_error());
	//$dd=date_add(date("d-m-Y"),date_interval_create_from_date_string("5 days"));
	if($result)
	{
		echo"<h1>Your Order will be delivered within 5 days</h1>";
		echo"<input type='button' onclick='<script>window.history.go(-3);</script>'value='Buy More products' style='background-color:green;color:white;width:120px;height:40px;'>";
	}
	else
	{
		echo"<h1>Oops! Something went wrong</h1>";
		echo"<input type='submit' onclick='<script>window.history.back();</script>' value='Buy More products' style='background-color:green;color:white;width:120px;height:40px;'>";
	}
}
else
{
	echo"<h1>Sorry only $stock left in stock</h1>";
}

unset($_SESSION['pr_qty'],$_SESSION['pr_id'],$_SESSION['total_price']);
}
?>


</body>
</html>