<?php require"config.php"; ?>
<?php
	if(isset($_POST["add"]))
	{
		$pr_mod_no=$_POST["pr_mod_no"];
		$pr_name=$_POST["pr_name"];
		$pr_brand=$_POST["pr_brand"];
		$pr_sub_cat=$_POST["pr_sub_cat"];
		$stock=$_POST["stock"];
		$specs_1=$_POST["specs_1"];
		$specs_2=$_POST["specs_2"];
		$specs_3=$_POST["specs_3"];
		$pr_cat=$_POST["pr_cat"];
		$pr_price=$_POST["pr_price"];
		if($pr_sub_cat=="NA")
			$target_dir= "images/".$_POST["pr_cat"]."/";
		else
			$target_dir= "images/".$_POST["pr_cat"]."/".$_POST["pr_sub_cat"]."/";

			
		$target_file=$target_dir.basename($_FILES["s_img"]["name"]);
		$target_file2=$target_dir.basename($_FILES["l_img"]["name"]);
		$uploadOk=1;
		$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
		$imageFileType2=pathinfo($target_file2,PATHINFO_EXTENSION);
		$check=getimagesize($_FILES["s_img"]["tmp_name"]);
		$check2=getimagesize($_FILES["l_img"]["tmp_name"]);
		if(($check===false)||($check2===false))
		{
			$uploadOk=0;
			echo"<script>alert('Either of the files is not an image file');window.location.href='admin.php';</script>";
			die();
		}
		if((file_exists($target_file))||(file_exists($target_file2))) 
		{
			$uploadOk=0;
			echo"<script>alert('Sorry, file already exists.');window.location.href='admin.php';</script>";
			die();
		}
		if(($_FILES["s_img"]["size"]>500000)||($_FILES["l_img"]["size"]>500000) ) 
		{
			$uploadOk=0;
			echo"<script>alert('Sorry, your file is too large.');window.location.href='admin.php';</script>";
			die();
		}
		if(($imageFileType!="jpg" && $imageFileType!="jpeg")||($imageFileType2!="jpg" && $imageFileType2!="jpeg"))
		{
			$uploadOk=0;
			echo"<script>alert('Sorry, only JPG, JPEG files are allowed.');window.location.href='admin.php';</script>";
			die();
		}
		/*if ($uploadOk==0) 
		{
			echo"<script>alert('Sorry, your file was not uploaded.');alert('Product was not added');window.location.href='admin.php';</script>";
		}*/ 
		else 
		{
			if((move_uploaded_file($_FILES["s_img"]["tmp_name"], $target_file))&&(move_uploaded_file($_FILES["l_img"]["tmp_name"], $target_file2))) 
			{
				//echo"<script>alert('Your file was uploaded.');window.location.href='admin.php';</script>";
					$sql="insert into product_entry(stock,pr_mod_no,pr_name,pr_cat,pr_sub_cat,pr_price,pr_brand,img_src,l_img_src,specs_1,specs_2,specs_3) values('$stock','$pr_mod_no','$pr_name','$pr_cat','$pr_sub_cat','$pr_price','$pr_brand','$target_file','$target_file2','$specs_1','$specs_2','$specs_3')";
					$result=mysql_query($sql,$con) or die(mysql_error());
					if($result)
						echo"<script>alert('Product has been added!');window.location.href='admin.php';</script>";
					else
						echo"<script>alert('Oops! Something went wrong!');window.location.href='admin.php';</script>";
				
			} 
			else 
			{
				echo"<script>alert('Oops! Something went wrong!');alert('Product was not added');window.location.href='admin.php';</script>";

			}
		}
	
	}	






?>