<?php 
include 'db/dbcon.php';
//include 'functions.php';
error_reporting(0);

	    $ppr_id 	= $_POST['ppr_id'];
	 
	    $insertSQL = "CALL `update_processed_bef_loss`($ppr_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_processed_loss`($ppr_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_prod_processed`($ppr_id,2)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `update_ppr_products`($ppr_id,2)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

	 
	
			echo "<script type='text/javascript'>alert('Records has been updated in stock!');</script>";
			echo "<script>window.location='prod_dispatch.php'</script>";   

		 
?>