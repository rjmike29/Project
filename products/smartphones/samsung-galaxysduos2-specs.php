<?php session_start(); ?>
<?php
	if(isset($_POST["buy"]))
	{
		
		//$_SESSION['pr_ordered']=$_SESSION['pr_id'];
		$_SESSION['pr_qty']=$_POST['qty'];
		echo"<script>window.top.location.href='../../order.php';</script>";
	}
	
?>
<html>
<head>
<style>
input
{
	background-color:green;
	color:white;
	width:120px;
	height:40px;
}
input:hover
{
	opacity:0.9;
}
</style>
</head>
<body>
<h1>Samsung Galaxy S Duos 2 S7582</h1>
<hr/>
<ul>
<li>5 MP Primary Camera</li>
<li>Android v4.2 OS</li>
<li>Dual Sim (GSM + GSM)</li>
<li>0.3 MP Secondary Camera</li>
</ul>
WARRANTY
1 year manufacturer warranty for Phone and 6 months warranty for in the box accessories
<br/>
<br/>
<div style="font-family:calistro mt;font-size:30px;">
<b>Rs. 11,850</b>
<br/>
</div>
Selling Price
<br/>
<br/>
<?php 
		$pr_id='000045';
		$pg=$_SERVER['PHP_SELF'];
		$con2=mysql_connect("localhost","root","");
		if(!$con2)
			die(mysql_error());
		mysql_select_db("product_details",$con2) or die(mysql_error());
		$sql="select stock,pr_id from product_entry where pr_id='$pr_id'";
		$result=mysql_query($sql,$con2) or die(mysql_error());
		$rec=mysql_fetch_row($result);
		$stock=$rec[0];
		if($stock==0)
		{
			echo"<input type='button' value='Out of Stock' style='background-color:grey;width:120px;height:40px;'>";
		}
		else
		{
			$_SESSION['pr_id']=$rec[1];
			echo"<form action='$pg' method='POST'>";
			echo"<input type='text' value='1' title='Quantity' required name='qty' id='qty' style='width:25px;height:30px;background-color:white;color:black;'><br/>";
			echo"<br/>";
			echo"<input type='submit' value='BUY NOW' name='buy'>";
			echo"<br/></form>";
			echo"<input type='button' onclick='' value='ADD TO CART' style='background-color:orange;color:white;width:120px;height:40px;'>";
		}
		
		
		
		
?>


</body>
</html>