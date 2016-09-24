<?php 
	session_start();
	include ('connectDB.php');
	$user_id=$_SESSION['userName'];
  #$tranNum = "select count(distinct(orderID)) from C_Order where customer_id='".$user_id."'";
	$sql_tran ="select distinct(orderID),submitTime,ostate from C_Order where customer_id='".$user_id."'";
	$result_tranId=mysql_query($sql_tran,$link);

?>

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
    	<?php include('header.php');?>
      	<div class="container" style="padding-top:70px;">
      		<h2>Your Order History</h2>
      		<?php
      			while($row=mysql_fetch_assoc($result_tranId)){
      			$total_price=0;  
            $sql_proId ="select * from OPDetail where order_id = ".$row['orderID']."";
					  $result_tran=mysql_query($sql_proId,$link);
      		?>

  			<div class="row">
  				<div class="span2">
  					<h4><?=$row['orderID']?></h4>
  				</div>
  				<div class="span8">
  					<?php while ($row_pro=mysql_fetch_assoc($result_tran)){ 
            $sql_proInfo ="select * from Product where productID = '".$row_pro['product_id']."'";
            $result_proInfo=mysql_query($sql_proInfo,$link);
            $row_proInfo=mysql_fetch_array($result_proInfo);
            ?>
  					<div class="row">
              <div class="span2">
                 <h4><?=$row_proInfo['pname']?> </h4><br>
              </div>
  						<div class="span2">
  							<img class="img-rounded" width='140px' height='140px' src="<?=$row_proInfo['image']?>"/>
  						</div>
  						<div class="span2">
  							<h4>Price : </h4>
  							<h5><?=$row_proInfo['price']?> </h5>
  						</div>
  						<div class="span2">
  							<h4>Quantity: </h4>
  							<h5><?=$row_pro['amount']?> </h5>
  						</div>
  					</div>
  					<br/>
  					<?php  $total_price+= $row_pro['amount']*$row_proInfo['price'];} ?>
  				</div>
  			</div>
          <?php 
            if($row['ostate']=='Confirmed'){
              $status="Preparing";
            }else if ($row['ostate']=='Shipped'){
              $status="Shipping";
            }else{
              $status="Delivered";
            }
          ?>
  				<h3 >Total Price : <?=$total_price?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Date : <?=$row['submitTime']?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Status: <?=$status?></h3>
  			<hr/>
      		<?php } ?>
      	</div>
 	</body>
 </html>