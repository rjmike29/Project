<?php 
	session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <script>
   function filter()
   {
	var arr=[];
	document.getElementById("content").innerHTML="";
	var ch=document.getElementsByName("brand[]");
	if(ch[0].checked)
		arr.push(ch[0].value);
	if(ch[1].checked)
		arr.push(ch[1].value);
	if(ch[2].checked)
		arr.push(ch[2].value);
	if(ch[3].checked)
		arr.push(ch[3].value);
	if(!ch[0].checked && !ch[1].checked && !ch[2].checked && !ch[3].checked)
		window.location.reload(true);
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("content").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","filter.php?cat='smart phone'&q[]="+arr,true);
	xmlhttp.send();
   
  }
   </script>

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
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link rel="stylesheet" type="text/css" href="css/box.css">
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color:#414958;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this container surrounds all other divs giving them their percentage-based width ~~ */
.container {
	width: 80%;
	max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 780px;/* a min-width may be desirable to keep this layout from getting too narrow. This keeps line length more readable in the side columns. IE6 does not respect this declaration. */
	background-color: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background-color: #6F7D94;
}

/* ~~ These are the columns for the layout. ~~ 

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the right instead of the left, simply float these columns the opposite direction (all right instead of all left) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
	float: left;
	width: 20%;
	background-color: #93A5C4;
	padding-bottom: 10px;
}
.content {
	padding: 10px 0;
	width: 80%;
	float: left;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
	list-style: none; /* this removes the list marker */
	border-top: 1px solid #666; /* this creates the top border for the links - all others are placed using a bottom border on the LI */
	margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
	border-bottom: 1px solid #666; /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
	padding: 5px 5px 5px 15px;
	display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
	text-decoration: none;
	background-color: #8090AB;
	color: #000;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
	background-color: #6F7D94;
	color: #FFF;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background-color: #6F7D94;
	position: relative;/* this gives IE6 hasLayout to properly clear */
	clear: both; /* this clear property forces the .container to understand where the columns end and contain them */
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* this 1px negative margin can be placed on any of the columns in this layout with the same corrective effect. */
ul.nav a { zoom: 1; }  /* the zoom property gives IE the hasLayout trigger it needs to correct extra whiltespace between the links */
</style>
<![endif]--></head>

<body style="background-color:white;">

<div class="container">
  <!--<div class="header"><a href="#"><img src="" alt="Insert Logo Here" name="Insert_logo" width="20%" height="90" id="Insert_logo" style="background-color: #8090AB; display:block;" /></a>-->
    <!-- end .header </div>-->
		<div id='cssmenu'>
<ul>
   <li><a href='e2.firstpage.php'><span>Home</span></a></li>
				
   <li class='active has-sub'><a href='#'><span>PHONES</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Smart Phones</span></a>
		 <li class='has-sub'><a href='#'><span>Feture phones</span></a>
		 <li class='has-sub'><a href='#'><span>iPhones</span></a>
		 <li class='has-sub'><a href='#'><span>ipad</span></a>
		</ul>	
      </li>		
	   <li class='active has-sub'><a href='#'><span>Computer</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Laptop</span></a>
		 <li class='has-sub'><a href='#'><span>Macbook</span></a>
		 <li class='has-sub'><a href='#'><span>iMac</span></a>
		 <li class='has-sub'><a href='#'><span>All In one computer</span></a> 
		 <li class='has-sub'><a href='#'><span>Storage</span></a> 
		 <li class='has-sub'><a href='#'><span>Asseccories</span></a>
		 <li class='has-sub'><a href='#'><span>Softwere</span></a>
		</ul>	
      </li>		 
	    <li class='active has-sub'><a href='#'><span>Home Entertainment</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>LCD LED PLASMA TV</span></a>
		 <li class='has-sub'><a href='#'><span>DVD AND Blue Ray Players</span></a>
		 <li class='has-sub'><a href='#'><span>Audio System</span></a>
		 <li class='has-sub'><a href='#'><span>Gaming</span></a> 
		 		</ul>	
      </li>		 
	    <li class='active has-sub'><a href='#'><span>Home Appliances</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Refrigerators</span></a>
		 <li class='has-sub'><a href='#'><span>Washing Machine</span></a>
		 <li class='has-sub'><a href='#'><span>Split Ac</span></a>
		 <li class='has-sub'><a href='#'><span>Window Ac</span></a> 
		 <li class='has-sub'><a href='#'><span>Vacuum Cleaner</span></a> 
		 <li class='has-sub'><a href='#'><span>Fans</span></a>
		 <li class='has-sub'><a href='#'><span>Water Heater</span></a>
		</ul>	
      </li>		 
	    <li class='active has-sub'><a href='#'><span>Computer</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Laptop</span></a>
		 <li class='has-sub'><a href='#'><span>Macbook</span></a>
		 <li class='has-sub'><a href='#'><span>iMac</span></a>
		 <li class='has-sub'><a href='#'><span>All In one computer</span></a> 
		 <li class='has-sub'><a href='#'><span>Storage</span></a> 
		 <li class='has-sub'><a href='#'><span>Asseccories</span></a>
		 <li class='has-sub'><a href='#'><span>Softwere</span></a>
		</ul>	
      </li>		
	<!--	 <ul>
    <!..           <li> <a href='#'><span>Sub Product</span></a></li> 
               <!..<li class='last'><a href='#'><span>Sub Product</span></a></li>
    <!..        </ul>
    <!..     </li>
    <!..     <li class='has-sub'><a href='#'><span>Product 2</span></a>
    <!..        <ul>
    <!..           <li><a href='#'><span>Sub Product</span></a></li>
    <!..           <li class='last'><a href='#'><span>Sub Product</span></a></li>
    <!..        </ul>
     <!..    </li> 
      </ul> -->
   </li>
 
  <?php
   if(isset($_SESSION['firstname']))
   {
		echo"<li class='active has-sub'><a href='#'><span>Hi ".$_SESSION['firstname']."</span></a>";
		echo"<ul>";
		echo"<li class='has-sub'><a href='account_details.php'><span>Account Details</span></a>";
		echo"<li class='has-sub'><a href='signout.php'><span>Sign Out</span></a>";
		echo"</ul>";
	}
	else
	{
		echo"<li><a href='login.php'><span>Login</span></a></li>";  
	}
   
   ?>
		<li class='last'><a href='#'><span>Cart</span></a></li> 

</ul>
</div>
  <div class="sidebar1" style="height:1000px;background-color:white;"> 
    <ul class="nav">

<!--<input type="checkbox" name="vehicle" value="Bike">I have a bike

<input type="checkbox" name="vehicle" value="Car">I have a car 
</form> -->
	  <li><input type="checkbox" id="sam" name="brand[]" onclick="filter()" value="samsung">Samsung</li>
	  <li><input type="checkbox" id="nok" name="brand[]" onclick="filter()"  value="nokia">Nokia</li>
      <li><input type="checkbox" id="mot" name="brand[]" onclick="filter()"  value="motorola">Motorola</li>
      <li><input type="checkbox" id="asus" name="brand[]" onclick="filter()"  value="asus">Asus</li>
    </ul>
    <!-- end .sidebar1 --></div>
	<h1>Smartphones</h1>
  <div id="content">
  <?php
		$con=mysql_connect("localhost","root","");
		if (!$con)
			die(mysql_error());  
		 
		mysql_select_db("product_details") or (mysql_error());
		$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand,img_src,pr_id from product_entry where Pr_Cat='Smart Phone'";
		$result=mysql_query($sql)or die(mysql_error());
		echo"<table class='content'>";
		$col=0;
		while ($rec=mysql_fetch_row($result))
		{
			$Pr_Model_No=$rec[0];
			$Pr_Name=$rec[1];
			$Pr_Price=$rec[2];
			$Pr_Brand=$rec[3];
			$Pr_img_src=$rec[4];
			$pr_id=$rec[5];
			if($col==0)
				echo"<tr>";
			echo"<td><div class='box'>";
			echo"<a href='product_page.php?pid=$pr_id'><img src='$Pr_img_src'><br/>$Pr_Brand<br/>$Pr_Name<br/>$Pr_Model_No</a><br/><b>$Pr_Price</b>";
			echo"</div></td>";
			$col=$col+1;
			if($col==3)
			{
				echo"</tr>";
				$col=0;
			}
					
		}
	
	?>
				
		
   </table>
	</div>

  </div>
</body>
</html>
