<?php 
include 'db/dbcon.php';
//include 'functions.php';
error_reporting(0);

	    $pro_id 	= $_POST['pro_id'];
	 
	    $insertSQL = "CALL `pro_stock`($pro_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `pro_stock_sub`($pro_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
		$insertSQL = "CALL `pro_update`($pro_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

		$insertSQL = "CALL `pb_update`($pro_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

		$insertSQL = "CALL `pp_update`($pro_id)";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
			echo "<script type='text/javascript'>alert('Production has been added to stock!');</script>";
			echo "<script>window.location='production.php'</script>";   

		 
?>