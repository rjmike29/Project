<?php
$cst_nm=$_POST["cust_nm"];
$cst_adrs=$_POST["cust_adrs"];
$cust_phn_no=$_POST["cust_phn_no"];
$cust_email=$_POST["cust_email"];
$pr_id=$_POST["pr_id"];
$cust_pr_qty=$_POST["cust_pr_qty"];
$cust_pr_price=$_POST["cust_price"];
require_once("product_details_connect.php");
$q1="select if null(max(substr(cust_id,9)),100)from cust_order where cst_order_dt=current_date";
$result=mysql_query($q1)or die(mysql_error());
$id=mysql_result($result,o,o);
$id++;
$cust_id=date("dmy").substr($cst_fname,0,1).substr($cst_lnsme,0,1).$id++;
$Cst_nm=$cst_fname,"",$cst_lname;
$q2="insert into customer_order(cust_id,Cst_nm,Cst_adrs,Cst_phn_no,Cst_email,pr_id,Cst_pr_qnty,Cst_price,Cst_order_dt)"