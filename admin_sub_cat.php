<?php require"config.php"?>
<?php
	
	
	if(isset($_GET["pr_cat"]))
	{
		$pr_cat=$_GET["pr_cat"];
		$sql="select distinct pr_sub_cat from product_entry where pr_cat='$pr_cat'";
		$result=mysql_query($sql,$con) or die(mysql_error());		
		while($rec=mysql_fetch_row($result))
			echo"<option value='$rec[0]'>$rec[0]</option>";
	}


?>