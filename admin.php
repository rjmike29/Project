<?php session_start();?>
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
		echo"<script>alert('Stock Updated!');</script>";
		unset($_POST["update"]);
	}
?>


<html>
<head>
<link rel="stylesheet" href="admin_template.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	 <script src="bootstrap/dist/js/bootstrap.min.js"></script>
<style>
#sales
{
	border-bottom-style: solid;
	border-bottom-color: blue;
}
</style>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<script>
function update_sales_content()
{
	var xmlhttp= new XMLHttpRequest();
	var from=document.getElementById("date_from").value;
	var to=document.getElementById("date_to").value;
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("sales_data").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","sales_report.php?from="+from+"&to="+to,true);
	xmlhttp.send();
}
function update_validate(form)
{
	var pr_id=form["pr_id[]"];
	var stock=form["stock[]"];
	var i=0;
	var pat=/\D/;
	for(i=0;i<(pr_id.length);i++)
	{
		if((stock[i].value<0)||(stock[i].value.search(pat)!=-1))
		{
			alert("Product: "+pr_id[i].value+" has invalid stock");
			return false;
		}
	}
}

function pop_to()
{
	var xmlhttp= new XMLHttpRequest();
	var from=document.getElementById("date_from").value;
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("date_to").innerHTML=xmlhttp.responseText;
			update_sales_content();
		}
	}
	xmlhttp.open("GET","pop_to.php?from="+from,true);
	xmlhttp.send();
}
function admin_sub_cat()
{
	var xmlhttp= new XMLHttpRequest();
	var pr_cat=document.getElementById("pr_cat").value;
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("pr_sub_cat").innerHTML=xmlhttp.responseText;
			update_sales_content();
		}
	}
	xmlhttp.open("GET","admin_sub_cat.php?pr_cat="+pr_cat,true);
	xmlhttp.send();
}

function menu_clicked(selected_td)
{
	table=document.getElementsByClassName("mainmenu_options");
	var i;
	for(i=0;i<table.length;i++)
		table[i].style.borderStyle="hidden";
	selected_td.style.borderBottom="solid blue";
}

$(document).unload(function(){
	$("#os_content").hide();
	$("#rs_content").hide();
	$("#sales_content").hide();
	$("#np_content").hide();
});
$(document).ready(function(){
	$("#os_content").hide();
	$("#rs_content").hide();
	$("#np_content").hide();
});
 
$(document).ready(function(){
  $("#sales").click(function(){
    $("#sales_content").show();
	$("#os_content").hide();
	$("#rs_content").hide();
	$("#np_content").hide();
  });
});
$(document).ready(function(){
  $("#os").click(function(){
    $("#os_content").show();
	$("#rs_content").hide();
	 $("#sales_content").hide();
	 $("#np_content").hide();
	});
});
$(document).ready(function(){
  $("#rs").click(function(){
    $("#rs_content").show();
    $("#sales_content").hide();
    $("#os_content").hide();
	$("#np_content").hide();
  });
});
$(document).ready(function(){
  $("#np").click(function(){
    $("#rs_content").hide();
    $("#sales_content").hide();
    $("#os_content").hide();
	$("#np_content").show();
  });
});
function s_img_validator(s_img)
{
	var _URL = window.URL || window.webkitURL;
	var img,file;
	if(file=s_img.files[0])
	{
		img= new Image();
		img.onload=function()
		{

			if(file.type!="image/jpeg")
			{
				alert("Not a valid image type");
				s_img.value=s_img.defaultValue;
			}
			else if(img.height>210)
			{
				alert("Small image should have max height: 210");
				s_img.value=s_img.defaultValue;
			}
		}
		
	    img.onerror=function() 
		{
			alert( "Not a valid image type");
			s_img.value=s_img.defaultValue;
		}
		img.src = _URL.createObjectURL(file);
	}
}
function l_img_validator(l_img)
{
	var _URL = window.URL || window.webkitURL;
	var img,file;
	if(file=l_img.files[0])
	{
		img= new Image();
		img.onload=function()
		{
			if(file.type!="image/jpeg")
			{
				alert("Not a valid image type");
				l_img.value=l_img.defaultValue;
			}			
			else if(img.height<250 || img.height>400)
			{
				alert("Large image should have min height:300 max height: 400");
				l_img.value=l_img.defaultValue;
			}
		}
	    img.onerror=function() 
		{
			alert("Not a valid image type");
			l_img.value=l_img.defaultValue;
		}
		img.src = _URL.createObjectURL(file);
	}
}
</script>
</head>
<body>
<div class="container" style='min-height:100%;background-color: #efefef;'>
  <!--<div class="center_div">-->
 <table class="mainmenu">
 <tr>
<th class='mainmenu_options' onclick="menu_clicked(this)" id="sales"><button>Sales</button></th>
<th class='mainmenu_options' onclick="menu_clicked(this)" id="os"><button>Out of Stocks</button></th>
<th class='mainmenu_options' onclick="menu_clicked(this)" id="rs"><button>Refill Stocks</button></th>
<th class='mainmenu_options' onclick="menu_clicked(this)" id="np"><button>New products</button></th>
<th class='mainmenu_options' onclick="menu_clicked(this)" id="so"><button><a href='admin_sign_out.php'>Sign Out</a></button></th>
</tr>
</table>
<div class="admin_content" id="sales_content">
	<br/>
	<select id="date_from" onchange='pop_to();' style="position:relative;left:630px;">
	<option>From</option>
	<?php 
		$sql="select distinct order_dt from cust_order order by order_dt";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($result)
		{
			while($rec=mysql_fetch_row($result))
			{
				echo"<option value='$rec[0]'>$rec[0]</option>";
			}
			
		}
	?>
	</select>
	<select id="date_to" onchange='update_sales_content()' style="position:relative;left:700px;">
	</select>
	<br/>
	<div id="sales_data">
	</div>
	<br/><br/>
</div>


<div class="admin_content" id="os_content">
	<br/><br/><br/>
	<?php 
		$sql="select * from product_entry where stock=0 order by pr_id";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$alt=0;
		echo"<table class='content_table'>";
		echo"<tr><th>Product Id</th><th>Model No.</th><th>Name</th><th>Category</th><th>Sub Category</th><th>Price</th><th>Brand</th></tr>";
		if($result)
		{
			while($rec=mysql_fetch_row($result))
			{
				if($alt==0)
				{	
					echo"<tr>";
					echo"<td>$rec[0]</td><td>$rec[2]</td><td>$rec[3]</td><td style='width:1%;'>$rec[4]</td><td>$rec[5]</td><td>$rec[6]</td><td>$rec[7]</td>";
					echo"</tr>";
					$alt=1;
				}
				else
				{
					echo"<tr class='alt'>";
					echo"<td>$rec[0]</td><td>$rec[2]</td><td>$rec[3]</td><td style='width:1%;'>$rec[4]</td><td>$rec[5]</td><td>$rec[6]</td><td>$rec[7]</td>";
					echo"</tr>";
					$alt=0;
				}
			}
		}
		echo"</table>";
	?>
	<br/>
</div>


<div class="admin_content" id="rs_content">
	<br/>
	

	<?php
		$sql="select * from product_entry order by pr_id";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$alt=0;

		$i=0;
		if($result)
		{
			echo"<form action='admin.php' onsubmit='return update_validate(this)' method='POST'>";
			echo"<tr><td><input type='submit' name='update' value='Update' class='submit'/><td/><tr/>";
			echo"<table class='content_table'>";
			echo"<tr><th>Product Id</th><th>Stock</th><th>Model No.</th><th>Name</th><th>Category</th><th>Sub Category</th><th>Price</th><th>Brand</th></tr>";
			while($rec=mysql_fetch_row($result))
			{
				if($alt==0)
				{	
					echo"<tr>";
					echo"<td><input type='text' style='border-style:none;background-color:inherit;' readonly name='pr_id[]' required value='$rec[0]'/></td><td><input type='text' style='border-style:none;background-color:inherit;width:40px;' required name='stock[]' value='$rec[1]'/></td><td>$rec[2]</td><td>$rec[3]</td><td style='width:1%;'>$rec[4]</td><td>$rec[5]</td><td>$rec[6]</td><td>$rec[7]</td>";
					echo"</tr>";
					$alt=1;
				}
				else
				{
					echo"<tr class='alt'>";
					echo"<td><input type='text' style='border-style:none;background-color:inherit;' readonly name='pr_id[]' required value='$rec[0]'/></td><td><input type='text' required name='stock[]' style='border-style:none;background-color:inherit;width:40px;' value='$rec[1]'/></td><td>$rec[2]</td><td>$rec[3]</td><td style='width:1%;'>$rec[4]</td><td>$rec[5]</td><td>$rec[6]</td><td>$rec[7]</td>";
					echo"</tr>";
					$alt=0;
				}
				$i++;
			}
			echo"</table>";
			echo"</form>";
		}

	?>
	<br/><br/>
	
	
	</div>
	<div class="admin_content" id="np_content">
	<?php
		$sql="select distinct pr_cat from product_entry";
		$result=mysql_query($sql,$con) or die(mysql_error());
		$sql="select distinct pr_sub_cat from product_entry";
		$result2=mysql_query($sql,$con) or die(mysql_error());		
	?>
		<form action="new_product.php" method="POST" enctype="multipart/form-data" class='form' style='margin-left:22%;margin-top:3%;'>
		<!--<table style="//margin-left:60px;//border-spacing:30px;">-->
		<div class='row'>
		<div class='form-group col-lg-3'>
		
		<label for='prmn'>Product Model</label>
		<input type="text" id='prmn' class='form-control' name="pr_mod_no" required>
		</div>
		<div class='form-group col-lg-3'>
		<label for='br'>Brand</label>
		<input type="text" class='form-control' id='br' name="pr_brand" required></td>
		</div>
		<div class='form-group col-lg-3'>
		<label for='pnm'>Product Name</label>
		<input type="text" class='form-control' id='pnm' name="pr_name" required>
		</div>
		</div>
		
		<div class='row'>
		<div class='form-group col-lg-3'>		
		<label for='sp1'>Specifications 1</label>
		<input type="text" id='sp1' class='form-control' name="specs_1" required>
		</div>
		<div class='form-group col-lg-3'>
		<label for='sp2'>Specifications 2</label>
		<input type="text" id='sp2' name="specs_2" class='form-control' required>
		</div>		
		<div class='form-group col-lg-3'>
		<label for='sp3'>Specifications 3</label>
		<input type="text" id='sp3' class='form-control' name="specs_3" required>
		</div>
		</div>
		
		<div class='row'>
		<div class='form-group col-lg-3'>
		<label for='pr_cat'>Category</label>
		<select id="pr_cat" class='form-control' name="pr_cat" onchange='admin_sub_cat()' required><?php while($rec=mysql_fetch_row($result)) echo"<option value='$rec[0]'>$rec[0]</option>";?></select>
		</div>
		<div class='form-group col-lg-3'>
		<label for='pr_sub_cat'>Sub-Category</label>
		<select id="pr_sub_cat" class='form-control' name="pr_sub_cat" required>
		<option value='NA'>NA</option>
		<!--?php while($rec=mysql_fetch_row($result2)) echo"<option value='$rec[0]'>$rec[0]</option>";?>-->
		</select>		
		</div>
		<div class='form-group col-lg-3'>
		<label for='prc'>Price (in Rs.)</label>
		<input type="number" min="100" name="pr_price" id='prc' class='form-control' required>
		</div>

		</div>
		
		<div class='row'>
		<div class='form-group col-lg-3'>
		<label for='sto'>Stock</label>
		<input type="number" id='sto' class='form-control' name="stock" min="1" max="500" required>
		</div>	
		<div class='form-group col-lg-3'>
		<label for='img_1'>Small Image (Max Height: 210)</label>
		<input type="file" name="s_img" onchange="s_img_validator(this)" id="img_1" required>
		</div>
		<div class='form-group col-lg-3'>
		<label for='img_2'>Large Image (Max Height: 400)</label>
		<input type="file" name="l_img" onchange="l_img_validator(this)" id="img_2" required>
		</div>
		</div>
		<div class='row'>
		<div class='form-group col-lg-2'>
		<input type="submit" class="submit" name="add" value="Add Product"></td>
		</div>
		</div>
		<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
		</form>
	
	
	
	
	
	
	
	
	</div>





	<!--</div>-->
</div>
</body>
</html>