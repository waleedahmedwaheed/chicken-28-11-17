<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);
	
	$shop_id		 	= get_title(shop_head,1,$dbconfig);
	
	$pro_date   		= $_POST['pro_date']; 
	
	$pur_from		 	= $_POST['pur_from'];
	 
	$daily_rate 		= $_POST['daily_rate'];
	
	$pro_id			 	= $_POST['pro_id'];
	$pr_qty			 	= $_POST['pr_qty'];
	$pr_weight			= $_POST['pr_weight'];
	$dress_weight		= $_POST['dress_weight'];
	$perc				= $_POST['perc'];
	$pro_datetime		= date('Y-m-d h:i:s');
 
	$opt 				= $_POST['opt'];
	
	$live_qty 			= get_stock(live_qty,get_title(shop_head,1,$dbconfig),9999);
	$live_weight		= get_stock(live_weight,get_title(shop_head,1,$dbconfig),9999);
	
	//echo $live_qty;
	//echo $live_weight;
	
	
	

if($opt=="update")
{
	$insertSQL = "Update production set daily_rate = '$daily_rate',pro_date='$pro_date',pr_qty='$pr_qty',pr_weight='$pr_weight',dress_weight='$dress_weight',perc='$perc'
	where pro_id = '$pro_id' and pro_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='production.php'</script>";
		
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
	
	if(($pr_qty <= $live_qty) and ($pr_weight <= $live_weight))
		{
			
			$getSQL = "select * from production where pro_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			echo "<script type='text/javascript'>alert('Finalize previous production!');</script>";
		echo "<script>window.location='production.php'</script>";
		}
		else
		{
			
	 $insertSQL = "INSERT INTO production
	 (pro_date,daily_rate,pr_qty,pr_weight,shop_id,dress_weight,pro_datetime,perc) 
			VALUES('$pro_date','$daily_rate','$pr_qty','$pr_weight','$shop_id','$dress_weight','$pro_datetime','$perc')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='production.php'</script>";   
		}
		}
		
		else
		{
		echo "<script type='text/javascript'>alert('Out of Stock');</script>";
		echo "<script>window.location='production.php'</script>";   			
		}
		
}		
?>