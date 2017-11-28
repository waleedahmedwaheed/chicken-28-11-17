<?php 
include 'db/dbcon.php';
error_reporting(0);

	$shop_name		 	= $_POST['shop_name'];
	$shop_address 		= $_POST['shop_address'];
	$shop_contact 		= $_POST['shop_contact'];
	$shop_id		 	= $_POST['shop_id'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{
	$insertSQL = "Update shop set shop_name = '$shop_name',shop_address = '$shop_address',shop_contact = '$shop_contact'
	where shop_id = '$shop_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
	echo "<script>window.location='shop.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	
	 $insertSQL = "INSERT INTO shop(shop_name,shop_address,shop_contact) 
			VALUES('$shop_name','$shop_address','$shop_contact')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
	
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='shop.php'</script>";   

}		
?>