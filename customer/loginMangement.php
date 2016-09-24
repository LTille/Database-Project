<!-- I'm the latest login XDDDD -->

<?php
	include("connectDB.php");
	$errormessage=NULL;
	if (isset($_POST['username'])&&isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		// $sql ="select * from Employee where empID='".$username."'";
		// $result = mysql_query($sql,$link);
		// $row = mysql_fetch_assoc(mysql_query("select * from Employee where empID='".$username."'",$link));
		// if($row){
		if(mysql_fetch_assoc(mysql_query("select * from Employee where empID='".$username."'",$link))){
			$sql ="select * from Employee where empID='".$username."'";
			$result = mysql_query($sql,$link);
			$row = mysql_fetch_assoc(mysql_query("select * from Employee where empID='".$username."'",$link));
			if(md5($password)==$row['password']||$password==$row['password']){
				$title=$row['jobTitle'];
				//var_dump($title);
				session_start();
				$_SESSION['login']=true;
				$_SESSION['userName']=$username;
				if($row['jobTitle']=='Staff'){
					header('Location: ../employee/adminManagement.php');
				}else if($row['jobTitle']=='Store manager'){
					header('Location:../employee/ManagerManagement.php');
				}
				else if($row['jobTitle']=='Region manager'){
					header('Location:../employee/RegionManagement.php');
				}	
			}else{
				session_start();
				$errormessage="Wrong password!";
				$_SESSION['error']=$errormessage;
				header('Location:error_management.php');
			}
		}else if(mysql_fetch_assoc(mysql_query("select * from Customer where accountId='".$username."'",$link))){
			$resultc = mysql_query("select * from Customer where accountId='".$username."'",$link);
			$rowc = mysql_fetch_assoc($resultc);
			if(md5($password)==$rowc['password']||$password==$rowc['password']){
				$title="customer";
				session_start();
				$_SESSION['login']=true;
				$_SESSION['userName']=$username;
				// $_SESSION['userType']=$title;
				//var_dump($_SESSION['userType']);
				header('Location:welcomePage.php');
			}else{
				session_start();
				$errormessage="Wrong password";
				$_SESSION['error']=$errormessage;
				header('Location:error_management.php');
			}
		}
		else{
			session_start();
			$errormessage="No such user";
			$_SESSION['error']=$errormessage;
			header('Location:error_management.php');
		}
	}
	else{
			session_start();
			$errormessage="No such user";
			$_SESSION['error']=$errormessage;
			header('Location:error_management.php');
		}
	
	//var_dump($errormessage);
?>	



