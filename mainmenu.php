<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/box.css">
<script src="js/modernizr.custom.63321.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	 <script src="bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container1">
		<div id='cssmenu'>
<ul>
   <li><a href='e2.firstpage.php'><span class='glyphicon glyphicon-home'></span></a></li>
				
   <li class='active has-sub'><a><span>PHONES</span></a>
      <ul>
         <li class='has-sub'><a href="items.php?pr_cat=Smart Phones"><span>Smart Phones</span></a>
		 <li class='has-sub'><a href="items.php?pr_cat=iPhones"><span>iPhones</span></a>
		 <li class='has-sub'><a href="items.php?pr_cat=Tablets"><span>Tablets</span></a>
		</ul>	
      </li>		
	 
	    <li class='active has-sub'><a><span>Home Entertainment</span></a>
      <ul>
         <li class='has-sub'><a href="items.php?pr_cat=TVs"><span>LCD LED PLASMA TV</span></a>
		 <li class='has-sub'><a href="items.php?pr_cat=Gaming"><span>Gaming</span></a> 
		 		</ul>	
      </li>	
	   <li class='active has-sub'><a><span>More..</span></a>
      <ul>
         <li class='has-sub'><a href="items.php?pr_cat=Laptops"><span>Laptops</span></a>
		 <li class='has-sub'><a href="items.php?pr_cat=Storage"><span>Storage</span></a> 
		 <li class='has-sub'><a href="items.php?pr_cat=Accessories"><span>Accessories</span></a>
		</ul>	
      </li>	  
	 

   </li>
   <li class='last' style='float:right;'><a href='cart.php'><span>Cart
   <?php
		if(isset($_COOKIE["cart_items"]))
		{
			$json=$_COOKIE["cart_items"];
			$badges=json_decode($json,true);
			if($badges!=null)
			{
				$no=count($badges);
				echo"<span class='badge' style='background-color:white;color:black;'>$no</span>";
			}
		}
   ?>
   
   
   
   
   </span></a></li> 

  <?php
   if(isset($_SESSION['firstname']))
   {
		echo"<li style='float:right;' class='active has-sub'><a href=''><span>Hi ".$_SESSION['firstname']."</span></a>";
		echo"<ul>";
		echo"<li class='has-sub'><a href='account_details.php'><span>Account Details</span></a>";
		echo"<li class='has-sub'><a href='change_password.php'><span>Change Password</span></a>";		
		echo"<li class='has-sub'><a href='signout.php'><span>Sign Out</span></a>";
		echo"</ul>";
	}
	else
	{
		echo"<li style='float:right;'><a href='login.php'><span>Login</span></a></li>";  
	}
   
   ?>  
</ul>
	
	</div>

	</div>
</div>
</body>
</html>