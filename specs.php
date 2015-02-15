<?php session_start();?>
<?php require"config.php" ?>
<?php
	if(isset($_POST["buy"]))
	{
		
		//$_SESSION['pr_ordered']=$_SESSION['pr_id'];
		$_SESSION['pr_qty']=$_POST['qty'];
		echo"<script>window.top.location.href='order.php';</script>";
	}
?>
<html>
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
	background-color:green;
	color:white;
	width:136px;
	//height:40px;
}

</style>
<script>
function atc()
{
	var pid=document.getElementById("pid").value;
	var qty=document.getElementById("qty").value;
	var stock=document.getElementById("stock").value;
	if(qty > stock)
		alert("Only "+stock+" left in stock");
	else
		parent.window.location.href="cart.php?pid="+pid+"&qty="+qty;
}
function bn()
{
	var pid=document.getElementById("pid").value;
	var qty=document.getElementById("qty").value;
	var stock=document.getElementById("stock").value;
	if(qty > stock)
	{
		alert("Only "+stock+" left in stock");
		return false;
	}
}
</script>
</head>
<body>
<?php
	if(isset($_GET["pid"]))
	{
		$pr_id=$_GET["pid"];
		$sql="select pr_mod_no,pr_name,pr_price,specs_1,specs_2,specs_3,stock from product_entry where pr_id='$pr_id'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($result==null)
			echo"Oops! Something went wrong";
		else
		{
			$rec=mysql_fetch_row($result) or die(mysql_error());
			$pr_mod_no=$rec[0];
			$pr_name=$rec[1];
			$pr_price=$rec[2];
			$specs_1=$rec[3];
			$specs_2=$rec[4];
			$specs_3=$rec[5];
			$stock=$rec[6];
			echo"<h1>$pr_name $pr_mod_no</h1><hr/>";
			echo"<ul>";
			echo"<li>$specs_1</li><br/>";
			echo"<li>$specs_2</li><br/>";
			echo"<li>$specs_3</li>";
			echo"</ul>";
			echo"<div style='font-family:calistro mt;font-size:30px;'><b>Rs. $pr_price</b></div><br/>";
			echo"<b>WARRANTY</b> 1 year manufacturer warranty for Phone and 6 months warranty for in the box accessories<br/><br/>";
			
			
			$pg=$_SERVER['PHP_SELF'];
			if($stock==0)
			{
				echo"<input type='button' value='Out of Stock' style='background-color:grey;width:120px;height:40px;'>";
			}
			else
			{
				$_SESSION['pr_id']=$pr_id;
				echo"<form action='$pg' method='POST' onsubmit='return bn()'>";
				echo"<input type='number' value='1' min='1' max='5' title='Quantity' required name='qty' id='qty' style='width:30px;height:30px;background-color:white;color:black;'><br/>";
				echo"<input type='hidden' id='pid' value='$pr_id'>";
				echo"<input type='hidden' id='stock' value=$stock>";
				echo"<br/>";
				echo"<input type='submit' class='btn btn-success' value='BUY NOW' name='buy'>";
				echo"<br/></form>";
				echo"<a onclick='atc()'><button class='btn btn-warning' value='ADD TO CART' style='//background-color:orange;'>ADD TO CART <span class='glyphicon glyphicon-shopping-cart'></span></button></a>";
			}
		
		}	
	}
?>
</body>
</html>