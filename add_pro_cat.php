<?php 
include 'db/dbcon.php';
error_reporting(0);

	$pcat_desc		 	= $_POST['pcat_desc'];
	$pcat_id		 	= $_POST['pcat_id'];
	$pcat_status	 	= $_POST['pcat_status'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{
	$insertSQL = "Update product_category set pcat_desc = '$pcat_desc',pcat_status='$pcat_status'
	where pcat_id = '$pcat_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
	echo "<script>window.location='product_cat.php'</script>";		
 
}

else
{	
	 $insertSQL = "INSERT INTO product_category(pcat_desc) 
			VALUES('$pcat_desc')";
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
		echo "<script>window.location='product_cat.php'</script>";   


}		

?>