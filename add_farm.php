<?php 
include 'db/dbcon.php';
error_reporting(0);

	$farm_name		 	= $_POST['farm_name'];
	$farm_id		 	= $_POST['farm_id'];
	$opt 				= $_POST['opt'];
	
if($opt=="update")
{
	$insertSQL = "Update farm set farm_name = '$farm_name' where farm_id = '$farm_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated');</script>";
	echo "<script>window.location='farm.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	
	 $insertSQL = "INSERT INTO farm(farm_name) 
			VALUES('$farm_name')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
	
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='farm.php'</script>";   

}		
?>