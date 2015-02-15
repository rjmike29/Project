<?php require"mainmenu.php";?>
<?php require"config.php";?>
<html>
<head>
<title>Items Ordered</title>
</head>
<body>
<div class='container'>
<?php
	if(isset($_SESSION["out_of_stock"])&&isset($_REQUEST["flag"]))
	{
		$json=$_SESSION["out_of_stock"];
		//echo $str;
		$out_of_stock=json_decode($json,true);
		//print_r($out_of_stock);
		$flag=$_REQUEST["flag"];
		echo"<div class='alert alert-danger'>";
		foreach($out_of_stock as $pr_id => $pq_qty)
		{
			$sql="select pr_name,stock from product_entry where pr_id='$pr_id'";
			$result=mysql_query($sql,$con) or die(mysql_error());
			if($result!=null)
			{
				$rec=mysql_fetch_row($result);
				$pr_name=$rec[0];
				$stock=$rec[1];
				echo "$pr_name with quantity: $pq_qty can not be ordered as only $stock is left in stock<br/>";
			}
		}
		echo"</div>";
		unset($_SESSION['out_of_stock']);
		if($flag==1)
		{
			echo"<div class='alert alert-success'>Rest of the items will be delivered within 5 days</div>";
		}
	}
	elseif(isset($_GET["all_success"]))
	{
		$success=$_GET["all_success"];
		if($success==true)
		{
			echo"<div class='alert alert-success'>All your items will be delivered within 5 days</div>";
		}
	}
	if(isset($_SESSION['net_sum']))
	{
		$tp=$_SESSION['net_sum'];
		echo"<h1>Total Amount: <strong>$tp</strong></h1><br/>";
		unset($_SESSION['total_price']);
	}
	echo"<a href='e2.firstpage.php'><button class='btn btn-success'>Keep Shopping</button></a>";

?>
</div>
</body>
</html>