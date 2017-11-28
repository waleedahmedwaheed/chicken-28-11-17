<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
//error_reporting(0);

		
		$getSQLs = "select * from isbpos.production where upload = 1 and shop_id = '".$_SESSION["s_id"]."' and pro_status = 2";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
			$sauto_pro_id    = $rowgs["pro_id"];
			$daily_rate	 	 = $rowgs["daily_rate"];
			$pro_date		 = $rowgs["pro_date"];
			$pro_datetime	 = $rowgs["pro_datetime"];
			$shop_id		 = $rowgs["shop_id"];
			$pro_status	 	 = $rowgs["pro_status"];
			$pr_qty		 	 = $rowgs["pr_qty"];
			$pr_weight		 = $rowgs["pr_weight"];
			$dress_weight	 = $rowgs["dress_weight"];
			$perc			 = $rowgs["perc"];
			 
			$getSQL = "select * from client_isbpos.production where server_pro_id = '".$sauto_pro_id."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_pro_id   = $rowg["pro_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==1)
				{
					//echo "Added";
					 $updateSQLc = "UPDATE client_isbpos.production set upload = 2 where server_pro_id = '$sauto_pro_id'";
					//echo $updateSQLc."<br>";
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
		  $insertSQLs = "INSERT INTO client_isbpos.production
			(pro_date,daily_rate,pr_qty,pr_weight,shop_id,dress_weight,pro_datetime,perc,upload,server_pro_id,pro_status) 
			VALUES('$pro_date','$daily_rate','$pr_qty','$pr_weight','$shop_id','$dress_weight','$pro_datetime','$perc','2','$sauto_pro_id','0')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.production where server_pro_id = '".$sauto_pro_id."' and upload = 2";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_pro_id  = $rowgcn["pro_id"];

					$updateSQL = "UPDATE isbpos.production set upload = 2, client_pro_id = '$cnauto_pro_id'
					where pro_id = '$sauto_pro_id' ";
					echo $updateSQL."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					
					///////////////////////////////batches/////////////////////////////////////
					
					 $getSQLsb = "select * from isbpos.production_batches where upload = 1 and pro_id = '".$sauto_pro_id."' and pb_status = 2";
					echo $getSQLsb."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgsb = mysql_query($getSQLsb, $dbconfig) or die(mysql_error());	 
					while($rowgsb = mysql_fetch_assoc($Resultgsb))
					{
						
						echo $sauto_pb_id     = $rowgsb["pb_id"];
						$pro_id		 	 = $rowgsb["pro_id"];
						$pb_status	 	 = $rowgsb["pb_status"];
						$pb_qty		 	 = $rowgsb["pb_qty"];
						$pb_weight		 = $rowgsb["pb_weight"];
						$pb_datetime	 = $rowgsb["pb_datetime"];
						
						
						$getSQLb = "select * from client_isbpos.production_batches where server_pb_id = '".$sauto_pb_id."'";
						echo $getSQLb."<br>";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Resultgb = mysql_query($getSQLb, $dbconfig) or die(mysql_error());	 
						$rowgb = mysql_fetch_assoc($Resultgb);
						$cauto_pb_id    = $rowgb["pb_id"];
						$suploadb  		= $rowgb["upload"];
						if($rowgb>0)
						{
							if($suploadb==1)
							{
								//echo "Added";
								$updateSQLc = "UPDATE client_isbpos.production_batches set upload = 2 where server_pb_id = '$sauto_pb_id'";
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
							
							  $insertSQLs = "INSERT INTO client_isbpos.production_batches
						(pb_qty,pb_weight,pro_id,pb_datetime,upload,server_pb_id) 
			VALUES('$pb_qty','$pb_weight','$cnauto_pro_id','$pb_datetime','2','$sauto_pb_id')";
							echo $insertSQLs."<br>";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Resultba = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
						}
						
							if($Resultba)
							{
								$getSQLcn = "select * from client_isbpos.production_batches where server_pb_id = '".$sauto_pb_id."' and upload = 2";
								echo $getSQLcn."<br>";
								mysql_select_db($database_dbconfig, $dbconfig);
								$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
								$rowgcn = mysql_fetch_assoc($Resultgcn);
								$cnnauto_pb_id  = $rowgcn["pb_id"];

								echo $updateSQL = "UPDATE isbpos.production_batches set upload = 2, client_pb_id = '$cnnauto_pb_id'
								where pb_id = '$sauto_pb_id' ";
								mysql_select_db($database_dbconfig, $dbconfig);
								$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
							}
						
						
						
						
					}		  
					
					
					////////////////////////////////////////////////////////////////////////////////
					
					
					
					///////////////////////////////products/////////////////////////////////////
					
					 $getSQLsb = "select * from isbpos.production_prod where upload = 1 and pro_id = '".$sauto_pro_id."' and pp_status = 2";
					echo $getSQLsb."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgsb = mysql_query($getSQLsb, $dbconfig) or die(mysql_error());	 
					while($rowgsb = mysql_fetch_assoc($Resultgsb))
					{
						
						echo $sauto_pp_id     = $rowgsb["pp_id"];
						$pro_id		 	 = $rowgsb["pro_id"];
						$pp_status	 	 = $rowgsb["pp_status"];
						$prod_id	 	 = $rowgsb["prod_id"];
						$p_qty		 	 = $rowgsb["p_qty"];
						$p_weight		 = $rowgsb["p_weight"];
						$pp_id			 = $rowgsb["pp_id"];
						$pp_datetime	 = $rowgsb["pp_datetime"];
						
						
						$getSQLp = "select * from client_isbpos.production_prod where server_pp_id = '".$sauto_pp_id."'";
						echo $getSQLp."<br>";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Resultgp = mysql_query($getSQLp, $dbconfig) or die(mysql_error());	 
						$rowgp = mysql_fetch_assoc($Resultgp);
						$cauto_pp_id    = $rowgp["pp_id"];
						$suploadp  		= $rowgp["upload"];
						if($rowgp>0)
						{
							if($suploadp==1)
							{
								//echo "Added";
								$updateSQLc = "UPDATE client_isbpos.production_prod set upload = 2 where server_pp_id = '$sauto_pp_id'";
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
							
							  $insertSQLs = "INSERT INTO client_isbpos.production_prod
						(prod_id,p_qty,p_weight,pro_id,shop_id,upload,server_pp_id) 
			VALUES('$prod_id','$p_qty','$p_weight','$cnauto_pro_id','$shop_id','2','$sauto_pp_id')";
							echo $insertSQLs."<br>";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Resultba = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
						}
					
							if($Resultba)
							{
								$getSQLcn = "select * from client_isbpos.production_prod where server_pp_id = '".$sauto_pp_id."' and upload = 2";
								echo $getSQLcn."<br>";
								mysql_select_db($database_dbconfig, $dbconfig);
								$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
								$rowgcn = mysql_fetch_assoc($Resultgcn);
								$cnnauto_pp_id  = $rowgcn["pp_id"];

								echo $updateSQL = "UPDATE isbpos.production_prod set upload = 2, client_pp_id = '$cnnauto_pp_id'
								where pp_id = '$sauto_pp_id' ";
								mysql_select_db($database_dbconfig, $dbconfig);
								$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
							}
						
						
						
						
					}		  
					
					
					////////////////////////////////////////////////////////////////////////////////
					
					 $insertSQL = "CALL client_isbpos.`pro_stock`($cnauto_pro_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
					$insertSQL = "CALL client_isbpos.`pro_stock_sub`($cnauto_pro_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
					$insertSQL = "CALL client_isbpos.`pro_update`($cnauto_pro_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

					$insertSQL = "CALL client_isbpos.`pb_update`($cnauto_pro_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());

					$insertSQL = "CALL client_isbpos.`pp_update`($cnauto_pro_id)";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
					
				}
				else
				{
					
				}
			}
		}
		
		
	
?>