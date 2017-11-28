<?php 
include 'db/dbcon.php';
include 'functions.php';
//error_reporting(0);
	
	date_default_timezone_set("Asia/Karachi"); 
	$cod_datetime		= date("Y-m-d H:i:s");
	$sdate 				= date("Y-m-d");
	
	$co_id			 	= $_POST['co_id'];
	$shop_id		 	= $_POST['shop_id'];
	$prod_id		 	= $_POST['prod_id'];
	$co_qty			 	= $_POST['co_qty']; if($co_qty==""){ $co_qty = 0; }
	$co_weight		 	= $_POST['co_weight'];
	$opt			 	= $_POST['opt'];
	$cod_id			 	= $_POST['cod_id'];
	
	//$price			 	= $_POST['price'];
	 
	
	//exit; 
	
	 if($opt=="update")
	{
		
				if($prod_id == 9999)
				{
					$st_qty 			= get_stock(live_qty,$shop_id,9999,$dbconfig);
					$st_weight			= get_stock(live_weight,$shop_id,9999,$dbconfig);
				}
				else
				{
					$st_qty 			= get_stock(qty,$shop_id,$prod_id,$dbconfig);
					$st_weight			= get_stock(weight,$shop_id,$prod_id,$dbconfig);
				}
				
					if(($st_qty < $co_qty) or ($st_weight < $co_weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
						else
							{
							
							if($prod_id==9999)
							{
								$factor				= factor(factor,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
								if($factor>0)
								{
									$get_price  = (get_mandirate(mr_rate,$shop_id,$sdate,$dbconfig) * factor(mandi_fact,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig)) + factor(other,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
								}
								else
								{
									$get_price  = get_price(sale_price,$prod_id,$shop_id,$sdate,$dbconfig); 
								}
							}
							else
							{
								$factor				= factor(factor,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
								if($factor>0)
								{
									$get_price  = (get_mandirate(mr_rate,$shop_id,$sdate,$dbconfig) * factor(mandi_fact,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig)) + factor(other,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
								}
								else
								{
									$get_price  = get_price(sale_price,$prod_id,$shop_id,$sdate,$dbconfig); 
								}
							}
								$price 		= $co_weight * $get_price;
								
							if($price <= 0)
								{
									echo "<script type='text/javascript'>alert('Price not added');</script>";
								}	
							else
								{
								 $qrysu = "update cust_order_detail set co_qty = $co_qty, co_weight = $co_weight , prod_price = $price , price = '$get_price'
								 ,prod_id='$prod_id'
								 where cod_id='$cod_id' and co_id = '$co_id'";
								 mysql_query($qrysu);
								 echo "<script type='text/javascript'>alert('Product Successfully Updated');</script>";
								 echo "<script type='text/javascript'>window.location='cust_order_prod.php?co_id=$co_id';</script>";
								 
								}
							}
				 
		 
		
		
	}
	
	/////////////////////////////////////////else after update/////////////////////////////////////////////////////////////////
	
	else	
	{ 
		
		 
			 
			//////////////////////////////already added update///////////////////////
		 
				if($prod_id == 9999)
				{
					$st_qty 			= get_stock(live_qty,$shop_id,9999,$dbconfig);
					$st_weight			= get_stock(live_weight,$shop_id,9999,$dbconfig);
				}
				else
				{
					$st_qty 			= get_stock(qty,$shop_id,$prod_id,$dbconfig);
					$st_weight			= get_stock(weight,$shop_id,$prod_id,$dbconfig);
				}
				
					if(($st_qty < $co_qty) or ($st_weight < $co_weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
						else
							{
								
				if($prod_id==9999)
				{
					$factor				= factor(factor,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
					if($factor>0)
					{
						$get_price  = (get_mandirate(mr_rate,$shop_id,$sdate,$dbconfig) * factor(mandi_fact,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig)) + factor(other,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
					}
					else
					{
						$get_price  = get_mandirate(sale_rate,$shop_id,$sdate,$dbconfig);
					}
				}
				else
				{
					$factor				= factor(factor,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
					if($factor>0)
					{
						$get_price  = (get_mandirate(mr_rate,$shop_id,$sdate,$dbconfig) * factor(mandi_fact,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig)) + factor(other,get_title(cust_id_co,$co_id,$dbconfig),$prod_id,$dbconfig);
					}
					else
					{
						$get_price  = get_price(sale_price,$prod_id,$shop_id,$sdate,$dbconfig); 
					}
				}
					$price 		= $co_weight * $get_price;
				 
			 
			
				if($price <= 0)
				{
					echo "<script type='text/javascript'>alert('Price not added');</script>";
				}
				else
				{
			
			$insertSQL = "INSERT INTO cust_order_detail(co_id,prod_id,co_qty,co_weight,cod_datetime,prod_price,price) 
					VALUES('$co_id','$prod_id','$co_qty','$co_weight','$cod_datetime','$price','$get_price')";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
			
				 
				echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";	
				echo "<script type='text/javascript'>window.location='cust_order_prod.php?co_id=$co_id';</script>";   
		
				}
							}
	}
	 

//}		

?>