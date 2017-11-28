<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);
$date 				= date("Y-m-d H:i:s");

	    $co_id 	= $_POST['co_id'];
	 
	    $insertSQL = "CALL `update_cust_received`($co_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_cust_order`($co_id,2)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error()); 
		
		$insertSQL = "CALL `update_cust_order_detail`($co_id,2)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error()); 
		
		$insertSQL = "update cust_order set rv_datetime = '$date' where co_id = $co_id";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$cust_order_amount = get_title(cust_order_amount,$co_id,$dbconfig);

		$insertSQL = "INSERT INTO cust_order_amount(co_id,co_amount) VALUES('$co_id','$cust_order_amount')";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	
	
			echo "<script type='text/javascript'>alert('Records has been updated in stock!');</script>";
			echo "<script>window.location='cust_order.php'</script>";   

		 
?>