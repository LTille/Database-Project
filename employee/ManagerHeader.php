<?php
    session_start();
    include('checkAdmin.php');
    $check=checkAdmin($_SESSION['userName']);
    if ($check){
        $jobTitle =$check['jobTitle'];
        $_SESSION['empID'] = $check['empID'];
        var_dump($jobTitle);
    }else{
        $errorMessage ="Deny Access, You are not the Employees";
        $_SESSION['errorMessage']= $errorMessage;
        header('Location:../Customer/welcomePage.php');
    }
?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    <a href="logout.php">Log Out (<?=$check['jobTitle']?>)</a>
                </p>
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sale Information<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="StoreSale.php">Sale Summary</a></li>
                            <li><a href="StoreBest.php">Best...</a></li>
                            <li><a href="StoreInventory.php">Inventory Information</a></li>
                        </ul>
                        <!-- <a class="brand" href="ManagerManagement.php">Sale Information</a> -->
                    </li>
                    <li><a href="viewStoreOrders.php">All Orders</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- <li class="nav-header">Products</li> -->
                            <li><a href="viewStoreProduct.php">Edit Products</a></li>
                            <li><a href="addProducts.php">Add Products</a></li>
                        </ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employees <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- <li class="nav-header">Employees</li> -->
                            <li><a href="StoreEmployee.php">View Employee</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/><br/>


