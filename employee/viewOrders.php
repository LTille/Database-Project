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
			<?php 
				include ('connectDB.php');
				$empID=$_SESSION['userName'];
				
				if ($_GET['type']=='process'){
					$type="Unfinished Orders";
					$sql_order = "select * from C_Order where em_id='".$empID."' and ostate='Confirmed'";
				}else if ($_GET['type']=='finished'){
					$type="Finished Orders";
					$sql_order = "select * from C_Order where em_id='".$empID."' and ostate='Completed'";
				}else {
					$type="All Orders";
					$sql_order = "select * from C_Order where em_id='".$empID."'";
				}
			?>
			<h1>Welcome! <?=$_SESSION['userName']?> </h1>
			<h2><?=$type?></h2>
			<hr/>
		<?php 
			//var_dump($sql_order);
			$result=mysql_query($sql_order,$link);
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

