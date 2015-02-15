<?php require "mainmenu.php";?>
<?php require"config.php";?>
<html>
<head>
<style>
#main_container
{
	//margin-left:150px;
	border-style:none;
	//margin-top:2px;
	width:1200px;
	height:530px;
    display: flex;
    flex-flow: row wrap;
}
#img_container
{
	//margin-left:80px;
	border-style:none;
	margin-top:30px;
	width:420px;
	height:420px;
    display: flex;
    flex-flow: row nowrap;
    align-content: center;
	justify-content: center;
}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	 <script src="bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class='container'>
<?php
	if(isset($_GET["pid"]))
	{

		
		$pr_id=$_GET["pid"];
		$sql="select * from product_entry where pr_id='$pr_id'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($result==null)
		{
			echo"<script>alert('Oops! Something went wrong!');window.location.href='e.product.php';</script>";
		}
		else
		{
			$rec=mysql_fetch_row($result);
			$pr_id=$rec[0];
			$img_src=$rec[9];
			$pr_name=$rec[3];
			echo"<title>$pr_name</title>";
			if(isset($_GET["item_added"])&&isset($_GET["pid"]))
			{
				if($_GET["item_added"]=="true")
					echo"<div class='alert alert-success'><span class='glyphicon glyphicon-info-sign'></span> <strong>$pr_name</strong> has been added to cart</div>";
				elseif($_GET["item_added"]=="false")
					echo"<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> <strong>$pr_name</strong> has already been added to cart</div>";
			}
			echo"<div id='main_container'>";
			echo"<div id='img_container'>";
			echo"<image src='$img_src'>";
			echo"</div>";
			echo"<iframe src='specs.php?pid=$pr_id' seamless scrolling='no' style='border-style:none;margin-left:160px;width:500px;height:550px;overflow:hidden;'></iframe></div>";
			
		}
	}
?>
</div>
</body>
</html>