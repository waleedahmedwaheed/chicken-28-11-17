<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
error_reporting(0);

		
		$getSQLs = "select * from isbpos.prod_processed where shop_id = '".$_SESSION["s_id"]."' and ppr_status = 1 and upload = 1";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $sauto_ppr_id    = $rowgs["ppr_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$s_shop_id	 	 = $rowgs["s_shop_id"];
			$ppr_date	 	 = $rowgs["ppr_date"];
			$ppr_status	 	 = $rowgs["ppr_status"];
			$ppr_datetime 	 = $rowgs["ppr_datetime"];

		
			
			$getSQL = "select * from client_isbpos.prod_processed where server_ppr_id = '".$sauto_ppr_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_ppr_id  = $rowg["ppr_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==1)
				{
					//echo "Added";
					//$updateSQLc = "UPDATE client_isbpos.prod_processed set upload = 2 where server_ppr_id = '$sauto_ppr_id' and shop_id = '".$_SESSION["s_id"]."'";
					//mysql_select_db($database_dbconfig, $dbconfig);
					//$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
			else
			{
				
				echo $insertSQLs = "INSERT INTO client_isbpos.prod_processed
							(shop_id,ppr_date,s_shop_id,ppr_status,ppr_datetime,server_ppr_id,upload) 
							VALUES('$shop_id','$ppr_date','$s_shop_id','1','$ppr_datetime','$sauto_ppr_id','3')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
					
					if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.prod_processed where server_ppr_id = '".$sauto_ppr_id."' and upload = 3 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_ppr_id  = $rowgcn["ppr_id"];

					$updateSQL = "UPDATE isbpos.prod_processed set upload = 3, client_ppr_id = '$cnauto_ppr_id'
					where ppr_id = '$sauto_ppr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());					
					
					
				}
				else
				{
					
				}
			}
			
		}
		
		///////////////////////////////////////////////////////////
		
		$getSQLs = "select * from isbpos.ppr_products where pprp_status = 1 and upload = 1 and ppr_id in 
				(select ppr_id from isbpos.prod_processed where shop_id = '".$_SESSION["s_id"]."' and ppr_status = 1)";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $sauto_pprp_id	 	 = $rowgs["pprp_id"];
			$ppr_id		 	 = $rowgs["ppr_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$ppr_status	 	 = $rowgs["ppr_status"];
			$s_qty		 	 = $rowgs["s_qty"];
			$r_qty		 	 = $rowgs["r_qty"];
			$s_weight	 	 = $rowgs["s_weight"];
			$r_weight	 	 = $rowgs["r_weight"];
			$prod_id	 	 = $rowgs["prod_id"];
			
			
			$getSQL = "select * from client_isbpos.ppr_products where server_pprp_id = '".$sauto_pprp_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_pprp_id  = $rowg["pprp_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==1)
				{
					//echo "Added";
					//$updateSQLc = "UPDATE client_isbpos.prod_processed set upload = 3 where server_pprp_id = '$cauto_pprp_id' ";
					//mysql_select_db($database_dbconfig, $dbconfig);
					//$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
			else
			{
				echo $sql2 = "SELECT ppr_id from client_isbpos.prod_processed where server_ppr_id = '$ppr_id'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultgsa = mysql_query($sql2, $dbconfig) or die(mysql_error());	 
				$rowgsa = mysql_fetch_assoc($Resultgsa);
				$ppr_id_ = $rowgsa["ppr_id"];
				
				echo $insertSQLs = "INSERT INTO client_isbpos.ppr_products(s_qty,s_weight,r_qty,r_weight,pprp_status,prod_id,upload,server_pprp_id,ppr_id) 
			VALUES('$s_qty','$s_weight','$r_qty','$r_weight','1','$prod_id','3','$sauto_pprp_id','$ppr_id_')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
					
					if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.ppr_products where server_pprp_id = '".$sauto_pprp_id."' and upload = 3 ";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_pprp_id  = $rowgcn["pprp_id"];

					$updateSQL = "UPDATE isbpos.ppr_products set upload = 3, client_pprp_id = '$cnauto_pprp_id'
					where pprp_id = '$sauto_pprp_id' and ppr_id = '".$ppr_id."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());					
					
					
				}
				
			}
			
			
		}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////
		
		
		$getSQLs = "select * from client_isbpos.prod_processed where shop_id = '".$_SESSION["s_id"]."' and ppr_status = 4 and upload = 3";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $cauto_ppr_id    = $rowgs["ppr_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$s_shop_id	 	 = $rowgs["s_shop_id"];
			$ppr_date	 	 = $rowgs["ppr_date"];
			$ppr_status	 	 = $rowgs["ppr_status"];
			$ppr_datetime 	 = $rowgs["ppr_datetime"];
		
		
		
			
			$getSQL = "select * from isbpos.prod_processed where client_ppr_id = '".$cauto_ppr_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			//$cauto_ppr_id  = $rowg["ppr_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==3)
				{
					echo "Added";
					echo $updateSQLc = "UPDATE isbpos.prod_processed set upload = 2,ppr_status = 4 where client_ppr_id = '$cauto_ppr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{

						$updateSQL = "UPDATE client_isbpos.prod_processed set upload = 2, ppr_status = 2 
						where ppr_id = '$cauto_ppr_id' and shop_id = '".$_SESSION["s_id"]."'";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());					
					
					
					}
				
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
		}
			
		/////////////////////////////////////////////////////////////////////////
		
		
		$getSQLs = "select * from client_isbpos.ppr_products where pprp_status = 4 and upload = 3 and ppr_id in 
				(select ppr_id from client_isbpos.prod_processed where shop_id = '".$_SESSION["s_id"]."')";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $cauto_pprp_id	 	 = $rowgs["pprp_id"];
			$ppr_id__	 	 = $rowgs["ppr_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$ppr_status	 	 = $rowgs["ppr_status"];
			$s_qty		 	 = $rowgs["s_qty"];
			$r_qty		 	 = $rowgs["r_qty"];
			$s_weight	 	 = $rowgs["s_weight"];
			$r_weight	 	 = $rowgs["r_weight"];
			$prod_id	 	 = $rowgs["prod_id"];
			
		
			 $getSQL = "select * from isbpos.ppr_products where client_pprp_id = '".$cauto_pprp_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_pprp_id  = $rowg["pprp_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==3)
				{
					echo "Added";
					$updateSQLc = "UPDATE isbpos.ppr_products set upload = 2,r_qty='$r_qty',r_weight='$r_weight',pprp_status=4
					where client_pprp_id = '$cauto_pprp_id' ";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{
						$updateSQL = "UPDATE client_isbpos.ppr_products set upload = 2, pprp_status = 2
						where pprp_id = '".$cauto_pprp_id."'";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					}
				}
				else
				{
					//echo $cauto_rate_id."NOT";
				}
			}
		}
		
		
?>