<?php
    session_start();
    include('checkAdmin.php');
    $check=checkAdmin($_SESSION['userName']);
    if ($check){
        $_SESSION['name'] = $check['name'];
        var_dump($user_type);
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
            <a class="brand" href="#">Order Management</a>
            <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    <a href="logout.php">Log Out (<?=$check['jobTitle']?>)</a>
                </p>
                <ul class="nav">
                    <li><a href="adminManagement.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Orders <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="nav-header">My Orders</li>
                            <li><a href="viewOrders.php?type=process">Unfinished Orders</a></li>
                            <li><a href="viewOrders.php?type=finished">Finished Orders</a></li>
                            <li class="divider">-----</li>
                            <li><a href="viewOrders.php?type=all">All Orders</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/><br/>


