<?php 
include 'db/dbcon.php';
include("functions.php");
error_reporting(0);

	$r_qty			 	= $_POST['s_qty'];
	$r_weight		 	= $_POST['s_weight'];
	 
	$pprp_id			= $_POST['pprp_id'];
	$prod_id		 	= $_POST['prod_id'];
	
	
		 $getSQL = "select * from ppr_products where prod_id = '".$prod_id."' and pprp_id = '".$pprp_id."' ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		
		$s_qty 		= $rowg["s_qty"];
		$s_weight 	= $rowg["s_weight"];
		$ppr_id 	= $rowg["ppr_id"];
		
		
		if($rowg>0)
		{
			 
			 if(($r_qty <= $s_qty) and ($r_weight <= $s_weight))
			 {
				 $insertSQL = "Update ppr_products set r_qty = '$r_qty',r_weight = '$r_weight', pprp_status = 3  
				where prod_id = '".$prod_id."' and pprp_id = '".$pprp_id."' and pprp_status = 1";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
				echo "<span style='color:green;'>Record Verified</span>";
				echo "<script>window.location='prod_rcv_detail.php?ppr_id=$ppr_id'</script>"; 
			 }
			 else
			 {
				echo "<span style='color:red;'>Invalid Input</span>";
			 }
		}
		
	 

		

?>