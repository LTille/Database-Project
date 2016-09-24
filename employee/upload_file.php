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
include ('connectDB.php');
session_start();
$sql = "select * from Store where st_manager='".$_SESSION['userName']."'";
$store_id= mysql_fetch_assoc(mysql_query($sql))['storeID'];
if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg"))){
        if ($_FILES["file"]["error"] > 0){
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else{
            if (file_exists("upload/" . $_FILES["file"]["name"])){
                echo $_FILES["file"]["name"] . " already exists. ";
            }else{
                //var_dump($_POST['cost']);
                //var_dump($_POST['productName']);
                //var_dump($_FILES["file"]["name"]);
                //var_dump($_POST['price']);
                //var_dump($_POST['description']);
                //var_dump($_POST['type']);
                include ('../customer/generateId.php');
                $product_id=generateId("P",8);
                //var_dump($product_id);
                //var_dump($_POST['product_number']);
                //var_dump($store_id);
                if($_POST['type']==0000000001){
                    $fileaddress="../image/products/0000000001/";
                }else if ($_POST['type']==0000000002){
                    $fileaddress="../image/products/0000000002/";
                }else if ($_POST['type']==0000000003){
                    $fileaddress="../image/products/0000000003/";
                }else if ($_POST['type']==0000000004){
                    $fileaddress="../image/products/0000000004/";
                }else if ($_POST['type']==0000000005){
                    $fileaddress="../image/products/0000000005/";
                }else if ($_POST['type']==0000000006){
                    $fileaddress="../image/products/0000000006/";
                }else if ($_POST['type']==0000000007){
                    $fileaddress="../image/products/0000000007/";
                }
                $fileaddress.=$_FILES["file"]["name"];
                // var_dump($fileaddress);
                $sql = "insert into Product values('".$product_id."','".$_POST['pname']."',".$_POST['price'].",".$_POST['cost'].",'".$_POST['type']."','".$fileaddress."')";
                // var_dump($sql);
                mysql_query($sql,$link);
                move_uploaded_file($_FILES["file"]["tmp_name"],
                $fileaddress);
                $sql_inventory="insert into Product_Store values('".$product_id."','".$storeID."',".$_POST['amount'].")";
                // var_dump($sql_inventory);
                mysql_query($sql_inventory,$link);
                echo "Product added.";
            }
        }
    }else{
        echo "Invalid file";
    }
?>


</body>
</html>