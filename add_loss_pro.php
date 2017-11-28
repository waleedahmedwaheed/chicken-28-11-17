<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);

	$loss_id			 	= $_POST['loss_id'];
	 
	 $insertSQL = "CALL `loss_insert`($loss_id)";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	$insertSQL = "CALL `loss_update`($loss_id)";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

		echo "<script type='text/javascript'>alert('Loss has been added to stock!');</script>";
		echo "<script>window.location='loss.php'</script>";  

	 
		
?>