<?php require "config.php"; ?>
<?php 
	$from=$_GET['from'];
	$sql="select distinct order_dt from cust_order where order_dt>='$from' order by order_dt";
	$result=mysql_query($sql,$con) or die(mysql_error());	
	if($result)
	{
		while($rec=mysql_fetch_row($result))
		{
			echo"<option value='$rec[0]'>$rec[0]</option>";
		}
	}
?>