<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);

	$pur_id			 	= $_POST['pur_id'];
	 
	 $insertSQL = "CALL `PUR_INSERT`($pur_id)";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	$insertSQL = "CALL `pur_update`($pur_id)";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

		echo "<script type='text/javascript'>alert('Purchase has been added to stock!');</script>";
		echo "<script>window.location='purchase.php'</script>";  

	 
		
?>