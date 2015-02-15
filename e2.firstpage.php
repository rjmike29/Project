<?php require"mainmenu.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Simple Multi-Item Slider with CSS Animations and jQuery</title>
		<meta name="description" content="Simple Multi-Item Slider: Category slider with CSS animations" />
		<meta name="keywords" content="jquery plugin, item slider, categories, apple slider, css animation" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<div class="container">
  <!--<div class="header"><a href="#"><img src="" alt="Insert Logo Here" name="Insert_logo" width="20%" height="90" id="Insert_logo" style="background-color: #8090AB; display:block;" /></a>--> 
    <!-- end .header </div>-->


 <div class="main" >
				<div id="mi-slider" class="mi-slider">
					<ul>
						<li><a href="items.php?pr_sub_cat=Boots"><img src="images/1.jpg" alt="img01"><h4>Boots</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Oxfords"><img src="images/2.jpg" alt="img02"><h4>Oxfords</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Loafers"><img src="images/3.jpg" alt="img03"><h4>Loafers</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Sneakers"><img src="images/4.jpg" alt="img04"><h4>Sneakers</h4></a></li>
					</ul>
					<ul>
						<li><a href="items.php?pr_sub_cat=Belts"><img src="images/5.jpg" alt="img05"><h4>Belts</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Hats"><img src="images/6.jpg" alt="img06"><h4>Hats &amp; Caps</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Sunglasses"><img src="images/7.jpg" alt="img07"><h4>Sunglasses</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Scarves"><img src="images/8.jpg" alt="img08"><h4>Scarves</h4></a></li>
					</ul>
					<ul>
						<li><a href="items.php?pr_sub_cat=Casual"><img src="images/9.jpg" alt="img09"><h4>Casual</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Luxury"><img src="images/10.jpg" alt="img10"><h4>Luxury</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Sport"><img src="images/11.jpg" alt="img11"><h4>Sport</h4></a></li>
					</ul>
					<ul>
						<li><a href="items.php?pr_sub_cat=Carry-Ons"><img src="images/12.jpg" alt="img12"><h4>Carry-Ons</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Duffel Bags"><img src="images/13.jpg" alt="img13"><h4>Duffel Bags</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Laptop Bags"><img src="images/14.jpg" alt="img14"><h4>Laptop Bags</h4></a></li>
						<li><a href="items.php?pr_sub_cat=Briefcases"><img src="images/15.jpg" alt="img15"><h4>Briefcases</h4></a></li>
					</ul>
					<nav>
						<a href="items.php?pr_cat=Shoes">Shoes</a>
						<a href="items.php?pr_cat=Accessories">Accessories</a>
						<a href="items.php?pr_cat=Watches">Watches</a>
						<a href="items.php?pr_cat=Bags">Bags</a>
					</nav>
				</div>
			</div>
		</div><!-- /container -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/jquery.catslider.js"></script>
		<script>
			$(function() {

				$( '#mi-slider' ).catslider();

			});
		</script>
</body>
</html>
