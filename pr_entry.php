<?php
/*$P_id=$_POST[P_id];
$P_Mod_No=$_POST[P_Mod_No];
$P_Name=$_POST[P_Name];
$P_Cat=$_POST[P_Cat];
$P_Sub_Cat=$_POST[P_Sub_Cat];
$P_Price=$_POST[P_Price];
$P_Brand=$_POST[P_Brand]; */
/*define('MB', 1048576);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1*MB)
&& in_array($extension, $allowedExts))
{
if ($_FILES["file"]["error"] > 0)
{
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("C:\xampp\htdocs\php2306\Project\images" . $_FILES["file"]["name"]))
    {
        echo $_FILES["file"]["name"] . " already exists. ";
    }
    else
    {
        move_uploaded_file($_FILES["file"]["tmp_name"],
            "C:\xampp\htdocs\php2306\Project\images" . $_FILES["file"]["name"]);
        echo "Stored in: " . "C:\xampp\htdocs\php2306\Project\images" . $_FILES["file"]["name"];
    }
}
}
else
{
echo "Invalid file";
} */
	
	$con=mysql_connect("localhost","root","");
		if (!$con)
		 { die(mysql_error());  
		} 
	mysql_select_db("product_details") or (mysql_error());
	$sql="INSERT INTO product_entry(Pr_id,Pr_Mod_No,Pr_Name,Pr_Cat,Pr_Sub_Cat,Pr_Price,Pr_Brand)VALUES
	('$_POST[P_id]','$_POST[P_Mod_No]','$_POST[P_Name]','$_POST[P_Cat]','$_POST[P_Sub_Cat]','$_POST[P_Price]','$_POST[P_Brand]')";
	$c=mysql_query($sql)or die(mysql_error());
		if ($c>0)
		{ echo"Product Record Save";
		}
		else 
		{ echo"Can not Save The Record";
		}
	/* define('MB', 1048576);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1*MB)
&& in_array($extension, $allowedExts))
{
if ($_FILES["file"]["error"] > 0)
{
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("C:\xampp\htdocs\php2306\Project\images" . $_FILES["file"]["name"]))
    {
        echo $_FILES["file"]["name"] . " already exists. ";
    }
    else
    {
        move_uploaded_file($_FILES["file"]["tmp_name"],
            "C:\xampp\htdocs\php2306\Project\images" . $_FILES["file"]["name"]);
        echo "Stored in: " . "C:\xampp\htdocs\php2306\Project\images" . $_FILES["file"]["name"];
    }
}
}
else
{
echo "Invalid file";
}*/
   mysql_close($con);
   ?>