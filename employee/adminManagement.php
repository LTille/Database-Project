<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link href="../css/mycss.css" rel="stylesheet" media="screen">
    </head>
    <body>
    	<?php
		include('Adminheader.php');       
		?>
		<div class="container">
			<h1>Welcome! <?=$_SESSION['name']?></h1>
			<h2>You can start processing your orders</h2>
			<hr/>
		<?php 
			include ('connectDB.php');
			$empID=$_SESSION['userName'];
		
			$sql = "select * from C_Order where em_id='".$empID."'";

			$result=mysql_query($sql,$link);
			while ($row = mysql_fetch_assoc($result)){
				$order_id=$row['orderID']; ?>
				<div class="row">
					<div class="span2">
						<h3><?=$order_id?></h3>
						<h6>Customer: <?=$row['customer_id']?></h6>
						<?php 
							if ($row['ostate']=="Confirmed"){
								$status="Preparing";
							}else if ($row['ostate']=="Shipped"){
								$status="Shipping";
							}else if ($row['ostate']=="Completed"){
								$status="Delivered";
							}?>
						<h6>Status: <?=$status?></h6>
					</div>
					<div class="span6">
					<?php
						$sql = "select * from OPDetail O, Product P where order_id='".$order_id."' and O.product_id=P.productID";
					
						$result_item=mysql_query($sql,$link);
						while ($row_item = mysql_fetch_assoc($result_item)){?>
							<div class="row">
								<div class="span2">
									<img src="<?=$row_item['image']?>" width="50px" height="50px">
								</div>
								<div clas=="span5">
									<p>Quantity: <?=$row_item['amount']?></p>
									<p>Unit Price: $<?=$row_item['price']?></p>
								</div>
							</div>	
						<?php } ?>
					</div>
					<div class="span3">
						<!--<p><a href="orderProcess.php?method=Delete&transaction_id=<?=$transaction_id?>">Delete this order</a></p>-->
						<p><a href="orderProcess.php?method=Ship&order_id=<?=$order_id?>">Change status to Shipped</a><p>
						<p><a href="orderProcess.php?method=Deliver&order_id=<?=$order_id?>">Change status to Completed</a></p>
						
					</div>
				</div>
				<hr/>
				
			<?php } ?>
		</div>
    </body>
</html>

