<?php 
include 'db/dbcon.php';
include("functions.php");
error_reporting(0);

	$r_qty			 	= $_POST['s_qty'];
	$r_weight		 	= $_POST['s_weight'];
	 
	$tr_id				= $_POST['tr_id'];
	$prod_id		 	= 9999;
	
	$rcv_datetime		= date('Y-m-d h:i:s');
	
	
		 $getSQL = "select * from live_transfer where tr_id = '".$tr_id."' ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		
		$s_qty 		= $rowg["s_qty"];
		$s_weight 	= $rowg["s_weight"];
		
		
		if($rowg>0)
		{
			 
			 if(($r_qty <= $s_qty) and ($r_weight <= $s_weight))
			 {
				 $insertSQL = "Update live_transfer set r_qty = '$r_qty',r_weight = '$r_weight', tr_status = 3 , rcv_datetime = '$rcv_datetime'  
				where tr_id = '".$tr_id."' and tr_status = 1";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
				echo "<script type='text/javascript'>alert('Record Verified');</script>";
				echo "<script>window.location='live_rcv.php'</script>"; 
			 }
			 else
			 {
				echo "<script type='text/javascript'>alert('Record Not Verified');</script>";
				echo "<script>window.location='live_rcv_detail.php?tr_id=$tr_id'</script>"; 
			 }
		}
		
	 

		

?>