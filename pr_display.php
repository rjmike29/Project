<?php
$con=mysql_connect("localhost","root","");
		if (!$con)
		 { die(mysql_error());  
		} 
	mysql_select_db("product_details") or (mysql_error());
	$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand from product_entry where Pr_Cat='Smart Phone'";
	$result=mysql_query($sql)or die(mysql_error());
	?>
	<table>
	<tr>
	<th>Model No</th><th>Product</th><th>Price</th><th>Brand No</th>
	</tr>
	<?php
	while ($rec=mysql_fetch_row($result))
	{
	 $Pr_Model_No=$rec[0];
	 $Pr_Name=$rec[1];
	 $Pr_Price=$rec[2];
	 $Pr_Brand=$rec[3];
	echo"<tr>";
	echo"<th>$Pr_Model_No</th><th>$Pr_Name</th><th>$Pr_Price</th><th>$Pr_Brand</th>";
	echo"</tr>";
	}