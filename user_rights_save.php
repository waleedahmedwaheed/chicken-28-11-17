<?php
include 'db/dbcon.php';
include 'functions.php';
//error_reporting(0);

$main_menu_id 			= $_REQUEST["main_menu_id"];
$sub_menu_id 			= $_REQUEST["sub_menu_id"];
$user_id		 			= $_REQUEST["user_id"];


 $counts =  count($main_menu_id);
 $submenu_counts =  count($sub_menu_id);
 
	$get_menu_d ="delete from menu_allow where user_id='".$user_id."'"; 
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($get_menu_d, $dbconfig) or die(mysql_error());
	 
 
   $get_menu_dl ="delete from SUB_MENU_ALLOW where USER_ID='".$user_id."'"; 
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1g = mysql_query($get_menu_dl, $dbconfig) or die(mysql_error());
	 

for($z=0; $z<$counts; $z++){

$_main_menu_id = $main_menu_id[$z];
$_sub_menu_id = $sub_menu_id[$z];
	
	  $get_menu ="select * from MENU_ALLOW where MAIN_MENU_ID='$_main_menu_id' and USER_ID='".$user_id."'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1m = mysql_query($get_menu, $dbconfig) or die(mysql_error());
		$rows_menu=mysql_fetch_assoc($Result1m);
		if($rows_menu>0)
		{
			//echo "<script type='text/javascript'>alert('Already added');</script>";
		}
		else
		{
    $sql = "Insert into MENU_ALLOW
   (MAIN_MENU_ID, USER_ID ) Values
   ('$_main_menu_id' , '".$user_id."' )"; 
					 //echo $sql."<br>";
					 //exit;
		 mysql_select_db($database_dbconfig, $dbconfig);
		$Results = mysql_query($sql, $dbconfig) or die(mysql_error());
			if($Results)
			{
				//echo "<script type='text/javascript'>alert('User Right successfully added');</script>";
				//echo '<script type="text/javascript">window.location = "group_code.php"</script>'; 
			}
			else
			{
				echo "<script type='text/javascript'>alert('Error');</script>";
			}		
		}
		
		
}


for($i=0; $i<$submenu_counts; $i++)
{

$_main_menu_id = $main_menu_id[$i];
 $_sub_menu_id  = $sub_menu_id[$i];
 
 //echo "<br>".$_sub_menu_id."<br>";
	
		   $get_sub_menu ="select * from main_menu c , sub_menu d where c.MAIN_MENU_ID=d.MAIN_MENU_ID  
		and d.SUB_MENU_ID='$_sub_menu_id'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultsb = mysql_query($get_sub_menu, $dbconfig) or die(mysql_error());
		while($pro_get_sub_menu=mysql_fetch_assoc($Resultsb))
	{
			 $SUB_MENU_ID				= $pro_get_sub_menu["sub_menu_id"];
			 $MAIN_MENU_ID				= $pro_get_sub_menu["main_menu_id"];
			
			
	/* $get_menu ="select * from MENU_ALLOW where MAIN_MENU_ID='$MAIN_MENU_ID' and SUB_MENU_ID='$SUB_MENU_ID' and USER_ID='".$u_id."'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultme = mysql_query($get_menu, $dbconfig) or die(mysql_error());
		$rows_menu=mysql_fetch_assoc($Resultme);
		if($rows_menu>0)
		{
			//echo "<script type='text/javascript'>alert('Already added');</script>";
		}
		else
		{
  $sql = "Insert into MENU_ALLOW
   (MAIN_MENU_ID, SUB_MENU_ID , USER_ID) Values
   ('$MAIN_MENU_ID','$SUB_MENU_ID', '".$u_id."')"; 
					 //echo $sql."<br>";
					 //exit;
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultq = mysql_query($sql, $dbconfig) or die(mysql_error());
				
			if($Resultq)
			{
				//echo "<script type='text/javascript'>alert('User Right successfully added');</script>";
				//echo '<script type="text/javascript">window.location = "group_code.php"</script>'; 
			}
			else
			{
				echo "<script type='text/javascript'>alert('Error');</script>";
			}		
		} */
	
		$get_menu ="select * from SUB_MENU_ALLOW where SUB_MENU_ID='$_sub_menu_id' and USER_ID='".$user_id."'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultme = mysql_query($get_menu, $dbconfig) or die(mysql_error());
		$rows_menu=mysql_fetch_assoc($Resultme);
		if($rows_menu>0)
		{
			//echo "<script type='text/javascript'>alert('Already added');</script>";
		}
		else
		{
			
     $sqlc = "INSERT into SUB_MENU_ALLOW
   (MAIN_MENU_ID, SUB_MENU_ID , USER_ID) Values
   ('$MAIN_MENU_ID','$_sub_menu_id' , '".$user_id."' )"; 
					// echo $sqlc."<br>";
					 //exit;
				  	mysql_select_db($database_dbconfig, $dbconfig);
				$Resultqc = mysql_query($sqlc, $dbconfig) or die(mysql_error());
		}
		
		
	}
} 
 
 

			echo "<script type='text/javascript'>alert('User Right successfully added');</script>";
			echo '<script type="text/javascript">window.location = "user_rights.php?user_id='.$user_id.'"</script>'; 

?>