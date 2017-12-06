<?php 
include 'db/dbcon.php';
include 'db/dbcon2.php';
session_start();
//error_reporting(0);


		
		$getSQLs = "select * from isbpos.daily_rates where upload = 1 and shop_id = '".$_SESSION["s_id"]."'";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 echo $sauto_mr_id    = $rowgs["mr_id"];
			 $shop_id		 = $rowgs["shop_id"];
			 $cur_date		 = $rowgs["cur_date"];
			 $sale_rate		 = $rowgs["sale_rate"];
			 $mr_rate		 = $rowgs["mr_rate"];
			 //echo $sauto_rate_id."<br>";
		 
			$getSQL = "select * from client_isbpos.daily_rates where server_mr_id = '".$sauto_mr_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$cauto_mr_id  = $rowg["mr_id"];
			$supload  	  = $rowg["upload"];
			if($rowg>0)
			{
				if($supload==2)
				{
					//echo "Added";
					$updateSQLc = "UPDATE client_isbpos.daily_rates set upload = 2, sale_rate='$sale_rate' , mr_rate = '$mr_rate'
					where server_mr_id = '$sauto_mr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{
						
					$getSQLcn = "select * from isbpos.daily_rates where client_mr_id = '".$cauto_mr_id."' and upload = 1 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_mr_id  = $rowgcn["mr_id"];

					echo $updateSQL = "UPDATE isbpos.daily_rates set upload = 2, client_mr_id = '$cauto_mr_id'
					where mr_id = '$sauto_mr_id' and shop_id = '".$_SESSION["s_id"]."'";
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
				$insertSQLs = "INSERT INTO client_isbpos.daily_rates(shop_id,cur_date,mr_rate,sale_rate,server_mr_id, upload) 
				VALUES('$shop_id','$cur_date','$mr_rate' ,'$sale_rate', '$sauto_mr_id' , '2')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from client_isbpos.daily_rates where server_mr_id = '".$sauto_mr_id."' and upload = 2 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_mr_id  = $rowgcn["mr_id"];

					echo $updateSQL = "UPDATE isbpos.daily_rates set upload = 2, client_mr_id = '$cnauto_mr_id'
					where mr_id = '$sauto_mr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					
				}
				else
				{
					
				}
			}
		} 
		

		$getSQLs = "select * from client_isbpos.daily_rates where upload = 1 and shop_id = '".$_SESSION["s_id"]."'";
		echo $getSQLs."<br>";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
		while($rowgs = mysql_fetch_assoc($Resultgs))
		{
			 //$server_rate_id = $rowg["server_rate_id"];
			 $cauto_mr_id  = $rowgs["mr_id"];
			 $shop_id		 = $rowgs["shop_id"];
			 $cur_date		 = $rowgs["cur_date"];
			 $sale_rate		 = $rowgs["sale_rate"];
			 $mr_rate		 = $rowgs["mr_rate"];
			 //echo $sauto_rate_id."<br>";
			 
			$getSQL = "select * from isbpos.daily_rates where client_mr_id = '".$cauto_mr_id."' and shop_id = '".$_SESSION["s_id"]."'";
			echo $getSQL."<br>";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
			$rowg = mysql_fetch_assoc($Resultg);
			$sauto_mr_id    = $rowg["mr_id"];
			$supload  		= $rowg["upload"];
			if($rowg>0)
			{
				if($supload==2)
				{
					//echo "Added";
					echo $updateSQLc = "UPDATE isbpos.daily_rates set upload = 2, sale_rate='$sale_rate' , mr_rate = '$mr_rate'
					where client_mr_id = '$cauto_mr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultc = mysql_query($updateSQLc, $dbconfig) or die(mysql_error());
					
					if($Resultc)
					{
						
					$getSQLcn = "select * from client_isbpos.daily_rates where server_mr_id = '".$sauto_mr_id."' and upload = 1 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$snauto_mr_id  = $rowgcn["mr_id"];

					echo $updateSQL = "UPDATE client_isbpos.daily_rates set upload = 2, server_mr_id = '$sauto_mr_id'
					where mr_id = '$cauto_mr_id' and shop_id = '".$_SESSION["s_id"]."'";
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
				$insertSQLs = "INSERT INTO isbpos.daily_rates(shop_id,cur_date,mr_rate,sale_rate,client_mr_id, upload) 
				VALUES('$shop_id','$cur_date','$mr_rate' ,'$sale_rate', '$cauto_mr_id' , '2')";
				echo $insertSQLs."<br>";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQLs, $dbconfig) or die(mysql_error());
				
				if($Result1)
				{
					$getSQLcn = "select * from isbpos.daily_rates where client_mr_id = '".$cauto_mr_id."' and upload = 2 and shop_id = '".$_SESSION["s_id"]."'";
					echo $getSQLcn."<br>";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultgcn = mysql_query($getSQLcn, $dbconfig) or die(mysql_error());	 
					$rowgcn = mysql_fetch_assoc($Resultgcn);
					$cnauto_mr_id  = $rowgcn["mr_id"];

					echo $updateSQL = "UPDATE client_isbpos.daily_rates set upload = 2, server_mr_id = '$cnauto_mr_id'
					where mr_id = '$cauto_mr_id' and shop_id = '".$_SESSION["s_id"]."'";
					mysql_select_db($database_dbconfig, $dbconfig);
					$Resultu = mysql_query($updateSQL, $dbconfig) or die(mysql_error());
					
					
				}
				else
				{
					
				}
			}
		} 
			
		
		
?>