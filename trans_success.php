<?php require 'mainmenu.php'; ?>
<html>
<head>
<script>
window.opener.close();
</script>
<style>
input
{
	background-color:green;
	color:white;
	width:120px;
	height:40px;
}
input:hover
{
	opacity:0.9;
}
</style>
</head>
<body>
<h1>Your order:</h1>
<table style="border-spacing:60px 40px;margin:10px;">
<tr>
<th colspan="2">Item</th>
<th>Quantity</th>
<th>Sub Total</th>
</tr>
<tr>
<td>
<img src="<?php echo $_GET['img']; ?>">
</td>
<td>
<?php echo $_GET['pnm'];?>
</td>
<td>
<?php echo $_GET['qty'];?>
</td>
<td>
<b>
Rs. <?php echo $_GET['tp'];?></b>
</td>
</tr>
</table>
<h1>Will be delivered within 5 days</h1>
<br/>
<br/>
<input type="button" onclick="window.location.href='e2.firstpage.php'" value="Keep Shopping">
</body>
</html>