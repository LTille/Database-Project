<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link href="../css/mycss.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <?php include("header.php");?>
        <div class="container" style="margin-top:60px">
            <div class="bs-docs-example">
                <h2>Store List:</h2>
                <hr/>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>StoreID</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Street</th>
                            <th>Zip Code</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        include("connectDB.php"); 
                        $sql = "select * from Store inner join Location on Store.address=Location.locationId";
                        $result = mysql_query($sql,$link);
                        mysql_close($link);
                        while($row = mysql_fetch_assoc($result)){?>
                        <tr>
                            <td><?=$row['storeID']?></td>
                            <td><?=$row['state']?></td>
                            <td><?=$row['city']?></td>
                            <td><?=$row['street']?></td>
                            <td><?=$row['zip_code']?></td>
                        </tr>
                        <?php } ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </body>    
</html>




