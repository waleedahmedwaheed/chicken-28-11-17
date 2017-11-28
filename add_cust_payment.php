<?php 
include 'db/dbcon.php';
//include 'functions.php';
error_reporting(0);
	
	$cust_id		 	= $_POST['cust_id'];
	$cp_amount   		= $_POST['cp_amount']; 
	$shop_id   			= $_POST['shop_id']; 
	$u_id		   		= $_POST['user_id']; 
	$cp_id		   		= $_POST['cp_id']; 
	$cp_datetime		= date('Y-m-d h:i:s');
	
	$opt 				= $_POST['opt'];
	
	  
if($opt=="update")
{
	$insertSQL = "Update cust_paid set cp_amount = '$cp_amount',cust_id='$cust_id' 
	where cp_id = '$cp_id' and cp_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='cust_payment.php'</script>";
		 
}
else
{	
	
		$getSQL = "select * from cust_paid where cp_status = '0'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			echo "<script type='text/javascript'>alert('Please finalized already added payment');</script>";
			echo "<script>window.location='cust_payment.php'</script>";   
		
		}
		else
		{
			
	 $insertSQL = "INSERT INTO cust_paid
	 (cust_id,cp_amount,shop_id,cp_datetime,u_id) 
			VALUES('$cust_id','$cp_amount','$shop_id','$cp_datetime','$u_id')"; 
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='cust_payment.php'</script>";   
		
		}		
		 
		
}		
?>