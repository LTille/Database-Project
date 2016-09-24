<?php
	//var_dump("1232");
	$product_id=$_GET['product_id'];
	$store_id=$_GET['store_id'];
	$product_number=$_GET['amount'];
	//var_dump($product_number);
	//var_dump($product_id);
	//var_dump($store_id);
	$sql ="UPDATE Product_Store SET amount=".$product_number." 
	where product_id='".$product_id."' and store_id='".$store_id."'";
	//var_dump($sql);
	include ('connectDB.php');
	mysql_query($sql,$link);
	mysql_close($link);
	header('Location:viewStoreProduct.php');

?>


