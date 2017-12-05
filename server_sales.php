<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
include 'functions.php';
session_start();
error_reporting(0);
		
		$getSQLs = "select * from client_isbpos.sales where upload = 1 and shop_id = '".$_SESSION["s_id"]."' and sale_status = 2";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
				echo $cauto_sales_id	= $rowgs['sales_id'];
				$sales_no	  	= $rowgs['sales_no'];
				$shop_id 		= $rowgs['shop_id'];
				$total		  	= $rowgs['total'];
				$discount	  	= $rowgs['discount'];
				$amount_due  	= $rowgs['amount_due'];
				$item_type  	= $rowgs['item_type'];
				$date_added  	= $rowgs['date_added'];
				$cash_tendered 	= $rowgs['cash_tendered'];
				$amount_due 	= $rowgs['amount_due'];
				$changed	 	= $rowgs['changed'];
				$roundoff	 	= $rowgs['roundoff'];
				
			$getSQL = "select * from isbpos.sales where client_sales_id = '".$cauto_sales_id."' and shop_id = '".$_SESSION["s_id"]."' and sales_no = '".$sales_no."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_sales_id = $rowg["sales_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				echo "Insert <br>";
			}
			else
			{
				$insertSQLs = "INSERT INTO isbpos.sales
				(item_type,shop_id,date_added,sales_no,cash_tendered,discount,amount_due,total,changed,roundoff,client_sales_id,sale_status) 
			VALUES('$item_type','$shop_id','$date_added','$sales_no','$cash_tendered','$discount','$amount_due','$total','$changed','$roundoff','$cauto_sales_id','2')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from isbpos.sales where client_sales_id = '".$cauto_sales_id."' and shop_id = '".$_SESSION["s_id"]."' and sales_no = '".$sales_no."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$sauto_sales_id  = $rowgcn["sales_id"];

					$updateSQL = "UPDATE client_isbpos.sales set upload = 2,server_sales_id = '$sauto_sales_id'
					where sales_id = '$cauto_sales_id' and shop_id = '".$_SESSION["s_id"]."' and sales_no = '".$sales_no."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
				}
			}
			 
		}
		
		
		$getSQLs = "select * from client_isbpos.sales_detail where upload = 1 and sd_status = 2 and sales_id in 
					(select sales_id from client_isbpos.sales where shop_id = '".$_SESSION["s_id"]."' and sale_status = 2)";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
				echo $cauto_sd_id	= $rowgs['sd_id'];
				$prod_id	= $rowgs["prod_id"];
				$sales_no_	= $rowgs["sales_no"];
				$sdate		= $rowgs["sd_date"];
				$qty		= $rowgs["qty"];
				$weight		= $rowgs["weight"];
				$price		= $rowgs["price"];
				//$sales_id	= get_title(sales_id,$sales_no_,$dbconfig);
				
				echo $sql2 = "SELECT sales_id from isbpos.sales where sales_no = '$sales_no_' and shop_id = '".$_SESSION["s_id"]."'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultgsa = mysql_query($sql2, $dbconfig) or die(mysql_error());	 
				$rowgsa = mysql_fetch_assoc($Resultgsa);
				$sales_id = $rowgsa["sales_id"];
				
				
			 $getSQL = "select * from isbpos.sales_detail where client_sd_id = '".$cauto_sd_id."' and sales_no = '".$sales_no_."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_sd_id = $rowg["sd_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				echo "Insert <br>";
			}
			else
			{
				
				$insertSQLs = "INSERT INTO isbpos.sales_detail(sales_id,prod_id,qty,weight,price,sd_date,sales_no,client_sd_id,sd_status) 
			VALUES('$sales_id','$prod_id','$qty','$weight','$price','$sdate','$sales_no_','$cauto_sd_id','2')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from isbpos.sales_detail where client_sd_id = '".$cauto_sd_id."' and sales_no = '".$sales_no_."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$snauto_sd_id  = $rowgcn["sd_id"];

					$updateSQL = "UPDATE client_isbpos.sales_detail set upload = 2 ,server_sd_id = '$snauto_sd_id'
					where sd_id = '$cauto_sd_id' and sales_no = '".$sales_no_."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
				}
			} 
			 
		} 
			
	
?>