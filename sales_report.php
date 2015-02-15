<?php require "config.php";?>
<?php
	$from=$_GET['from'];
	$to=$_GET['to'];
	echo"<table class='content_table'>";
	echo"<tr><th>Order Id</th><th>Customer Name</th><th>Customer Address</th><th>Customer Mob</th><th>Customer e-mail</th><th>Product Id</th><th>Product Qty</th><th>Total Price</th><th>Order Date</th></tr>";
	$sql="select * from cust_order where order_dt between '$from' and '$to' order by order_dt";
	$result=mysql_query($sql,$con) or die(mysql_error());
	$tp=0;
	$alt=0;
	if($result)
	{
		while($rec=mysql_fetch_row($result))
		{
			if($alt==0)
			{	
				$tp=$tp+$rec[8];
				echo"<tr>";
				echo"<td>$rec[0]</td><td>$rec[1] $rec[2]</td><td>$rec[3]</td><td style='width:1%;'>$rec[4]</td><td>$rec[5]</td><td>$rec[6]</td><td>$rec[7]</td><td style='padding:43px;'>$rec[8]</td><td>$rec[9]</td>";
				echo"</tr>";
				$alt=1;
			}
			else
			{
				$tp=$tp+$rec[8];
				echo"<tr class='alt'>";
				echo"<td>$rec[0]</td><td>$rec[1] $rec[2]</td><td>$rec[3]</td><td style='width:1%;'>$rec[4]</td><td>$rec[5]</td><td>$rec[6]</td><td>$rec[7]</td><td style='padding:43px;'>$rec[8]</td><td>$rec[9]</td>";

				echo"</tr>";
				$alt=0;
			}
		}
		echo"<b>Total Sales:$tp</b>";
	}
?>