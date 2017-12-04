<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
error_reporting(0);

		
		$getSQLs = "select * from isbpos.live_transfer where shop_id = '".$_SESSION["s_id"]."' and tr_status = 1 and upload = 1";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $sauto_tr_id    = $rowgs["tr_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$s_shop_id	 	 = $rowgs["s_shop_id"];
			$s_qty		 	 = $rowgs["s_qty"];
			$r_qty		 	 = $rowgs["r_qty"];
			$s_weight	 	 = $rowgs["s_weight"];
			$r_weight	 	 = $rowgs["r_weight"];
			$tr_status	 	 = $rowgs["tr_status"];
			$tr_datetime 	 = $rowgs["tr_datetime"];

			
			$getSQL = "select * from client_isbpos.live_transfer where server_tr_id = '".$sauto_tr_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_tr_id  = $rowg["tr_id"];
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
				
				echo $insertSQLs = "INSERT INTO client_isbpos.live_transfer
					(s_qty,s_weight,shop_id,s_shop_id,tr_datetime,rcv_datetime,r_qty,r_weight,upload,server_tr_id,tr_status) 
					VALUES('$s_qty','$s_weight','$shop_id','$s_shop_id','$tr_datetime','$tr_datetime','$r_qty','$r_weight','3','$sauto_tr_id','1')"; 
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
					
					if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.live_transfer where server_tr_id = '".$sauto_tr_id."' and upload = 3 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_tr_id  = $rowgcn["tr_id"];

					$updateSQL = "UPDATE isbpos.live_transfer set upload = 3, client_tr_id = '$cnauto_tr_id'
					where tr_id = '$sauto_tr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());					
					
					
				}
			}
		}
		
		////////////////////////////////////////////////////////////////////////
		
		
		$getSQLs = "select * from client_isbpos.live_transfer where shop_id = '".$_SESSION["s_id"]."' and tr_status = 4 and upload = 3";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
		 
			echo $cauto_tr_id    = $rowgs["tr_id"];
			$shop_id	 	 = $rowgs["shop_id"];
			$s_shop_id	 	 = $rowgs["s_shop_id"];
			$s_qty		 	 = $rowgs["s_qty"];
			$r_qty		 	 = $rowgs["r_qty"];
			$s_weight	 	 = $rowgs["s_weight"];
			$r_weight	 	 = $rowgs["r_weight"];
			$tr_status	 	 = $rowgs["tr_status"];
			$tr_datetime 	 = $rowgs["tr_datetime"];
			$rcv_datetime 	 = $rowgs["rcv_datetime"];
		
		
		
			
			$getSQL = "select * from isbpos.live_transfer where client_tr_id = '".$cauto_tr_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_tr_id  = $rowg["tr_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==3)
				{
					echo "Added";
					echo $updateSQLc = "UPDATE isbpos.live_transfer set upload = 2,tr_status = 4,r_qty='$r_qty',r_weight='$r_weight',rcv_datetime = '$rcv_datetime' 
					where client_tr_id = '$cauto_tr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{

						$updateSQL = "UPDATE client_isbpos.live_transfer set upload = 2, tr_status = 2 
						where tr_id = '$cauto_tr_id' and shop_id = '".$_SESSION["s_id"]."'";
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