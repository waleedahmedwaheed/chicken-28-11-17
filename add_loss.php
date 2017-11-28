<?php 
include 'db/dbcon.php';
include 'functions.php';
//error_reporting(0);

date_default_timezone_set("Asia/Karachi"); 

	$loss_datetime		= date("Y-m-d H:i:s");
	$loss_qty	 		= $_POST['loss_qty'];
	$loss_weight	 	= $_POST['loss_weight'];
	$prod_id		 	= $_POST['prod_id'];
	$shop_id		 	= $_POST['shop_id'];
	$loss_id		 	= $_POST['loss_id'];
	 
	$opt 				= $_POST['opt'];
	 
	 
 if($opt=="update")
{	
	if($prod_id == 9999)
		{
			$st_qty 			= get_stock(live_qty,$shop_id,9999,$dbconfig);
			$st_weight			= get_stock(live_weight,$shop_id,9999,$dbconfig);
		}
		else
		{
			$st_qty 			= get_stock(qty,$shop_id,$prod_id,$dbconfig);
			$st_weight			= get_stock(weight,$shop_id,$prod_id,$dbconfig);
		}
		
			if(($st_qty < $loss_qty) or ($st_weight < $loss_weight))
		{		
			echo "<script type='text/javascript'>alert('Loss Quantity or Weight Exceeded than Stock Quantity & Weight');</script>";
		}
		else
		{
 	$insertSQL = "Update loss set loss_qty = '$loss_qty',loss_weight = '$loss_weight',shop_id = '$shop_id',prod_id='$prod_id'
	where loss_id = '$loss_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='loss.php'</script>"; 
		}
}
else
{	 
	
		if($prod_id == 9999)
		{
			$st_qty 			= get_stock(live_qty,$shop_id,9999,$dbconfig);
			$st_weight			= get_stock(live_weight,$shop_id,9999,$dbconfig);
		}
		else
		{
			$st_qty 			= get_stock(qty,$shop_id,$prod_id,$dbconfig);
			$st_weight			= get_stock(weight,$shop_id,$prod_id,$dbconfig);
		}
	
	if(($st_qty < $loss_qty) or ($st_weight < $loss_weight))
		{		
			echo "<script type='text/javascript'>alert('Loss Quantity or Weight Exceeded than Stock Quantity & Weight');</script>";
		}
		else
		{
			$insertSQL = "INSERT INTO loss(loss_qty,loss_weight,shop_id,prod_id,loss_datetime) 
			VALUES('$loss_qty','$loss_weight','$shop_id','$prod_id','$loss_datetime')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		//echo 'Loss Successfully Saved!';
		echo "<script>window.location='loss.php'</script>";   
		}
		
				
	 
	 

}		
?>