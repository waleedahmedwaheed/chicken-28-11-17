<?php 
include 'db/dbcon.php';
include("functions.php");
error_reporting(0);

	$p_qty			 	= $_POST['p_qty'];
	$p_weight		 	= $_POST['p_weight'];
	 
	$pro_id			 	= $_POST['pro_id'];
	$prod_id		 	= $_POST['prod_id'];
	
	$shop_id			= get_title(shop_head,1,$dbconfig);	
	
		  $getSQL = "select * from production_prod where prod_id = '".$prod_id."' and pro_id = '".$pro_id."' ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			$insertSQL = "Update production_prod set p_qty = '$p_qty',p_weight = '$p_weight',pp_status = 0  
			where prod_id = '".$prod_id."' and pro_id = '".$pro_id."'";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
			echo "<span style='color:green;'>Product Updated</span>";
		}
		
		else
		{
			
	     $insertSQL = "INSERT INTO production_prod(prod_id,p_qty,p_weight,pro_id,shop_id) 
			VALUES('$prod_id','$p_qty','$p_weight','$pro_id','$shop_id')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
			echo "<span style='color:green;'>Product Added</span>";
 		//echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";	
		//echo "<script>window.location='product.php'</script>";   
		
		}

		

?>