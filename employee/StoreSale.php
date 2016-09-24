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
		//select E.ssn,E.user_name, E.name,E.user_type, S.store_id,S.store_name,S.manager from employees E, works_at W,Store S where E.ssn = W.ssn and S.store_id=W.store_id and S.manager='123-45-5555'
		//var_dump($_SESSION['ssn']);
		include('connectDB.php');
        $sql_storesales="select CEDetail.store_id as store_id, round( sum(temp.sale) ) as SumSale, round( sum(temp.sale)- sum(temp.cost) ) as Sumcost from CEDetail, ( select C_Order.em_id, OPDetail.amount * Product.price as sale, OPDetail.amount * Product.cost as cost, OPDetail.order_id, Product.category_id AS Category from OPDetail, Product, C_Order, Store, CEDetail where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID AND Product.category_id = CEDetail.category_id AND CEDetail.em_id = C_Order.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' ) as temp WHERE temp.em_id = CEDetail.em_id AND temp.Category = CEDetail.category_id GROUP BY CEDetail.store_id";
        $result_storesales=mysql_query($sql_storesales,$link);
        
        $sql_catesales="select CEDetail.category_id as category_id, round( sum(temp.sale) ) as SumSale, round( sum(temp.sale)- sum(temp.cost) ) as Sumcost from CEDetail, ( select C_Order.em_id, OPDetail.amount * Product.price as sale, OPDetail.amount * Product.cost as cost, OPDetail.order_id, Product.category_id AS Category from OPDetail, Product, C_Order, Store, CEDetail where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID AND Product.category_id = CEDetail.category_id AND CEDetail.em_id = C_Order.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' ) as temp WHERE temp.em_id = CEDetail.em_id AND temp.Category = CEDetail.category_id GROUP BY CEDetail.category_id";
        $result_scatesales=mysql_query($sql_catesales,$link);
        
        ?>
		<div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Whole store sales & profits:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Store</th>
                            <th>Sales</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                		while ($row = mysql_fetch_assoc($result_storesales)){ ?>
                		<tr>
                            <th><?=$row['store_id']?></th>
                            <th><?=$row['SumSale']?></th>
                            <th><?=$row['Sumcost']?></th>
                        </tr>
                    	<?php }?>
                    </tbody>
                </table>
            </div>
        </div>
 
        
        <div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Sales&Profits by category:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Sales</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($result_scatesales)){ ?>
                        <tr>
                            <th><?=$row['category_id']?></th>
                            <th><?=$row['SumSale']?></th>
                            <th><?=$row['Sumcost']?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>


    </body>
</html>