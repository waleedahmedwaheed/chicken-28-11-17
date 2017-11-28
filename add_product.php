<?php 
include 'db/dbcon.php';
error_reporting(0);

	$prod_name		 	= $_POST['prod_name'];
	$prod_id		 	= $_POST['prod_id'];
	$prod_status	 	= $_POST['prod_status'];
	$pcat_id		 	= $_POST['pcat_id'];
	$prod_exp		 	= $_POST['prod_exp'];
	$prod_code		 	= $_POST['prod_code'];
	$opt 				= $_POST['opt'];

if($opt=="update")
{
	$insertSQL = "Update product set prod_name = '$prod_name',pcat_id = '$pcat_id',prod_status='$prod_status',prod_exp = '$prod_exp',prod_code='$prod_code'
	where prod_id = '$prod_id'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
	echo "<script>window.location='product.php'</script>";		
 
}

else
{	
	
	$getSQLp = "select * from product where prod_code = '".$prod_code."'";  
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultgp = mysql_query($getSQLp, $dbconfig) or die(mysql_error());	 
			$rowgp = mysql_fetch_assoc($Resultgp);
			if($rowgp>0)
			{
				echo "<script type='text/javascript'>alert('Product Code Already Added');</script>";	
				echo "<script>window.location='product.php'</script>"; 
			}
		else
		{
	 $insertSQL = "INSERT INTO product(prod_name,pcat_id,prod_exp,prod_code) 
			VALUES('$prod_name','$pcat_id','$prod_exp','$prod_code')";
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
		echo "<script>window.location='product.php'</script>";   
		}

}		

?>