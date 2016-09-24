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
		include('adminheader.php');       
		?>
		<div class="container">
			<h1>Welcome! <?=$_SESSION['userName']?></h1>
			<h2>Preparing Orders</h2>
			<hr/>
		<?php 
			include ('connectDB.php');
			$ssn=$_SESSION['ssn'];
			$sql = "select * from works_at where ssn='".$ssn."'";
			//var_dump($sql);
			$result=mysql_query($sql,$link);
			$row = mysql_fetch_assoc($result);
			if($row){
				$store_id=$row['store_id'];
				//var_dump($store_id);
			}
			$sql = "select * from transaction_log where store_id='".$store_id."' and employee_id IS NULL";
			//var_dump($sql);
			$result=mysql_query($sql,$link);
			while ($row = mysql_fetch_assoc($result)){
				$transaction_id=$row['transaction_id']; ?>
				<div class="row">
					<div class="span2">
						<h3><?=$transaction_id?></h3>
						<h6>Customer: <?=$row['customer_id']?></h6>
						<?php 
							if ($row['Finished']==-1){
								$status="Preparing";
							}else if ($row['Finished']==0){
								$status="Shipping";
							}else if ($row['Finished']==1){
								$status="Delivered";
							}?>
						<h6>Status: <?=$status?></h6>
					</div>
					<div class="span6">
					<?php
						$sql = "select * from transaction_items I, products P where transaction_id='".$transaction_id."' and I.product_id=P.product_id";
						//var_dump($sql);
						$result_item=mysql_query($sql,$link);
						while ($row_item = mysql_fetch_assoc($result_item)){?>
							<div class="row">
								<div class="span2">
									<img src="<?=$row_item['image']?>" width="50px" height="50px">
								</div>
								<div clas=="span5">
									<p>Number: <?=$row_item['number']?></p>
									<p>Unit Price: <?=$row_item['price']?></p>
								</div>
							</div>	
						<?php } ?>
					</div>
					<div class="span3">
						<!--<p><a href="orderProcess.php?method=Delete&transaction_id=<?=$transaction_id?>">Delete this order</a></p>-->
						<p><a href="orderProcess.php?method=Ship&transaction_id=<?=$transaction_id?>">Change status to Shipping</a><p>
						<p><a href="orderProcess.php?method=Deliver&transaction_id=<?=$transaction_id?>">Change status to Delivered</a></p>
						
					</div>
				</div>
				<hr/>
				
			<?php } ?>
		</div>
    </body>
</html>

