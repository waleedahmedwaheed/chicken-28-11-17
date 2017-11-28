<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
error_reporting(0);

		
		$getSQLs = "select * from isbpos.purchase where upload = 1 and shop_id = '".$_SESSION["s_id"]."' and p_status = 2";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
			$sauto_pur_id    = $rowgs["pur_id"];
			$party_name		 = $rowgs["party_name"];
			$pur_from		 = $rowgs["pur_from"];
			$party_rate	 	 = $rowgs["party_rate"];
			$prod_id		 = $rowgs["prod_id"];
			$mandi_rate	 	 = $rowgs["mandi_rate"];
			$pur_date	 	 = $rowgs["pur_date"];
			$shop_id	 	 = $rowgs["shop_id"];
			$p_status	 	 = $rowgs["p_status"];
			$qty		 	 = $rowgs["qty"];
			$weight		 	 = $rowgs["weight"];
			$driver		 	 = $rowgs["driver"];
			$vehicle	 	 = $rowgs["vehicle"];
			$location	 	 = $rowgs["location"];
			$weight_loss 	 = $rowgs["weight_loss"];
			$qty_loss	 	 = $rowgs["qty_loss"];
			$bird_wgt_loss 	 = $rowgs["bird_wgt_loss"];
			 //echo $sauto_rate_id."<br>";
			 
			$getSQL = "select * from client_isbpos.purchase where server_pur_id = '".$sauto_pur_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_pur_id  = $rowg["pur_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==1)
				{
					//echo "Added";
					$updateSQLc = "UPDATE client_isbpos.purchase set upload = 2 where server_pur_id = '$sauto_pur_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
			else
			{
		echo $insertSQLs = "INSERT INTO client_isbpos.purchase
		(pur_from,party_name,party_rate,mandi_rate,pur_date,shop_id,qty,weight,driver,vehicle,location,weight_loss,qty_loss,bird_wgt_loss,prod_id,p_status,upload,server_pur_id) 
		VALUES
	('$pur_from','$party_name','$party_rate','$mandi_rate','$pur_date','$shop_id','$qty','$weight','$driver','$vehicle','$location','$weight_loss','$qty_loss','$bird_wgt_loss','$prod_id','0','2','$sauto_pur_id')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.purchase where server_pur_id = '".$sauto_pur_id."' and upload = 2";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_pur_id  = $rowgcn["pur_id"];

					$updateSQL = "UPDATE isbpos.purchase set upload = 2, client_pur_id = '$cnauto_pur_id'
					where pur_id = '$sauto_pur_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					echo $insertSQL = "CALL client_isbpos.`PUR_INSERT`($cnauto_pur_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
					$insertSQL = "CALL client_isbpos.`pur_update`($cnauto_pur_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
					/* echo $updateSQLc = "UPDATE client_isbpos.rates set upload = 2 where server_rate_id = '$sauto_rate_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error()); */
				}
				else
				{
					
				}
			}
		}
		
		
		
		$getSQLs = "select * from client_isbpos.purchase where upload = 1 and shop_id = '".$_SESSION["s_id"]."' and p_status = 2";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
			$cauto_pur_id    = $rowgs["pur_id"];
			$party_name		 = $rowgs["party_name"];
			$pur_from		 = $rowgs["pur_from"];
			$party_rate	 	 = $rowgs["party_rate"];
			$prod_id		 = $rowgs["prod_id"];
			$mandi_rate	 	 = $rowgs["mandi_rate"];
			$pur_date	 	 = $rowgs["pur_date"];
			$shop_id	 	 = $rowgs["shop_id"];
			$p_status	 	 = $rowgs["p_status"];
			$qty		 	 = $rowgs["qty"];
			$weight		 	 = $rowgs["weight"];
			$driver		 	 = $rowgs["driver"];
			$vehicle	 	 = $rowgs["vehicle"];
			$location	 	 = $rowgs["location"];
			$weight_loss 	 = $rowgs["weight_loss"];
			$qty_loss	 	 = $rowgs["qty_loss"];
			$bird_wgt_loss 	 = $rowgs["bird_wgt_loss"];
			 //echo $sauto_rate_id."<br>";
			 
			$getSQL = "select * from isbpos.purchase where client_pur_id = '".$cauto_pur_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_pur_id  = $rowg["pur_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==1)
				{
					//echo "Added";
					$updateSQLc = "UPDATE isbpos.purchase set upload = 2 where client_pur_id = '$cauto_pur_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
			else
			{
		echo $insertSQLs = "INSERT INTO isbpos.purchase
		(pur_from,party_name,party_rate,mandi_rate,pur_date,shop_id,qty,weight,driver,vehicle,location,weight_loss,qty_loss,bird_wgt_loss,prod_id,p_status,upload,client_pur_id) 
		VALUES
	('$pur_from','$party_name','$party_rate','$mandi_rate','$pur_date','$shop_id','$qty','$weight','$driver','$vehicle','$location','$weight_loss','$qty_loss','$bird_wgt_loss','$prod_id','0','2','$cauto_pur_id')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from isbpos.purchase where client_pur_id = '".$cauto_pur_id."' and upload = 2";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_pur_id  = $rowgcn["pur_id"];

					$updateSQL = "UPDATE client_isbpos.purchase set upload = 2, server_pur_id = '$cnauto_pur_id'
					where pur_id = '$cauto_pur_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					echo $insertSQL = "CALL isbpos.`PUR_INSERT`($cnauto_pur_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
					$insertSQL = "CALL isbpos.`pur_update`($cnauto_pur_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
					/* echo $updateSQLc = "UPDATE client_isbpos.rates set upload = 2 where server_rate_id = '$sauto_rate_id'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error()); */
				}
				else
				{
					
				}
			}
		}
	
?>