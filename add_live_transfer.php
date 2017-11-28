<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);
	
	$shop_id		 	= $_POST['shop_id'];
	$s_qty			 	= $_POST['s_qty'];
	$s_weight		 	= $_POST['s_weight'];
	$s_shop_id		 	= $_POST['s_shop_id'];
	$tr_datetime		= date('Y-m-d h:i:s');
	
	$tr_id		   		= $_POST['tr_id']; 
	
	$avl_qty 			= get_stock(qty,get_title(shop_head,1),9999,$dbconfig); 
	$avl_weight 		= get_stock(weight,get_title(shop_head,1),9999,$dbconfig);
	 
	$opt 				= $_POST['opt'];
	
	  
if($opt=="update")
{	
	if(($avl_qty < $s_qty) or ($avl_weight < $s_weight))
			{
				echo "<script type='text/javascript'>alert('Out of Stock');</script>";
				echo "<script>window.location='live_transfer.php'</script>";  
			}
			else
			{
	$insertSQL = "Update live_transfer set shop_id = '$shop_id',s_qty = '$s_qty' , s_weight = '$s_weight'
	where tr_id = '$tr_id' and tr_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='live_transfer.php'</script>";
			}
	
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	
	
		$getSQL = "select * from live_transfer where tr_status = '0'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			echo "<script type='text/javascript'>alert('Please finalized already added record');</script>";
			echo "<script>window.location='live_transfer.php'</script>";   
		
		}
		else
		{
			
			if(($avl_qty < $s_qty) or ($avl_weight < $s_weight))
			{
				echo "<script type='text/javascript'>alert('Out of Stock');</script>";
				echo "<script>window.location='live_transfer.php'</script>";   
			}
			else
			{
			
	 $insertSQL = "INSERT INTO live_transfer
	 (s_qty,s_weight,shop_id,s_shop_id,tr_datetime) 
			VALUES('$s_qty','$s_weight','$shop_id','$s_shop_id','$tr_datetime')"; 
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='live_transfer.php'</script>";   
			}
		}		
		 
		
}		
?>