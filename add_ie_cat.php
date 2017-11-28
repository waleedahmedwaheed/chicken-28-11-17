<?php 
include 'db/dbcon.php';
error_reporting(0);

	$ie_type		 	= $_POST['ie_type'];
	$iecat_id		 	= $_POST['iecat_id'];
	$ie_status	 		= $_POST['ie_status'];
	$ie_desc		 	= $_POST['ie_desc'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{
	$insertSQL = "Update ie_cat set ie_type = '$ie_type',ie_desc = '$ie_desc',ie_status='$ie_status'
	where iecat_id = '$iecat_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='ie_cat.php'</script>";		
 
}

else
{	
	 $insertSQL = "INSERT INTO ie_cat(ie_type,ie_desc) 
			VALUES('$ie_type','$ie_desc')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
	
		/*echo "
			<script>
		 (function () {
		 
                Lobibox.alert('success', {
                    msg: 'Product Successfully Added!'
                });
           
           
			 })();
		</script>	
		
			";*/
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";	
		echo "<script>window.location='ie_cat.php'</script>";   


}		

?>