<?php
	$finalresult=null;
	if (isset($_GET['productId'])){
		session_start();
		$_SESSION['productId']=$_GET['productId'];
		//var_dump("you");
		$productId=$_GET['productId'];
		include("connectDB.php");
		$sql= "select * from Product_Store P,Store S, Location L where P.store_id=S.storeID and S.address=L.locationId and product_id='".$productId."' and amount>0";	$result = mysql_query($sql,$link);
		$result = mysql_query($sql,$link);
		mysql_close($link);
		$finalresult=$result;
	}
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
    	<?php include("header.php");?>
    	<div class="container" style="margin-top:60px">
      	<h1>Please select stores</h1>
      		<form name= "form" method="POST" action="shopCartManangement.php">
      		<legend>Store Available</legend>
  			<div class="bs-docs-example">
  				<table class="table table-hover">
              		<thead>
	                	<tr>
	                  		<th>Select</th>
	                  		<th>Store ID</th>
	                  		<th>Street</th>
	                  		<th>City</th>
	                  		<th>Available Number</th>
	                  		<th>Qty</th>
	                	</tr>
	              	</thead>
              		<tbody>
      				<?php 
      					while ($row=mysql_fetch_assoc($finalresult)){
      						?>
  						<tr>
	  						<td>
	      					<input name="qtychk" type="radio" value=<?=$row['store_id']?>>	
	    					</td>
	  						<td><?=$row['store_id']?></td>
							<td><?=$row['street']?></td>
							<td><?=$row['city']?></td>
							<td><?=$row['amount']?></td>	
							<td>
								<select name="qtyslt">
									<?php
									for($i=0;$i<$row['amount'];$i++){?>
									<option value=<?=$i?>><?=$i+1?></option>
									<?php } ?>
								</select>
							</td>
						 </tr>  
      				<?php  } ?> 

      				</tbody>
      			</table>
      			 <button type="submit" name="submit" class="btn">Submit</button>
			</fieldset>
		</form>
	</body>
</html>    	


