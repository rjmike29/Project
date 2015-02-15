<?php session_start();?>
<?php
if(isset($_SESSION['pr_qty']) && isset($_SESSION['pr_id']))
{	
	if(isset($_POST["pc"]))
	{
		$str=$_POST['name'];
		$nm=explode(" ",$str);
		$firstname="";
		$secondname="";
		for($i=0;$i<count($nm);$i++)
		{
			if($i==0)
				$firstname=$nm[$i];
			else
			$secondname=$secondname." ".$nm[$i];
		}
		$mob=$_POST['mob'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$con=mysql_connect("localhost","root","");
		if(!$con)
			die(mysql_error());
		mysql_select_db("product_details",$con) or die(mysql_error());
		$pr_id=$_SESSION['pr_id'];
		$pr_qty=$_SESSION['pr_qty'];
		$total_price=$_SESSION['total_price'];
		$sql="select stock from product_entry where pr_id='$pr_id'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$rec=mysql_fetch_row($result);
		$stock=$rec[0];
		if($pr_qty<=$stock)
		{
			$stock=$stock-$pr_qty;
			$sql="update product_entry SET stock='$stock' where pr_id='$pr_id'";
			mysql_query($sql,$con) or die(mysql_error());
			$order_dt=date_create(date('Y-m-d H:i:s'));
			$order_dt=date_format($order_dt,"Y-m-d");
			$sql="insert into cust_order (`Cst_fnm`,`Cst_snm`,`Cst_adrs`,`cust_mob`,`Cst_email`,`pr_id`,`pro_qnty`,`total_price`,`order_dt`) values('$firstname','$secondname','$address','$mob','$email','$pr_id','$pr_qty','$total_price','$order_dt')";
			$result=mysql_query($sql,$con) or die(mysql_error());
			if($result)
			{
				//echo"<script>window.location.href='e.product.php';</script>";
				$img=$_SESSION['img_src'];
				$pnm=$_SESSION['pr_name'];
				
				unset($_SESSION['pr_qty'],$_SESSION['pr_id'],$_SESSION['total_price'],$_SESSION['pr_name'],$_SESSION['img_src']);
				echo"<script>window.open('http://localhost/project/trans_success.php?img=$img&pnm=$pnm&qty='+$pr_qty+'&tp='+$total_price);</script>";
				//echo"<input type='button' onclick='<script>window.history.go(-3);</script>'value='Buy More products' style='background-color:green;color:white;width:120px;height:40px;'>";
			}
			else
			{
				echo"<script>alert('Oops!Something went wrong');</script>";
				//echo"<h1>Oops! Something went wrong</h1>";
				//echo"<input type='submit' onclick='<script>window.history.back();</script>' value='Buy More products' style='background-color:green;color:white;width:120px;height:40px;'>";
				echo"<script>window.location.href='order.php';</script>";
			}	
		}
		else
		{
			echo"<script>alert('Only $stock left in stock');</script>";
			//echo"<h1>Sorry only $stock left in stock</h1>";
			echo"<script>window.location.href='order.php';</script>";
		}
	}
		
		
		
		//echo"<script>window.location.href='placeorder.php';</script>";
}

?>