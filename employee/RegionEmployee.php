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
        <div class="container">
    	<?php
		include('RegionHeader.php');
        //var_dump($_SESSION['ssn']);
        $sql= "SELECT * FROM Region, Store WHERE Region.rg_manager = '".$_SESSION['empID']."' AND Region.regionID = Store.regionID";
        include ('connectDB.php');
        $result1=mysql_query($sql,$link);

        while ($row1=mysql_fetch_assoc($result1)){
            //var_dump($row1['manager']);
            $manager=$row1['st_manager'];
            $sql_emp="( select empID, name, JobTitle, email, phone from Employee, Region WHERE Employee.empID = Region.rg_manager AND Region.rg_manager = '".$_SESSION['empID']."' ) UNION ( select empID, name, JobTitle, email, phone from Employee, Store, Region WHERE Employee.empID = Store.st_manager AND Store.regionID = Region.regionID AND Region.rg_manager = '".$_SESSION['empID']."' ) UNION ( select empID, name, JobTitle, email, phone from Employee, CEDetail, Store, Region WHERE Employee.empID = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.regionID = Region.regionID AND Region.rg_manager = '".$_SESSION['empID']."' )";
            //var_dump($sql_emp);
            $result =mysql_query($sql_emp,$link);?>
            
                <div class="bs-docs-example">
                    <h2><?=$row1['storeID']?></h2>
                    <hr/>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Email</th>
                                <th>phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysql_fetch_assoc($result)){ ?>
                            <tr>
                                <th><?=$row['empID']?></th>
                                <th><?=$row['name']?></th>
                                <th><?=$row['JobTitle']?></th>
                                <th><?=$row['email']?></th>
                                <th><?=$row['phone']?></th>
                                <th><a href="#orderModal_<?=$row['empID']?>" data-toggle="modal">View Orders</a></th>
                                <div id="orderModal_<?=$row['empID']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px">
                                    <div class="modal-header" >
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
                                        <h3 id="myModalLabel">Order processed by <?=$row['name']?></h3>
                                    </div>
                                    <div class="modal-body" >
                                        <?php
                                        $sql_order = "select * from C_Order where em_id='".$row['empID']."'";
                                        $result_log=mysql_query($sql_order,$link);
                                        while ($row_log = mysql_fetch_assoc($result_log)){
                                        $transaction_id=$row_log['orderID']; ?>
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
                                            <div class="span6">
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
                                        </div>
                                        <hr/>
                                        <?php }?>
                                    </div>
                                </div>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
        <?php } ?>
        </div>
    </body>
    </html>