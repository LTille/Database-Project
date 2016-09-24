
<?php
	include("connectDB.php");
	$sql = "select * from Category";
	$result = mysql_query($sql,$link);
	//mysql_close($link);
    session_start();
    
  
?>


<div class="navbar navbar-inverse navbar-fixed-top new_nav">
		<div class="navbar-inner">
		<div class="container">
      		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
      		<div class="nav-collapse collapse">
        		<ul class="nav">
          			<li><a class="brand" href="WelcomePage.php">Cosmetic Store</a></li>
          			<li><a href="storeList.php">Stores</a></li>
          			<li class="dropdown">
            			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
            			<ul class="dropdown-menu">

              				<?php
								while($row = mysql_fetch_assoc($result)){
									echo "<li><a href=viewProducts.php?type=".urlencode($row['cname']).">".ucwords($row['cname'])."</a></li>";
								}
							?>
              				<li class="divider"></li>
			                <li><a href="viewProducts.php?type=all">View All Products</a></li>
		             	</ul>
          			</li>
        		
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
          
          <?php if($_SESSION['login']=="true"): ?>
          <li ><a href="orderHistory.php">Orders</a></li>
          <li >
                    <a href="shoppingCart.php">
                        <?php
                        // count products in cart
                        $cart_count=count($_SESSION['cart_items']);
                        ?>
                        Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                    </a>
          </li>

          <?php endif ?>
        		<?php if($_SESSION['login']!="true"): ?>
                <li ><a href="#myModal" data-toggle="modal">Sign In</a></li>
          			 <li><a>Cart</a></li>
            <?php else : 
              echo "<li><a>Welcome!  ".$_SESSION['userName']."</a></li>" ?> 
              <li><a href="logOut.php">Log Out</a></li></ul>
            <?php endif ?>

        	</div><!--/.nav-collapse -->
		</div>
		</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px">
    <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>
        <h3 id="myModalLabel">Please Log In!!</h3>
    </div>
    <div class="modal-body" >
        <form class="form-signin" action="loginMangement.php" method="POST">
            <input type="text" name="username" class="input-block-level" placeholder="Username" required><font color="red">*</font>
            <input type="password" name="password" class="input-block-level" placeholder="Password" required><font color="red">*</font>
            <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn but-large btn-primary" type="submit">Log In</button>
        </form>
    </div>
    <div class="modal-footer">
        <a href="register.php">Register</a>
    </div>
</div>
