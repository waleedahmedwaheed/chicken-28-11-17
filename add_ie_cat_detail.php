<?php 
include 'db/dbcon.php';
error_reporting(0);

	$ie_date		 	= $_POST['ie_date'];
	$iecat_id		 	= $_POST['iecat_id'];
	$ie_dstatus	 		= $_POST['ie_dstatus'];
	$ie_amount		 	= $_POST['ie_amount'];
	$ie_id			 	= $_POST['ie_id'];
	$shop_id		 	= $_POST['shop_id'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{
	$insertSQL = "Update ie_detail set ie_date = '$ie_date',ie_amount = '$ie_amount',iecat_id='$iecat_id'
	where ie_id = '$ie_id' and ie_dstatus = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Updated!');</script>";
	echo "<script>window.location='ie_cat_detail.php'</script>";		
 
}

else
{	
	 $insertSQL = "INSERT INTO ie_detail(ie_date,ie_amount,iecat_id,shop_id) 
			VALUES('$ie_date','$ie_amount','$iecat_id','$shop_id')";
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
		echo "<script>window.location='ie_cat_detail.php'</script>";   


}		

?>