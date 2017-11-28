<?php 
include 'db/dbcon.php';
error_reporting(0);

	 
	$old_password 	= $_POST['old_password'];
	$new_password 	= $_POST['new_password'];
		
	$user_id		 	= $_POST['user_id'];
	 

 
		  $pass=md5($old_password);
		$salt="a1Bz20ydqelm8m1wql";
		$pass=$salt.$pass;
		
	$query="select * from user where password='$pass' and status = '0'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($query, $dbconfig) or die(mysql_error());
	$row=mysql_fetch_assoc($Result1);
		
		if($row>0)
		{
			$passn=md5($new_password);
			$saltn="a1Bz20ydqelm8m1wql";
			$passn=$saltn.$passn;
		
		$insertSQL = "Update user set password = '$passn' where user_id = '$user_id'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		echo "<script type='text/javascript'>alert('Password Successfully Updated!');</script>";
		echo "<script type='text/javascript'> window.location='change_pass.php' </script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Old Password is not correct');</script>";
		}
	  
	
	
	//echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	//echo "<script>window.location='user.php'</script>";
		
	//
 
?>