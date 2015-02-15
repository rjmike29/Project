<?php
	$cat=$_REQUEST["cat"];
	$temp=$_REQUEST["q"];
	$temp2=implode($temp);
	$arr=explode(',',$temp2);
	$str="";
	for($i=0;$i<count($arr);$i++)
	{
		$str=$str."'".$arr[$i]."',";
	}
	$str=chop($str,",");
	$str=$str.")";
	$con=mysql_connect("localhost","root","");
	if(!$con)
		die(mysql_connect());
	mysql_select_db("product_details") or die(mysql_error());
	$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand,img_src,pr_id from product_entry where Pr_Cat=$cat and Pr_Brand in (".$str;
	$result=mysql_query($sql) or die(mysql_error());
	$sub_flag=1;
	echo "<table class='content'>";
	$col=0;
	while ($rec=mysql_fetch_row($result))
	{
			$sub_flag=0;
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
	if($sub_flag==1)
	{
		$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand,img_src,pr_id from product_entry where Pr_sub_Cat=$cat and Pr_Brand in (".$str;
		$result=mysql_query($sql) or die(mysql_error());
		$col=0;
		while ($rec=mysql_fetch_row($result))
		{
			$sub_flag=0;
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
	}
		
		
		
		
	echo "</table>";
	
	
?>