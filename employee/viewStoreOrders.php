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
		include('ManagerHeader.php');
        include('connectDB.php');
        $sql_order = "SELECT * FROM C_Order, OPDetail, CEDetail, Store, Product WHERE C_Order.orderID = OPDetail.order_id AND C_Order.em_id = CEDetail.em_id AND Product.productID = OPDetail.product_id AND Product.category_id = CEDetail.category_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."'";
        $result_log=mysql_query($sql_order,$link);
        while ($row_log = mysql_fetch_assoc($result_log)){
        $transaction_id=$row_log['orderID']; ?>
        <div class="container">
            <div class="row">
                <div class="span2">
                    <h3><?=$transaction_id?></h3>
                        <h6>Customer: <?=$row_log['customer_id']?></h6>
                        <!-- <h6>Total Price: <?=$row_log['total_price']?></h6> -->
                        <?php 
                            if ($row_log['ostate']=='Confirmed'){
                                $status="Confirmed";
                            }else if ($row_log['ostate']=='Shipped'){
                                $status="Shipped";
                            }else if ($row_log['ostate']=='Completed'){
                                $status="Completed";
                        }?>
                        <h6>Status: <?=$status?></h6>
                </div>
                <div class="span4">
                <?php
                    $sql_item = "select * from OPDetail, Product where OPDetail.order_id='".$transaction_id."' and OPDetail.product_id=Product.productID";
                    //var_dump($sql);
                    $result_item=mysql_query($sql_item,$link);
                    while ($row_item = mysql_fetch_assoc($result_item)){?>
                    <div class="row">
                        <div class="span2">
                            <img src="<?=$row_item['image']?>" width="50px" height="50px">
                        </div>
                        <div clas=="span5">
                        <p>Number: <?=$row_item['amount']?></p>
                        <p>Unit Price: <?=$row_item['price']?></p>
                        </div>
                    </div>  
                <?php } ?>
                </div>
                <div class="span2">
                    <p> Employee:</p>
                    <p><?=$row_log['em_id']?></p>
                </div>
            </div>
            <hr/>
        </div>
            <?php }?>
    </body>
</html>
