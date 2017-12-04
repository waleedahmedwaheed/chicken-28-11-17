<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
error_reporting(0);

		
		$getSQLs = "select * from client_isbpos.loss where shop_id = '".$_SESSION["s_id"]."' and loss_status = 2 and upload = 1";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $cauto_loss_id    = $rowgs["loss_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$prod_id	 	 = $rowgs["prod_id"];
			$loss_status	 = $rowgs["loss_status"];
			$loss_qty		 = $rowgs["loss_qty"];
			$loss_weight	 = $rowgs["loss_weight"];
			$loss_datetime	 = $rowgs["loss_datetime"];
		
			$getSQL = "select * from isbpos.loss where client_loss_id = '".$cauto_loss_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_loss_id  = $rowg["loss_id"];
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
				
				echo $insertSQLs = "INSERT INTO isbpos.loss(loss_qty,loss_weight,shop_id,prod_id,loss_datetime,upload,client_loss_id,loss_status) 
				VALUES('$loss_qty','$loss_weight','$shop_id','$prod_id','$loss_datetime','2','$cauto_loss_id','2')"; 
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
					
					if($Result1)
				{
					$getSQLcn = "select * from isbpos.loss where client_loss_id = '".$cauto_loss_id."' and upload = 2 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$snauto_loss_id  = $rowgcn["loss_id"];

					$updateSQL = "UPDATE client_isbpos.loss set upload = 2, server_loss_id = '$snauto_loss_id'
					where loss_id = '$cauto_loss_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());	 		
					
					
				} 
			}
		
		}
			
		////////////////////////////////////////////////////////////////////////
		
		
			
		
?>