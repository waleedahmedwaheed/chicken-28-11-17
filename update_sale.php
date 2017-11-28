<?php 
include 'db/dbcon.php';
error_reporting(0);

 
	  $total		 = $_POST['total'];  if($total==""){ $total = 0; }
	  $discount 	 = $_POST['discount'];  if($discount==""){	$discount = 0; }
	  $amount_due	 = $_POST['amount_due']; if($amount_due==""){	$amount_due = 0; }
	  $cash 		 = $_POST['cash'];  if($cash==""){	$cash = 0; }
	  $change 		 = $_POST['change'];  if($change==""){	$change = 0; }
	  $roundoff		 = $_POST['roundoff'];  if($roundoff==""){	$roundoff = 0; }
	
	$sales_no		 	= $_POST['sales_no'];
	  
	
			
			$insertSQL = "Update sales set  cash_tendered = '$cash',discount = '$discount' , amount_due = '$amount_due' , total = '$total' , changed = '$change' , roundoff = '$roundoff'
			where sales_no = '".$sales_no."' and sale_status = 0";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
			//echo "<span style='color:green;'>Sale Updated</span>";
	
		

?>