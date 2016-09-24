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
        include ('connectDB.php');
        session_start();
        $sql = "select * from Store where st_manager='".$_SESSION['userName']."'";
        $store_id= mysql_fetch_assoc(mysql_query($sql,$link))['storeID'];
        // var_dump($store_id);
        $sql_inventory ="select * from Product,Product_Store where Product.productID=Product_Store.product_id and Product_Store.store_id='".$store_id."'";
        $result_inventory=mysql_query($sql_inventory,$link);
        ?>
        <div class="container" style="margin-top:10px">
            <div class="bs-docs-examples">
                <h2>Inventory List</h2>
                <hr/>
                <table class="table table-hover">
                    <thread>
                        <tr>
                            <th>Picture</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Inventory</th>
                        </tr>
        <?php
        while ($row_inventory = mysql_fetch_assoc($result_inventory)){?>
            <tr>
                <td><img src="<?=$row_inventory['image']?>" width="100px" height="100px"></td>
                <td><?=$row_inventory['productID']?></td>
                <td><?=$row_inventory['pname']?></td>
                <td>
                    <form action="changeInventory.php" method="get">
                        <input type="text" name="amount" value="<?=$row_inventory['amount']?>">
                        <input type="text" name="product_id" value="<?=$row_inventory['productID']?>" style="display: none">
                        <input type="text" name="store_id" value="<?=$store_id?>" style="display: none">
                        <button type="submit" class="btn" value="submit">Submit</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </body>
</html>