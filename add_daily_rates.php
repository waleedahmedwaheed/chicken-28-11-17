<?php 
include 'db/dbcon.php';
error_reporting(0);
	
	$shop_id		 	= $_POST['shop_id'];
	
	$cur_date 			= $_POST['cur_date'];		
	
	$sale_rate			= $_POST['sale_rate'];
	$mr_rate 			= $_POST['mr_rate'];
	
	$mr_id			 	= $_POST['mr_id'];
	
	$opt 				= $_POST['opt'];
	
	

if($opt=="update")
{			
	$insertSQL = "Update daily_rates set sale_rate = '$sale_rate',mr_rate = '$mr_rate',shop_id='$shop_id',
	cur_date='$cur_date', `server_mr_id` = null, upload = 1
	where mr_id = '$mr_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
	echo "<script>window.location='daily_rates.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	

	$getSQL = "select * from daily_rates where cur_date = '".$cur_date."' and shop_id = '".$shop_id."' ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			echo "<script type='text/javascript'>alert('Rates of this shop already added!');</script>";
			echo "<script>window.location='daily_rates.php'</script>";
		}
		else
		{
	   $insertSQL = "INSERT INTO daily_rates
	 (sale_rate,mr_rate,cur_date,shop_id) 
			VALUES('$sale_rate','$mr_rate','$cur_date','$shop_id')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='daily_rates.php'</script>";   
		}
}		
?>