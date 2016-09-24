<?php
    $resultfinal;
    if(isset($_POST['searchquery'])){
        $productType=$_GET['type'];
        //var_dump($productType);
        include("connectDB.php");
        $sql ="select * from Product where pname like '%".$_POST['searchquery']."%'";
        var_dump($sql);
        $result = mysql_query($sql,$link);
        mysql_close($link);
    }
    $resultfinal=$result;


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
      	<div style="margin-top:70px;" class="container">
            <div class="row">
                <div class="span2"></div>
                <div class="span6">
                    <form action ="searchResult.php" method="POST">
                        <div class="input-append">
                            <input class="input-xxlarge" style="height:30px" name="searchquery" type="text" placeholder="Search for products">
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>
             </div>
             <div class="row"><?php 
             $numresult=0;
            while($row = mysql_fetch_assoc($resultfinal)){
                $numresult=$numresult+1;?>
                <div class="span3">
                <p><?=$row['pname']?></p>
                <img class='img-rounded' width='200px' height='200px' src="<?=$row['image']?>"/>
                <a href="selectStore.php?productId=<?=$row['productID']?>">Add to chart</a>
                <p>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?=$row['price']?></p>
                <hr>
                </div>
            <?php }
            ?>
            </div>
            <?php 
                if ($numresult==0){?>
                   <div class="alert alert-block">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Warning!</h4><br/><br/>
                        No Such Result! Please try other queries!
                    </div>
                <?php }

            ?>
         </div>
     </body>
 </html>