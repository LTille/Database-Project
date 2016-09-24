<?php
	function checkAdmin($empID){
		include ('connectDB.php');
		$sql ="select * from employee where empID='".$empID."'";
		$check = mysql_fetch_assoc(mysql_query($sql,$link));
		return $check;
	}
?>
