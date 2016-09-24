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
        $sql_inventory1="SELECT Product_Store.product_id, Product.pname, Product_Store.store_id, Product_Store.amount FROM Product, Product_Store, Store WHERE Product.productID = Product_Store.product_id AND Product_Store.store_id = Store.storeID AND Store.st_manager = '".$_SESSION['empID']."'";
        $result_inventory1=mysql_query($sql_inventory1,$link);
        ?>
		<div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Inventory of <?=$row['store_id']?>:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Store ID</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                		while ($row = mysql_fetch_assoc($result_inventory1)){ ?>
                		<tr>
                            <th><?=$row['product_id']?></th>
                            <th><?=$row['pname']?></th>
                            <th><?=$row['store_id']?></th>
                            <th><?=$row['amount']?></th>
                        </tr>
                    	<?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>