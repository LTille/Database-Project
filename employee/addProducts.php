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
		//select E.ssn,E.user_name, E.name,E.user_type, S.store_id,S.store_name,S.manager from employees E, works_at W,Store S where E.ssn = W.ssn and S.store_id=W.store_id and S.manager='123-45-5555'
		//var_dump($_SESSION['ssn']);
		include ('connectDB.php');
		session_start();
		$sql = "select * from Store where st_manager='".$_SESSION['userName']."'";
		$store_id= mysql_fetch_assoc(mysql_query($sql))['storeID'];
		//var_dump($store_id);
		?>
		<div class="container" style="margin-top:60px">
			<form action="upload_file.php" method="post" enctype="multipart/form-data">
				<div class="bs-docs-example">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Select Type</th>
								<th>Enter ProductName</th>
								<th>Enter Cost</th>
								<th>Enter Retail Price</th>
								<th>Number</th>
								<th>Select Picture</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>
									<?php
									include("connectDB.php");
									$sql = "select * from Category";
									$result = mysql_query($sql,$link);
									?>
									<select name="type" class="span2">
										<?php
										while($row=mysql_fetch_assoc($result)){ ?>
											<option value=<?=$row['categoryID']?>><?=$row['cname']?></option>
										<?php } ?>
									</select>
								</th>
								<th>
									<input type="text" class="span2"name="pname">
								</th>
								<th>
									<input type="text" class="span2" name="cost">
								</th>
								<th>
									<input type="text" class="span2" name="price">
								</th>
								<th>
									<input type="text" class="span1" name="amount">
								</th>
								<th>
									<input type="file" name="file" id="file"> 
								</th>
							</tr>
						</tbody>
					</table>
					<button type="submit" class="btn">Submit</button>
				</div>
			</form>
		</div>

</body>
</html>
