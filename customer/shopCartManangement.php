<?php
	error_reporting(E_ALL); //所有错误信息全部输出
	session_start();

    if($_SESSION['userName']==NULL){
	    Header('Location:welcomePage.php');	
      echo "<script language='javascript'>;alert(\"please log in or register first\");</script>";}
	else{
		include("connectDB.php");

        if (isset($_POST['submit'])) {
          if(isset($_POST['qtychk'])){
          //echo "You have selected :".$_POST['qtychk'];  //  Displaying Selected Value
         }
        }
		 $username=$_SESSION['userName'];
		 $productId=$_SESSION['productId'];
		 
		 $sql="select pname from Product where productID= '".$productId."'";
		 $result=mysql_query($sql,$link);
		 $row = mysql_fetch_assoc($result);
		 $name = $row['pname'];
        
     if(!isset($_SESSION['cart_items'])){
        $_SESSION['cart_items']=array();
      }
		
		 $storeId = $_POST['qtychk'];
		 $quantity=$_POST['qtyslt']+1;

		 $_SESSION['cart_items'][$productId] = array('storeId' => $storeId,'quantity' =>$quantity);
		 header("Location: viewProducts.php");		
		 
	}
	
?>

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
        <?php include("header.php");?>
        <div class="container" style="margin-top:60px">
        <h1><?=$name?> has been added into your shopping cart successfully!</h1>
    </body>
</html>  



