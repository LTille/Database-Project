<?php
	$finalresult=null;
  $total_price=0;
  session_start();

	if($_SESSION['userName']==NULL){
		header('Location:welcomePage.php');
	}else{
		include('connectDB.php');	

    if(count($_SESSION['cart_items'])>0){
      
      $productIds = array();
      $quantities = array();
      $storeIds = array();
     
      foreach($_SESSION['cart_items'] as $productId=>$value){
        
         $productIds[] = $productId;
         $quantities[] = $value['quantity'];
         $storeIds[] = $value['storeId'];
      }
    
      $str = join(",",$productIds);
      $inStr = "'".str_replace(",","','",$str)."'";

      $sql ="select * from Product where productID in ($inStr)";
      $result = mysql_query($sql,$link);
      mysql_close($link);
      $finalresult=$result;    

    }
	}
?>

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
        <div class="container" style="margin-top:60px">
         <?php 
          if (count($_SESSION['cart_items'])>0){ ?>
          <h2>Products in your shopping cart:</h2>
            <hr/>
            <form name= "form" method="POST" action="orderManagement.php">
            <div class="accordion" id="accordion2">
              <table class="table table-hover">
                  <thead>
                    <tr>
                        <th>Product</th>
                        <td>Store ID</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
              <?php $k=0;
                while ($row=mysql_fetch_assoc($finalresult)){
                  ?>
              <tr>     
                  <td><?=$row['pname']?><br>
                <img class='img-rounded' width='200px' height='200px' src="<?=$row['image']?>"/>
                 </td>
                 <td><?=$storeIds[$k]?></td>
                 <td>$<?=$row['price']?></td>
                 <td><?=$quantities[$k]?></td>  
                 <td> <a href="selectStore.php?productId=<?=$row['productID']?>">Edit</a></td>
                 <td> <a href="deleteProduct.php?productId=<?=$row['productID']?>">delete</a></td>
              </tr>  
              <?php  
              $total_price+=$quantities[$k]*$row['price'];
              $k++; 
              } 
              ?> 
              </table>
             <button type="submit" name="submit" class="btn">Submit Order</button>
             </form>
            <br><br>
            <?php }else{
            ?>
          <div class= "row">
              <div class="span10">
                  <h3>Nothing in your shopping cart</h3>
                </div>
            </div>
           <?php } ?>
      </div>
    </body>
</html>