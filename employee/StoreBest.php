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
        $sql_bestHcustomer="select Customer.name, round( sum(temp.sale) ) as SumSale, Home_Customer.gender, Home_Customer.age, Home_Customer.marriageStatus, Home_Customer.income from Customer, Home_Customer, ( select C_Order.customer_id, SUM(OPDetail.amount * Product.price) as sale from OPDetail, Product, C_Order, Store, CEDetail where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY C_Order.customer_id ) as temp WHERE Customer.accountId = temp.customer_id AND Customer.kind = 'H' AND Customer.accountId = Home_Customer.homeId AND TEMP.sale = ( SELECT MAX(temp2.sale) FROM ( select SUM(OPDetail.amount * Product.price) as sale from OPDetail, Product, C_Order, Store, CEDetail where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY C_Order.customer_id ) AS temp2 )";
        $result_bestHcustomer=mysql_query($sql_bestHcustomer,$link);
        
        $sql_bestBcustomer="select Customer.name, round( sum(temp.sale) ) as SumSale, Business_Customer.bCategory, Business_Customer.income from Customer, Business_Customer, ( select C_Order.customer_id, sum(OPDetail.amount * Product.price) as sale from OPDetail, Product, C_Order, Store, CEDetail where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY C_Order.customer_id ) as temp WHERE Customer.accountId = temp.customer_id AND Customer.kind = 'B' AND Customer.accountId = Business_Customer.businessId AND TEMP.sale = ( SELECT MAX(temp2.sale) FROM ( select sum(OPDetail.amount * Product.price) as sale from OPDetail, Product, C_Order, Store, CEDetail where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY C_Order.customer_id ) AS temp2 )";
        $result_bestBcustomer=mysql_query($sql_bestBcustomer,$link);
        
        $sql_bestSeller="SELECT TEMP.sale, TEMP.profit, Product.pname, Product.price, Product.cost, Product.category_id FROM Product, ( select Product.productID, sum(OPDetail.amount * Product.price) as sale, SUM(OPDetail.amount * Product.price)- sum(OPDetail.amount * Product.cost) as profit from OPDetail, Product, C_Order, CEDetail, Store where OPDetail.product_id = Product.productID AND OPDetail.order_id = C_Order.orderID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY OPDetail.product_id ) AS TEMP WHERE Product.productID = TEMP.productID AND temp.sale = ( SELECT MAX(TEMP3.sale) FROM ( select sum(OPDetail.amount * Product.price) as sale from OPDetail, Product, C_Order, CEDetail, Store where OPDetail.product_id = Product.productID AND OPDetail.order_id = C_Order.orderID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY OPDetail.product_id ) AS TEMP3 )
";
        $result_bestSeller=mysql_query($sql_bestSeller,$link);
        
        $sql_bestProfit="SELECT TEMP.sale, TEMP.profit, Product.pname, Product.price, Product.cost, Product.category_id FROM Product, ( select Product.productID, sum(OPDetail.amount * Product.price) as sale, SUM(OPDetail.amount * Product.price)- sum(OPDetail.amount * Product.cost) as profit from OPDetail, Product, C_Order, CEDetail, Store where OPDetail.product_id = Product.productID AND OPDetail.order_id = C_Order.orderID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY OPDetail.product_id ) AS TEMP WHERE Product.productID = TEMP.productID AND temp.profit = ( SELECT MAX(TEMP3.profit) FROM ( select SUM(OPDetail.amount * Product.price)- sum(OPDetail.amount * Product.cost) as profit from OPDetail, Product, C_Order, CEDetail, Store where OPDetail.product_id = Product.productID AND OPDetail.order_id = C_Order.orderID AND C_Order.em_id = CEDetail.em_id AND CEDetail.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."' GROUP BY OPDetail.product_id ) AS TEMP3 )
";
        $result_bestProfit=mysql_query($sql_bestProfit,$link);
        
        ?>
		<div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Best Home Customer:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purchase</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Marriage Status</th>
                            <th>Income</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                		while ($row = mysql_fetch_assoc($result_bestHcustomer)){ ?>
                		<tr>
                            <th><?=$row['name']?></th>
                            <th><?=$row['SumSale']?></th>
                            <th><?=$row['gender']?></th>
                            <th><?=$row['age']?></th>
                            <th><?=$row['marriageStatus']?></th>
                            <th><?=$row['income']?></th>
                        </tr>
                    	<?php }?>
                    </tbody>
                </table>
            </div>
        </div>
 
        
        <div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Best Business Customer:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purchase</th>
                            <th>Business Category</th>
                            <th>Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($result_bestBcustomer)){ ?>
                        <tr>
                            <th><?=$row['name']?></th>
                            <th><?=$row['SumSale']?></th>
                            <th><?=$row['bCategory']?></th>
                            <th><?=$row['income']?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Best seller:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Sales</th>
                            <th>Profit</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($result_bestSeller)){ ?>
                        <tr>
                            <th><?=$row['pname']?></th>
                            <th><?=$row['sale']?></th>
                            <th><?=$row['profit']?></th>
                            <th><?=$row['category_id']?></th>
                            <th><?=$row['price']?></th>
                            <th><?=$row['cost']?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Best profit maker:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Sales</th>
                            <th>Profit</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($result_bestProfit)){ ?>
                        <tr>
                            <th><?=$row['pname']?></th>
                            <th><?=$row['sale']?></th>
                            <th><?=$row['profit']?></th>
                            <th><?=$row['category_id']?></th>
                            <th><?=$row['price']?></th>
                            <th><?=$row['cost']?></th>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>


    </body>
</html>