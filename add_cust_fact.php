<?php 
include 'db/dbcon.php';
//error_reporting(0);


	$cust_id 		= $_POST['cust_id'];
	$prod_id 		= $_POST['prod_id'];
	$mandi_fact 	= $_POST['mandi_fact'];
	
	if($mandi_fact=="")
	{
		$mandi_fact = 0;
	}
	
	$other		 	= $_POST['other'];
	
	if($other=="")
	{
		$other = 0;
	}
	
	$cust_status	= $_POST['cust_status'];
		
	$fact_id		 	= $_POST['fact_id'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{	
	   
		$insertSQL = "Update cust_factor set cust_id = '$cust_id',prod_id = '$prod_id',mandi_fact='$mandi_fact',other = '$other'
	where fact_id = '$fact_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	 
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='cust_factor.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{		
		
			$getSQL = "select * from cust_factor where cust_id = '".$cust_id."'and prod_id = '".$prod_id."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			echo "<script type='text/javascript'>alert('Already added factor!');</script>";
			echo "<script>window.location='cust_factor.php'</script>";   
		}
		else
		{
	     $insertSQL = "INSERT INTO cust_factor(cust_id,prod_id,mandi_fact,other)
			VALUES('$cust_id','$prod_id','$mandi_fact','$other')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
	
		echo "<script type='text/javascript'>alert('Successfully added factor!');</script>";
		echo "<script>window.location='cust_factor.php'</script>";   
		}
}		
?>