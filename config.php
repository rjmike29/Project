<?php 
	$con=mysql_connect("localhost","root","");
	if(!$con)
		die(mysql_error());
	mysql_select_db("product_details",$con) or die(mysql_error());
?>