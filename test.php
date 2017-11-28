<?php 
include 'db/dbcon.php';
include 'functions.php';
//error_reporting(0);

	    //$ppr_id 	= $_POST['ppr_id'];
	 
	    
		echo $getSQL = "SELECT CASE WHEN 
( select s1.qty >= 300 and s1.weight >= 297 from 
(select (SUM(CASE WHEN st_inout = 0 THEN qty ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN qty ELSE 0 END)) as qty ,
 (SUM(CASE WHEN st_inout = 0 THEN weight ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN weight ELSE 0 END)) as weight
 from stock s where s.shop_id = 5 and s.prod_id = 9999 ) s1 )
  
THEN ( SELECT 'stockin' ) 
ELSE ( SELECT 'stockout' ) 
END";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$status = $rowg["CASE WHEN"];
	 
	
			//echo "<script type='text/javascript'>alert('Records has been updated in stock!');</script>";
			//echo "<script>window.location='prod_rcv.php'</script>";   

		 
?>