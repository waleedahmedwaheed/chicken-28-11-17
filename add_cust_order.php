<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);
	
	$cust_id		 	= $_POST['cust_id'];
	$s_shop_id		 	= get_title(shop_head,1,$dbconfig);
	$co_date   			= $_POST['co_date']; 
	$co_id		   		= $_POST['co_id']; 
	$co_datetime		= date('Y-m-d h:i:s');
	
	 
	$opt 				= $_POST['opt'];
	
	  
if($opt=="update")
{
	$insertSQL = "Update cust_order set cust_id = '$cust_id',co_date='$co_date' 
	where co_id = '$co_id' and co_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='cust_order.php'</script>";
		 
}
else
{	
	
		$getSQL = "select * from cust_order where co_status = '0'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			echo "<script type='text/javascript'>alert('Please finalized already added order');</script>";
			echo "<script>window.location='cust_order.php'</script>";   
		
		}
		else
		{
			
	 $insertSQL = "INSERT INTO cust_order
	 (cust_id,co_date,co_datetime,shop_id) 
			VALUES('$cust_id','$co_date','$co_datetime','$s_shop_id')"; 
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='cust_order.php'</script>";   
		
		}		
		 
		
}		
?>