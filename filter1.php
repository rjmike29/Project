<?php
	$brand=$_REQUEST["brand"];
	if(isset($brand[0]))
	{
		$str="'".$brand[0]."'";
		$con=mysql_connect("localhost","root","");
		if(!$con)
			die(mysql_connect());
		mysql_select_db("product_details") or die(mysql_error());
		$sql="select Pr_Mod_No,Pr_name,Pr_price,Pr_Brand,pr_page,img_src from product_entry where Pr_Cat='Smart Phone' and Pr_Brand=".$str;
		$result=mysql_query($sql) or die(mysql_error());
		echo "<table class='content'>";
		$col=0;
		while ($rec=mysql_fetch_row($result))
		{
			$Pr_Model_No=$rec[0];
			$Pr_Name=$rec[1];
			$Pr_Price=$rec[2];
			$Pr_Brand=$rec[3];
			$pr_page=$rec[4];
			$Pr_img_src=$rec[5];
			if($col==0)
				echo"<tr>";
			echo"<td><div class='box'>";
			echo"<a href=$pr_page><img src=$Pr_img_src><br/>$Pr_Brand<br/>$Pr_Name<br/>$Pr_Model_No</a><br/><b>$Pr_Price</b>";
			echo"</div></td>";
			$col=$col+1;
			if($col==3)
			{
				echo"</tr>";
				$col=0;
			}
				
		}
		echo "</table>";
	}


?>