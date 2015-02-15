<?php require"config.php";?>
<?php
	if(isset($_GET["username"]))
	{
		$username=$_GET["username"];
		$sql="select * from members where username='$username' limit 1";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$rec=mysql_fetch_row($result);
		if($rec!=null)
			echo"true";
		else
			echo"false";
	}




?>