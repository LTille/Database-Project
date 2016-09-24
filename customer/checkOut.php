<?php
    include('connectDB.php');
    session_start();
    include('generateId.php');
   
    $orderId=$_SESSION['orderId'];

    foreach($_SESSION['order'] as $productId=>$value){

      $sql_inventory="select amount from Product_Store where product_id='".$productId."' and store_id='".$value['storeId']."'";      
      $InvNumber =mysql_fetch_assoc(mysql_query($sql_inventory,$link))['amount'];
      $newNumber = $InvNumber-$value['quantity'];
      $sql_update_Inv = "update Product_Store SET amount=".$newNumber." where store_id='".$value['storeId']."' and product_id='".$productId."'";
      
      }
     
    $payment = "insert into Payment value(".$orderId.", 'Credit','Success')";
    mysql_query($payment);
  
        
    mysql_close($link);

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
        <?php include("header.php");?>
        <div class="container" style="padding-top:100px">
            <h1> Congratuations,</h1>
             <h2>we have receive your order, our Employee will contact with you as soon as possible.</h2>
            <h3><a href="orderHistory.php">Check your orders</a></h3>
        </div>
    </body>
</html>