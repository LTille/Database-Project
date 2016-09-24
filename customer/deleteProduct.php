<?php
	session_start();
	if($_SESSION['userName']==NULL){
		header('Location:welcomePage.php');
	}else if (isset($_GET['productId'])){
		
		$productId=$_GET['productId'];
        unset($_SESSION['cart_items'][$productId]);
		header('Location:shoppingCart.php');
	}
?>