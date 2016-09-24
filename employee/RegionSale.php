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
        include('RegionHeader.php');
        //var_dump($_SESSION['ssn']);
        include('connectDB.php');
        $sql_storesales="select CEDetail.store_id as store_id, round( sum(temp.sale) ) as SumSale, round( sum(temp.sale)- sum(temp.cost) ) as Sumcost from CEDetail, ( select C_Order.em_id, OPDetail.amount * Product.price as sale, OPDetail.amount * Product.cost as cost, OPDetail.order_id, Product.category_id AS Category from OPDetail, Product, C_Order where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID ) as temp WHERE temp.em_id = CEDetail.em_id AND temp.Category = CEDetail.category_id GROUP BY CEDetail.store_id";
        $result_storesales=mysql_query($sql_storesales,$link);
        
        $sql_catesales="select CEDetail.category_id as category_id, round( sum(temp.sale) ) as SumSale, round( sum(temp.sale)- sum(temp.cost) ) as Sumcost from CEDetail, ( select C_Order.em_id, OPDetail.amount * Product.price as sale, OPDetail.amount * Product.cost as cost, OPDetail.order_id, Product.category_id AS Category from OPDetail, Product, C_Order where C_Order.orderID = OPDetail.order_id AND OPDetail.product_id = Product.productID ) as temp WHERE temp.em_id = CEDetail.em_id AND temp.Category = CEDetail.category_id GROUP BY CEDetail.category_id";
        $result_scatesales=mysql_query($sql_catesales,$link);
        
        ?>
        <div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Sales&Profits by store:</h2>
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