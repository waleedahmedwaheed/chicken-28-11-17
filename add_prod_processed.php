<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);
	
	$shop_id		 	= $_POST['shop_id'];
	$s_shop_id		 	= get_title(shop_head,1,$dbconfig);
	
	$ppr_date   		= $_POST['ppr_date']; 
	$ppr_id		   		= $_POST['ppr_id']; 
	
	 
	$opt 				= $_POST['opt'];
	
	  
if($opt=="update")
{
	$insertSQL = "Update prod_processed set shop_id = '$shop_id',ppr_date='$ppr_date' 
	where ppr_id = '$ppr_id' and ppr_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='prod_processed.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	
	
		$getSQL = "select * from prod_processed where ppr_status = '0'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			echo "<script type='text/javascript'>alert('Please finalized already added record');</script>";
			echo "<script>window.location='prod_processed.php'</script>";   
		
		}
		else
		{
			
	 $insertSQL = "INSERT INTO prod_processed
	 (shop_id,ppr_date,s_shop_id) 
			VALUES('$shop_id','$ppr_date','$s_shop_id')"; 
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='prod_processed.php'</script>";   
		
		}		
		 
		
}		
?>