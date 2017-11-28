<?php 
include 'db/dbcon.php';
include("functions.php");
error_reporting(0);

	$s_qty			 	= $_POST['s_qty'];
	$s_weight		 	= $_POST['s_weight'];
	 
	$ppr_id			 	= $_POST['ppr_id'];
	$prod_id		 	= $_POST['prod_id'];
	
	 $avl_qty 			= get_stock(qty,get_title(shop_head,1),$prod_id,$dbconfig); 
	 $avl_weight 		= get_stock(weight,get_title(shop_head,1),$prod_id,$dbconfig);
	
	//$shop_id			= get_title(shop_head,1);	
	
		 $getSQL = "select * from ppr_products where prod_id = '".$prod_id."' and ppr_id = '".$ppr_id."' ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			if(($avl_qty < $s_qty) or ($avl_weight < $s_weight))
			{
				echo "<span style='color:red;'>Out of Stock</span>";
			}
			else
			{
			$insertSQL = "Update ppr_products set s_qty = '$s_qty',s_weight = '$s_weight',pprp_status = 3  
			where prod_id = '".$prod_id."' and ppr_id = '".$ppr_id."'";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
			echo "<span style='color:green;'>Product Updated</span>";
			}
		}
		
		else
		{
			
			if(($avl_qty < $s_qty) or ($avl_weight < $s_weight))
			{
				echo "<span style='color:red;'>Out of Stock</span>";
			}
			else
			{
	     $insertSQL = "INSERT INTO ppr_products(s_qty,s_weight,ppr_id,prod_id) 
			VALUES('$s_qty','$s_weight','$ppr_id','$prod_id')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
			echo "<span style='color:green;'>Product Added</span>";
 		//echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";	
		//echo "<script>window.location='product.php'</script>";   
			}
		}

		

?>