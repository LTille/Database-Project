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
        	include("header.php");
        	session_start();
        ?>
        <div class="container" style="margin-top:100px">
        <div class="alert">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Warning!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?=$_SESSION['error']?><strong><br/><br/><a href="welcomePage.php">Click to back to home page</a></strong>

		</div>
	</div>
    </body>
</html>