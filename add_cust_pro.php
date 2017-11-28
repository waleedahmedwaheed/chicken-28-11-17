<?php 
include 'db/dbcon.php';
//include 'functions.php';
error_reporting(0);

	    $co_id 	= $_POST['co_id'];
	 
	    $insertSQL = "CALL `update_cust_pro`($co_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_cust_order`($co_id,1)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_cust_order_detail`($co_id,1)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

	 
	
			echo "<script type='text/javascript'>alert('Records has been updated in stock!');</script>";
			echo "<script>window.location='cust_order.php'</script>";   

		 
?>