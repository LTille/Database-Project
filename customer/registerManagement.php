<?php
	$errormessage="";
	$username=$_POST['username'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$name=$_POST['name'];
	$street=$_POST['street'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zipcode'];
	include ('connectDB.php');
	$sql1 = "select * from Customer where accountId='".$username."'";
	$result1= mysql_query($sql1,$link);
	$row1 =mysql_fetch_assoc($result1);
	if($row1){
		$errormessage="Username Exits,please try another one";
		//echo "$errormessage";	
		//echo "<script language='javascript'>;alert('$errormessage');</script>";
	}else if ($password1!=$password2){
		$errormessage="password don't match";
		//echo "<script language='javascript'>;alert('$errormessage');</script>";
	}
	$type=$_POST['type'];
	
	$sql_insert="insert into Location(state,city,street,zip_code) 
		values('".$state."','".$city."','".$street."',".$zip.")";
	mysql_query($sql_insert,$link);

	$sql2 = "select max(locationId) from Location";
	//var_dump($sql2);
	$result2= mysql_query($sql2,$link);
	$row2 =mysql_fetch_assoc($result2);
	$locId = $row2['max(locationId)'];
	#echo '<script>alert(\"请不要再24小时内重复投票！\");</script>';
	//echo "<script language='javascript'>;alert('$locId');</script>";
	#echo windows.alert($row2);

	$sql_insert1= "insert into Customer(accountId,password,name,kind,address_location) 
		values('".$username."','".md5($password2)."','".$name."','".$type."',".$locId.")";
	//var_dump($sql_insert1);
	mysql_query($sql_insert1,$link);
	if($type=="B"){
		$gross_income=$_POST['gross_income'];
		$industry=$_POST['industry'];
		$sql_insert2="insert into Business_Customer values('".$username."','".$type.
			"','".$industry."',".$gross_income.")";
		mysql_query($sql_insert2,$link);
	}else{
		$gender=$_POST['gender'];
		$marriage_status=$_POST['marriage_status'];
		$age=$_POST['age'];		
		$income=$_POST['income'];

		if($income==null){
			$income=0;
		}
		$sql_insert2="insert into Home_Customer values('".$username."','".$type.
			"','".$marriage_status."','".$gender."',".$age.",".$income.")";
		//var_dump($sql_insert2);
		mysql_query($sql_insert2,$link);	
	}
	mysql_close($link);
	session_start();
	$_SESSION['login']=true;
	$_SESSION['userName']=$username;
	Header("Location: welcomePage.php");
	exit;
?>