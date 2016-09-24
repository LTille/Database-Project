<?php
	session_start();
	if (isset($_GET['method'])&&isset($_GET['order_id'])){
		include ('connectDB.php');
		$order_id=$_GET['order_id'];
		
		if ($_GET['method']=='Ship'){
			$sql ="update C_Order SET ostate = 'Shipped' where orderID='".$order_id."'";
			mysql_query($sql,$link);
			header('Location:viewOrders.php?type=all');
			//var_dump($sql);
		}else if ($_GET['method']=='Deliver'){
			$sql ="update C_Order SET ostate = 'Completed' where orderID='".$order_id."'";
			//var_dump($sql);
			mysql_query($sql,$link);
			header('Location:viewOrders.php?type=all');
			
		}
	}
?>