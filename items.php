<?php require"mainmenu.php";?>
<?php require"config.php";?>
<html>
<head>
<style>
.sidebar1 {
	float: left;
	width: 15%;
	background-color: black;
	height:1500px;
	font-size: x-large;
	color: white;
	font-family:Lucida Console;
}
#cart{
	float: right;
	width: 15%;
	background-color: black;
	padding-bottom: 10px;
	font-size: x-large;
	color: white;
	font-family:Lucida Console;
}
h1{
	font-family:Book Antiqua;
	//margin-left:17%;
}
</style>
   <script>
   function filter()
   {
	var pr=document.getElementsByTagName("title");
	var pr_cat=pr[0].innerHTML;
	var arr=[];
	document.getElementById("content").innerHTML="";
	var ch=document.getElementsByName("brand[]");
	var i=0;
	var flag=0;
	for(i=0;i<ch.length;i++)
	{
		if(ch[i].checked)
		{
			arr.push(ch[i].value);
			flag=1;
		}
		//if(!ch[0].checked && !ch[1].checked && !ch[2].checked && !ch[3].checked)
			//window.location.reload(true);
	}
	if(flag==0)
		window.location.reload(true);
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("content").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","filter.php?cat='"+pr_cat+"'&q[]="+arr,true);
	xmlhttp.send();
   
  }
</script>
</head>
<body>
<?php 
	if(isset($_GET["pr_cat"]))
	{
		$pr_cat=$_GET["pr_cat"];
		echo"<title>$pr_cat</title>";
		$sql="select distinct pr_brand from product_entry where pr_cat='$pr_cat'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($result==null)
			echo"Oops! Something went wrong";
		else
		{
			echo"<div class='sidebar1' style='//background-color:white;'><ul class='nav'>";
			while($rec=mysql_fetch_row($result))
			{
				echo"<li style='margin-top:30px;margin-left:20px;list-style-type:none;'><input type='checkbox' id='$rec[0]' name='brand[]' onclick='filter()' value='$rec[0]'> $rec[0]</li>";
			}
			echo"</ul>";
			echo"</div><h1 style='margin-left:17%;'>$pr_cat</h1>";
			echo"<div id='content'>";
			$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand,img_src,pr_id from product_entry where Pr_Cat='$pr_cat'";
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
				if($col==4)
				{
					echo"</tr>";
					$col=0;
				}
					
			}
			echo"</table>";
			echo"</div></div>";
			
		}	
	}
	elseif(isset($_GET["pr_sub_cat"]))
	{
		$pr_sub_cat=$_GET["pr_sub_cat"];
		echo"<title>$pr_sub_cat</title>";
		$sql="select distinct pr_brand from product_entry where pr_sub_cat='$pr_sub_cat'";
		$result=mysql_query($sql,$con) or die(mysql_error());
		if($result==null)
			echo"Oops! Something went wrong";
		else
		{
			echo"<div class='sidebar1' style='height:1000px;//background-color:white;'><ul class='nav'>";
			while($rec=mysql_fetch_row($result))
			{
				echo"<li style='margin-top:30px;margin-left:20px;list-style-type:none;'><input type='checkbox' id='$rec[0]' name='brand[]' onclick='filter()' value='$rec[0]'> $rec[0]</li>";
			}
			echo"</ul>";
			echo"</div><h1>$pr_sub_cat</h1>";
			echo"<div id='content'>";
			$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand,img_src,pr_id from product_entry where Pr_sub_cat='$pr_sub_cat'";
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
				if($col==4)
				{
					echo"</tr>";
					$col=0;
				}
					
			}
			echo"</table>";
			echo"</div></div>";
			
		}						
				
				
	}
?>
</body>
</html>