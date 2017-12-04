<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
error_reporting(0);


		
		$getSQLs = "select * from isbpos.rates where upload = 1 and shop_id = '".$_SESSION["s_id"]."'";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
			 $sauto_rate_id  = $rowgs["rate_id"];
			 $shop_id		 = $rowgs["shop_id"];
			 $r_date		 = $rowgs["r_date"];
			 $prod_id		 = $rowgs["prod_id"];
			 $sale_price	 = $rowgs["sale_price"];
			 //echo $sauto_rate_id."<br>";
			 
			$getSQL = "select * from client_isbpos.rates where server_rate_id = '".$sauto_rate_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_rate_id  = $rowg["rate_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==2)
				{
					//echo "Added";
					$updateSQLc = "UPDATE client_isbpos.rates set upload = 2, sale_price='$sale_price'
					where server_rate_id = '$sauto_rate_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{
						
					$getSQLcn = "select * from isbpos.rates where client_rate_id = '".$cauto_rate_id."' and upload = 1";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_rate_id  = $rowgcn["rate_id"];

					echo $updateSQL = "UPDATE isbpos.rates set upload = 2, client_rate_id = '$cauto_rate_id'
					where rate_id = '$sauto_rate_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					}
					
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
			else
			{
				$insertSQLs = "INSERT INTO client_isbpos.rates(shop_id,r_date,prod_id,sale_price,server_rate_id, upload) 
				VALUES('$shop_id','$r_date','$prod_id' ,'$sale_price', '$sauto_rate_id' , '2')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.rates where server_rate_id = '".$sauto_rate_id."' and upload = 2";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_rate_id  = $rowgcn["rate_id"];

					echo $updateSQL = "UPDATE isbpos.rates set upload = 2, client_rate_id = '$cnauto_rate_id'
					where rate_id = '$sauto_rate_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					/* echo $updateSQLc = "UPDATE client_isbpos.rates set upload = 2 where server_rate_id = '$sauto_rate_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error()); */
				}
				else
				{
					
				}
			}
		}
		
		$getSQLs = "select * from client_isbpos.rates where upload = 1 and shop_id = '".$_SESSION["s_id"]."'";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
			 $cauto_rate_id  = $rowgs["rate_id"];
			 $shop_id		 = $rowgs["shop_id"];
			 $r_date		 = $rowgs["r_date"];
			 $prod_id		 = $rowgs["prod_id"];
			 $sale_price	 = $rowgs["sale_price"];
			 //echo $sauto_rate_id."<br>";
			 
			$getSQL = "select * from isbpos.rates where client_rate_id = '".$cauto_rate_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_rate_id  = $rowg["rate_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==2)
				{
					//echo "Added";
					$updateSQLc = "UPDATE isbpos.rates set upload = 2, sale_price='$sale_price'
					where client_rate_id = '$cauto_rate_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{
						
					$getSQLcn = "select * from client_isbpos.rates where server_rate_id = '".$sauto_rate_id."' and upload = 1";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$snauto_rate_id  = $rowgcn["rate_id"];

					echo $updateSQL = "UPDATE client_isbpos.rates set upload = 2, server_rate_id = '$sauto_rate_id'
					where rate_id = '$cauto_rate_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					}
					
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
			else
			{
				$insertSQLs = "INSERT INTO isbpos.rates(shop_id,r_date,prod_id,sale_price,client_rate_id, upload) 
				VALUES('$shop_id','$r_date','$prod_id' ,'$sale_price', '$cauto_rate_id' , '2')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from isbpos.rates where client_rate_id = '".$cauto_rate_id."' and upload = 2";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_rate_id  = $rowgcn["rate_id"];

					echo $updateSQL = "UPDATE client_isbpos.rates set upload = 2, server_rate_id = '$cnauto_rate_id'
					where rate_id = '$cauto_rate_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					
				}
				else
				{
					
				}
			}
		} 
		
		
?>