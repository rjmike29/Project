<?php require"mainmenu.php";?>
<?php require"config.php";?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cart</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	 <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class='container'>
  <?php 
	if(isset($_GET["pid"])&&isset($_GET["qty"]))
	{
		$pr_id=$_GET["pid"];
		$qty=$_GET["qty"];
		if(isset($_COOKIE["cart_items"]))
		{
			$cookie=$_COOKIE["cart_items"];
			//$cookie=stripshlashes($cookie);
			$previous_items=json_decode($cookie,true);
			
			if($previous_items!==null)
			{
				foreach($previous_items as $key => $value)
					$cart_items[$key]=$value;
			}
			if(isset($cart_items[$pr_id]))
				header("Location:product_page.php?pid=$pr_id&item_added=false");
			else
			{
				$cart_items[$pr_id]=$qty;
				$json=json_encode($cart_items);
				setcookie("cart_items",$json);
				header("Location:product_page.php?pid=$pr_id&item_added=true");
			}
		}
		else
		{
			$cart_items[$pr_id]=$qty;
			$json=json_encode($cart_items);
			setcookie("cart_items",$json);
			header("Location:product_page.php?pid=$pr_id&item_added=true");
		}
	}
	if(isset($_COOKIE["cart_items"]))
	{
		//$cart_items[$pr_id]=$qty;
		if(isset($_GET["removed"]))
			echo"<div class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> Item has been removed from cart</div>";

		$cookie=$_COOKIE["cart_items"];
		//$cookie=stripshlashes($cookie);
		$previous_items=json_decode($cookie,true);
		$cart_items=array();
		if($previous_items==null)
			echo"<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> There are no items in the cart</div>";
		elseif($previous_items!==null)
		{
			foreach($previous_items as $key => $value)
				$cart_items[$key]=$value;
		
			$pids="";
			foreach($cart_items as $key => $value)
			{
				$pids=$pids."'".$key."',";
			}
			$pids=trim($pids,",");
			$sql="select pr_name,pr_brand,pr_price,img_src,pr_id from product_entry where pr_id in($pids)";
			$result=mysql_query($sql,$con) or die(mysql_error());
			$sum=0;
			echo"<table class='table table-hover'>";
			echo"<tr><th colspan='2'>Product Name</th><th>Price</th><th>Quantity</th><th>Net Price</th><th></th></tr>";
			while($rec=mysql_fetch_row($result))
			{
				$pr_name=$rec[0];
				$pr_brand=$rec[1];
				$pr_price=$rec[2];
				$img_src=$rec[3];
				$pr_id=$rec[4];
				$pr_total=$pr_price*$cart_items[$pr_id];
				$sum=$sum+$pr_total;
				echo"<tr>";
				echo"<td><img src='$img_src'></td><td>$pr_name</td><td>Rs. $pr_price</td><td>$cart_items[$pr_id]</td><td>Rs. $pr_total</td>";
				echo"<td><a href='remove_cart.php?pid=$pr_id'><button class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Remove</button></a></td>";
				echo"</tr>";
			}
			echo"<tr><td colspan='5'><h1>Total Amount: <strong>Rs. $sum</strong></h1></td><td><a href='checkout.php?sum=$sum'><button class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> Checkout</button></td></a></tr>";
			echo"</table>";
		}
	}
	else
		echo"<div class='alert alert-danger'>There are no items in the cart</div>";
		
	//setcookie("cart_items",time()-3600);
?>
  </div>
  </body>
</html>