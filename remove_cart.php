<?php require"config.php";?>
<?php
	if(isset($_GET["pid"]))
	{
		$pr_id=$_GET["pid"];
		$cookie=$_COOKIE["cart_items"];
		$previous_items=json_decode($cookie,true);
		unset($previous_items[$pr_id]);
		$json=json_encode($previous_items);
		setcookie("cart_items",$json);
		header("Location:cart.php?removed=true");
	}
?>