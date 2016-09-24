<?php
  error_reporting(E_ALL); //print out all wrong information
  session_start();
  $total_price=0;
    if($_SESSION['userName']==NULL){
  header('Location:welcomePage.php'); }
  else{
    include("connectDB.php");
    include("generateId.php");

        $orderId=generateId(10);
        $_SESSION['orderId'] = $orderId;
        $customerId = $_SESSION['userName'];
         
        $productIds = array();
        $quantities = array();
        $storeIds = array();
     
        $_SESSION['order']=array();

      foreach($_SESSION['cart_items'] as $productId=>$value){
        
         $_SESSION['order'][$productId] = array('storeId' => $value['storeId'],'quantity' =>$value['quantity']);
         $productIds[] = $productId;
         $quantities[] = $value['quantity'];
         $storeIds[] = $value['storeId'];
      }
     
    
      $str = join(",",$productIds);
      $inStr = "'".str_replace(",","','",$str)."'";

      ##find the category for all the product    

      $findCat ="select category_id from Product where productID in ($inStr)";
 
      $category = mysql_query($findCat,$link);
      $date = date('Y-m-d H:i:s');

      $k=0;

      while($row1=mysql_fetch_assoc($category)){
      
      $findEmp_id = "select em_id from CEDetail where category_id='".$row1['category_id']."' and store_id='".$storeIds[$k]."'";
      $result = mysql_query($findEmp_id);
      $row2 = mysql_fetch_array($result);
      $employId = $row2['em_id'];

      $sqlInsertion1 = "insert into C_Order value(".$orderId.", '".$customerId."','".$employId."','confirmed','".$date."')";
       mysql_query($sqlInsertion1);

      $sqlInsertion2 = "insert into OPDetail value(".$orderId.", '".$productIds[$k]."','".$quantities[$k]."')";
       mysql_query($sqlInsertion2);

      $k++;
      }
      
      unset($_SESSION['cart_items']);

      $order = mysql_query("select * from OPDetail where order_id =".$orderId."");
       mysql_close($link);
      #header('Location:orderHistory.php');
    
       
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
          <h2>Your order has been submitted successfully</h2>
            <hr/>
            <div class="accordion" id="accordion2">
              <table class="table table-hover">
                  <thead>
                    <tr>
                        <th>OrderID</th>
                        <td>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
            
              <tr>    
             <?php
                while ($row=mysql_fetch_assoc($order)){
                   
                   $productInfo = mysql_query("select * from Product where productID='".$row['product_id']."'");
                   $row1 = mysql_fetch_array($productInfo);
                  ?> 
                 <td><?=$orderId?></td>       
                 <td><?=$row1['pname']?><br>
                 <img class='img-rounded' width='200px' height='200px' src="<?=$row1['image']?>"/>
                 </td>
                 <td>$<?=$row1['price']?></td>
                 <td><?=$row['amount']?></td>
              </tr>  
              <?php  
              $total_price+=$row1['price']*$row['amount'];
              } 
              ?> 
              </table>
            <br><br>
            <div class= "row">
              <div class="span5">
                  <h3>TotalPrice : $<?=$total_price?></h3>
                </div>
                <div class="span5">
                 <a href="deleteOrder.php?orderId=<?=$orderId?>" role="button" class="btn btn-primary btn-large">Cancel</a>
                </div>
                <div class="span2">
                  <a href="#checkOut" role="button" class="btn btn-primary btn-large" data-toggle="modal">CheckOut</a>
                </div>
            </div>
          </div>
        <div id="checkOut" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
          <h3 id="myModalLabel">Select your payment method</h3>
        </div>
        <div class="modal-body">
          <form method="POST" action="checkOut.php"> 
            <fieldset>
              <h5>CREDIT CARD NUMBER</h5>
              <input style="height:40px;width:270px" type="text" placeholder="Your Card Number" required><font color="red">*</font>
              <br/>
              <img src="../image/payment/visa.gif" alt="visa">
              <img src="../image/payment/mastercard.gif" alt="marstercard">
              <img src="../image/payment/discover.gif" alt="discover">
              <img src="../image/payment/dinersclub.gif" alt="dinersclub">
              <img src="../image/payment/amex.gif" alt="amex">
              <br/><br/>
              <h5>EXPIRATION DATE</h5>
              <select class="span2">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
            <select class="span2">
              <option>2014</option>
              <option>2015</option>
              <option>2016</option>
              <option>2017</option>
              <option>2018</option>
              <option>2019</option>
              <option>2020</option>
              <option>2021</option>
              <option>2022</option>
              <option>2023</option>
              <option>2024</option>
              <option>2025</option>
            </select>
            <div class="controls controls-row">
              <label>CVV&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input style="width:130px;height:30px;" class="span2" type="text" placeholder="CVV" required><font color="red">*</font>       
            </div>
            </fieldset>
          </from>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
          <button class="btn btn-primary">Submit</button>
        </div>
    </div>
    </body>
</html>