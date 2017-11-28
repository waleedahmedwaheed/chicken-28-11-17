<?php 
include 'db/dbcon.php';
include 'functions.php';
error_reporting(0);
	
	date_default_timezone_set("Asia/Karachi"); 
	$date 				= date("Y-m-d H:i:s");
	$sdate 				= date("Y-m-d");
	
	$item_type		 	= $_POST['item_type'];
	$prod_id		 	= $_POST['prod_id'];
	$shop_id		 	= $_POST['shop_id'];
	$sales_no		 	= $_POST['sales_no'];
	$qty			 	= $_POST['qty'];  if($qty==""){	$qty = 0; }
	$weight			 	= $_POST['weight'];
	$opt			 	= $_POST['opt'];
	$sd_id			 	= $_POST['sd_id'];
	
	$price			 	= $_POST['price'];
	 
	
	//exit; 
	
	 if($opt=="update")
	{
		
		$sales_id = get_title(sales_sid,$sd_id,$dbconfig);
		 
		
		//////////////////////////////get stock////////////////////////////
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
			//////////////////////////////get stock////////////////////////////
				 $st_qty;  //echo "<br>";
				 $st_weight;  //echo "<br>";
			
			//////////////////////////////sale stock////////////////////////////
			 
				 $sale_qty	 			= sale_stock(qty,$sales_id,$prod_id,$dbconfig);  //echo "<br>";
				 $sale_weight			= sale_stock(weight,$sales_id,$prod_id,$dbconfig);  //echo "<br>";
			
			//////////////////////////////sale stock////////////////////////////
			
			//////////////////////////////available stock////////////////////////////
			
				 $avl_qty 		= $st_qty - $sale_qty; //echo "<br>";
				 $avl_weight 	= $st_weight - $sale_weight;
				//exit;
			//////////////////////////////available stock////////////////////////////
			
			
			//////////////////////////////item type////////////////////////////
			
			if($item_type==1)
			{
				if($prod_id==9999)
				{
					$get_price  = get_mandirate(sale_rate,$shop_id,$sdate,$dbconfig);
				}
				else
				{
					$get_price  = get_price(sale_price,$prod_id,$shop_id,$sdate,$dbconfig); 
				}
				$price 		= $weight * $get_price;
			}
			else if($item_type==2)
			{
				$get_price = get_price(ws_price,$prod_id,$shop_id,$sdate,$dbconfig);
				$price 		= $weight * $get_price;
			}
			else if($item_type==3)
			{
				//$get_price = get_price(sup_price,$prod_id,$shop_id,$sdate);
				//$price 		= $weight * $get_price;
			}
			else if($item_type==4)
			{
				//$get_price = get_price(sup_price,$prod_id,$shop_id,$sdate);
				//$price 		= $weight * $get_price;
			}
			
			//////////////////////////////item type////////////////////////////
	
			//////////////////////////check if exist//////////////////////////////////////
			
			/* $getSQLp = "select * from sales_detail where sales_no = '".$sales_no."' and prod_id = '".$prod_id."' and sd_status = 0";  
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultgp = mysql_query($getSQLp, $dbconfig) or die(mysql_error());	 
			$rowgp = mysql_fetch_assoc($Resultgp);
			
			$sd_id  = $rowgp["sd_id"];
			$qty_p  = $rowgp["qty"];
			$wgt_p   = $rowgp["weight"];
			
			$qty_p  = $qty_p + $qty;
			$wgt_p  = $wgt_p  + $weight; */
		
			//////////////////////////////already added update///////////////////////
		
			//if($rowgp>0)
				//{
					//echo $qty."<br>";
					//echo $weight;
					if(($st_qty < $qty) or ($st_weight < $weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
						else
							{
							
							if($price <= 0)
								{
									echo "<script type='text/javascript'>alert('Price not added');</script>";
								}	
							else
								{
								 $qrysu = "update sales_detail set qty = $qty, weight = $weight , price = $price
								 where sales_no='$sales_no' and prod_id='$prod_id' and sd_id = '$sd_id'";
								 mysql_query($qrysu);
								 echo "<script type='text/javascript'>alert('Product Successfully Updated');</script>";
								 echo "<script type='text/javascript'>window.location='sales.php?it_id=$item_type';</script>";
								 
								}
							}
				/* }
			else
				{
				/////////////////////price///////////////////////
					if(($avl_qty < $qty) or ($avl_weight < $weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
					else
							{
							
							if($price <= 0)
							{
								echo "<script type='text/javascript'>alert('Price not added');</script>";
							}
							
							else
							{
						$insertSQL = "INSERT INTO sales_detail(sales_id,prod_id,qty,weight,price,sd_date,sales_no) 
								VALUES('$sales_id','$prod_id','$qty','$weight','$price','$sdate','$sales_no')";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
						echo "<script type='text/javascript'>alert('Product Successfully Added!');</script>";	
							}
							}

				} */
				
		 
		
		
	}
	
	/////////////////////////////////////////else after update/////////////////////////////////////////////////////////////////
	
	else	
	{ 
		
		
		
		$getSQL = "select * from sales where sales_no = '".$sales_no."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			
			$sales_id = get_title(sales_id,$sales_no);
			
			//////////////////////////////get stock////////////////////////////
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
			//////////////////////////////get stock////////////////////////////
				//echo $st_qty;  echo "<br>";
				//echo $st_weight;  echo "<br>";
			
			//////////////////////////////sale stock////////////////////////////
			 
				 $sale_qty	 			= sale_stock(qty,$sales_id,$prod_id,$dbconfig);  //echo "<br>";
				 $sale_weight			= sale_stock(weight,$sales_id,$prod_id,$dbconfig);  //echo "<br>";
			
			//////////////////////////////sale stock////////////////////////////
			
			//////////////////////////////available stock////////////////////////////
			
				 $avl_qty 		= $st_qty - $sale_qty; //echo "<br>";
				 $avl_weight 	= $st_weight - $sale_weight;
				//exit;
			//////////////////////////////available stock////////////////////////////
			
			
			//////////////////////////////item type////////////////////////////
			
			if($item_type==1)
			{
				if($prod_id==9999)
				{
					$get_price  = get_mandirate(sale_rate,$shop_id,$sdate,$dbconfig);
				}
				else
				{
					$get_price  = get_price(sale_price,$prod_id,$shop_id,$sdate,$dbconfig); 
				}
				$price 		= $weight * $get_price;
			}
			else if($item_type==2)
			{
				$get_price = get_price(ws_price,$prod_id,$shop_id,$sdate,$dbconfig);
				$price 		= $weight * $get_price;
			}
			else if($item_type==3)
			{
				//$get_price = get_price(sup_price,$prod_id,$shop_id,$sdate);
				//$price 		= $weight * $get_price;
			}
			else if($item_type==4)
			{
				//$get_price = get_price(sup_price,$prod_id,$shop_id,$sdate);
				//$price 		= $weight * $get_price;
			}
			
			//////////////////////////////item type////////////////////////////
	
			//////////////////////////check if exist//////////////////////////////////////
			
			$getSQLp = "select * from sales_detail where sales_no = '".$sales_no."' and prod_id = '".$prod_id."' and sd_status = 0";  
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultgp = mysql_query($getSQLp, $dbconfig) or die(mysql_error());	 
			$rowgp = mysql_fetch_assoc($Resultgp);
			
			$sd_id  = $rowgp["sd_id"];
			$qty_p  = $rowgp["qty"];
			$wgt_p   = $rowgp["weight"];
			
			$qty_p  = $qty_p + $qty;
			$wgt_p  = $wgt_p  + $weight;
		
			//////////////////////////////already added update///////////////////////
		
			if($rowgp>0)
				{
					
					if(($avl_qty < $qty) or ($avl_weight < $weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
						else
							{
							
							if($price <= 0)
								{
									echo "<script type='text/javascript'>alert('Price not added');</script>";
								}	
							else
								{
								 $qrysu = "update sales_detail set qty = $qty_p, weight = $wgt_p , price = $price
								 where sales_no='$sales_no' and prod_id='$prod_id' and sd_id = '$sd_id'";
								 mysql_query($qrysu);
								 echo "<script type='text/javascript'>alert('Product Successfully Updated');</script>";
								}
							}
				}
			else
				{
				/////////////////////price///////////////////////
					if(($avl_qty < $qty) or ($avl_weight < $weight))
							{		
								echo "<script type='text/javascript'>alert('Out of Stock');</script>";
							}
					else
							{
							
							if($price <= 0)
							{
								echo "<script type='text/javascript'>alert('Price not added');</script>";
							}
							
							else
							{
						$insertSQL = "INSERT INTO sales_detail(sales_id,prod_id,qty,weight,price,sd_date,sales_no) 
								VALUES('$sales_id','$prod_id','$qty','$weight','$price','$sdate','$sales_no')";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
		
						echo "<script type='text/javascript'>alert('Product Successfully Added!');</script>";	
							}
							}

				} 
		}
		
		
		//////////////////////////if not exist////////////////////////////////////
		
		else
		{	
		
	$insertSQL = "INSERT INTO sales(item_type,shop_id,date_added,sales_no) 
			VALUES('$item_type','$shop_id','$date','$sales_no')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		
	$sales_id = get_title(sales_id,$sales_no,$dbconfig);
	
	if($item_type==1)
	{
		if($prod_id==9999)
		{
			$get_price  = get_mandirate(sale_rate,$shop_id,$sdate,$dbconfig);
		}
		else
		{
			$get_price  = get_price(sale_price,$prod_id,$shop_id,$sdate,$dbconfig); 
		}
		$price 		= $weight * $get_price;
	}
	else if($item_type==2)
	{
		$get_price = get_price(ws_price,$prod_id,$shop_id,$sdate,$dbconfig);
		$price 		= $weight * $get_price;
	}
	else if($item_type==3)
	{
		$get_price = get_price(sup_price,$prod_id,$shop_id,$sdate,$dbconfig);
		$price 		= $weight * $get_price;
	}
	else if($item_type==4)
	{
		//$get_price = get_price(sup_price,$prod_id,$shop_id,$sdate);
		//$price 		= $weight * $get_price;
	}
	
	if($price <= 0)
	{
		echo "<script type='text/javascript'>alert('Price not added');</script>";
	}
	else
	{
	
	$insertSQL = "INSERT INTO sales_detail(sales_id,prod_id,qty,weight,price,sd_date,sales_no) 
			VALUES('$sales_id','$prod_id','$qty','$weight','$price','$sdate','$sales_no')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
		 
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";	
		//echo "<script>window.location='product.php'</script>";   
		}
	}
	
	}

//}		

?>