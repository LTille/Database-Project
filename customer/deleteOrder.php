<?php
	session_start();
	if($_SESSION['userName']==NULL){
		header('Location:welcomePage.php');
	}else if (isset($_GET['orderId'])){
		$orderId=$_GET['orderId'];
		include("connectDB.php");
		$sql = "delete from C_order where orderID=".$orderId."";
		//var_dump($sql);
		mysql_query($sql,$link);
		mysql_close($link);
		header('Location:shoppingCart.php');
	}
?>