<?php require "config.php";?>
<?php 
	if(isset($_POST["update"]))
	{
		$count=count($_POST);
		$pr_id=$_POST['pr_id'];
		$stock=$_POST['stock'];
		foreach( $pr_id as $key => $pid)
		{
				$sql="update product_entry set stock='$stock[$key]' where pr_id='$pid'";
				$result=mysql_query($sql,$con) or die(mysql_error());
				if(!$result)
				{
					echo"<script>alert('Oops! Something went wrong');</script>";
				}
				
		}
		unset($_POST["update"]);
		echo"<script>alert('Stock Updated!');window.location.href='admin.php';</script>";
	}


?>