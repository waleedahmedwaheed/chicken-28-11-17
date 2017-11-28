<?php 
include 'db/dbcon.php';
error_reporting(0);

	$pur_price		 	= $_POST['pur_price'];
	$sale_price		 	= $_POST['sale_price'];
	//$ws_price		 	= $_POST['ws_price'];
	//$sup_price		 	= $_POST['sup_price'];
	$r_date			 	= $_POST['r_date'];
	$shop_id		 	= $_POST['shop_id'];
	$prod_id		 	= $_POST['prod_id'];
	 
	
		$getSQL = "select * from rates where prod_id = '".$prod_id."' and shop_id = '".$shop_id."' and r_date='".$r_date."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			//$insertSQL = "Update rates set  sale_price = '$sale_price',ws_price = '$ws_price' 
			//where prod_id = '".$prod_id."' and shop_id = '".$shop_id."'";
			$insertSQL = "Update rates set  sale_price = '$sale_price'
			where prod_id = '".$prod_id."' and shop_id = '".$shop_id."'";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
			echo "<span style='color:green;'>Rate Updated</span>";
		}
		
		else
		{
			
	  // $insertSQL = "INSERT INTO rates(shop_id,r_date,prod_id,sale_price,ws_price ) 
			//VALUES('$shop_id','$r_date','$prod_id' ,'$sale_price','$ws_price' )";
			$insertSQL = "INSERT INTO rates(shop_id,r_date,prod_id,sale_price) 
			VALUES('$shop_id','$r_date','$prod_id' ,'$sale_price' )";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
			echo "<span style='color:green;'>Rate Added</span>";
 		//echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";	
		//echo "<script>window.location='product.php'</script>";   
		
		}

		

?>