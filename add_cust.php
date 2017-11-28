<?php 
include 'db/dbcon.php';
error_reporting(0);


	$cust_name 		= $_POST['cust_name'];
	$cust_contact 	= $_POST['cust_contact'];
	$cust_address 	= $_POST['cust_address'];
	$cust_status	= $_POST['cust_status'];
	$auth_person	= $_POST['auth_person'];
		
	$cust_id		 	= $_POST['cust_id'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{	
	   
		$insertSQL = "Update customer set cust_name = '$cust_name',cust_contact = '$cust_contact',cust_address='$cust_address',cust_status='$cust_status',
		auth_person = '$auth_person'
	where cust_id = '$cust_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	 
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='cust.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	
	  $insertSQL = "INSERT INTO customer(cust_name,cust_contact,cust_address,auth_person)
			VALUES('$cust_name','$cust_contact','$cust_address','$auth_person')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
	
		echo "<script type='text/javascript'>alert('Successfully added new customer!');</script>";
		echo "<script>window.location='cust.php'</script>";   

}		
?>