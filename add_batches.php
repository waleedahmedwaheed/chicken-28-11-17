<?php 
include 'db/dbcon.php';
error_reporting(0);
	
	 
	 
	$pb_id			 	= $_POST['pb_id'];
	$pb_qty			 	= $_POST['pb_qty'];
	$pb_weight			= $_POST['pb_weight'];
	$pro_id				= $_POST['pro_id'];
	$pb_datetime		= date('Y-m-d h:i:s');
	
	$opt 				= $_POST['opt'];
	
	

if($opt=="update")
{
	$insertSQL = "Update production_batches set pb_qty='$pb_qty',pb_weight='$pb_weight'
	where pb_id = '$pb_id' and pb_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='batches.php?pro_id=$pro_id'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	

	/*$getSQL = "select * from purchase where pro_date = '".$pro_date."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			echo "<script type='text/javascript'>alert('Purchase of this date already added!');</script>";
		echo "<script>window.location='purchase.php'</script>";
		}
		else
		{*/
	
	 $insertSQL = "INSERT INTO production_batches
	 (pb_qty,pb_weight,pro_id,pb_datetime) 
			VALUES('$pb_qty','$pb_weight','$pro_id','$pb_datetime')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='batches.php?pro_id=$pro_id'</script>";   
		//}
}		
?>