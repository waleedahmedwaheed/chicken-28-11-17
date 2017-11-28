<?php 
include 'db/dbcon.php';
include 'functions.php';
//error_reporting(0);
	
	date_default_timezone_set("Asia/Karachi"); 
	$cod_datetime		= date("Y-m-d H:i:s");
	$sdate 				= date("Y-m-d");
	
	$co_id			 	= $_POST['co_id'];
	$prod_id		 	= $_POST['prod_id'];
	$co_qty			 	= $_POST['co_qty'];
	$co_weight		 	= $_POST['co_weight'];
	$rv_qty			 	= $_POST['rv_qty'];
	$rv_weight		 	= $_POST['rv_weight'];
	$cod_id			 	= $_POST['cod_id'];
	
	 
				 
				
					if(($co_qty < $rv_qty) or ($co_weight < $rv_weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
						else
							{
							
					 
								 $qrysu = "update cust_order_detail set rv_qty = $rv_qty, rv_weight = $rv_weight , cod_status = 3
								 where cod_id='$cod_id' and prod_id='$prod_id' and co_id = '$co_id'";
								 mysql_query($qrysu);
								 echo "<script type='text/javascript'>alert('Product Successfully Verified');</script>";
								 echo "<script type='text/javascript'>window.location='cust_order_prod.php?co_id=$co_id';</script>";
								 
								
							}
				 
		 
		
		 

?>