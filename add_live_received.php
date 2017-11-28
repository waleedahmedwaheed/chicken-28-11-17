<?php 
include 'db/dbcon.php';
//include 'functions.php';
error_reporting(0);

	    $tr_id 	= $_POST['tr_id'];
	 
	    $insertSQL = "CALL `update_live_rcv`($tr_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_live_transfer`($tr_id,4)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		 
		
	
			echo "<script type='text/javascript'>alert('Records has been updated in stock!');</script>";
			echo "<script>window.location='live_rcv.php'</script>";   

		 
?>