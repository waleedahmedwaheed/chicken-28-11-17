<?php
include("db/dbcon.php"); 
include("functions.php"); 
error_reporting(0);

$cust_id = $_REQUEST["cust_id"];

	 $query="select COALESCE((q1.co_amount - q2.cp_amount),0) as cust_out from
(select COALESCE(sum(ca.co_amount),0) as co_amount from cust_order_amount ca where ca.co_id IN
(select co.co_id from cust_order co where co.cust_id =  '$cust_id' and co.co_status = '2'and co.co_id=ca.co_id)) q1,
(select COALESCE(sum(cp_amount),0) as cp_amount from cust_paid where cust_id = '$cust_id' and cp_status = 2) q2";
	mysql_select_db($database_dbconfig, $dbconfig);
	$result = mysql_query($query, $dbconfig) or die(mysql_error());
	$row=mysql_fetch_assoc($result);
 
		 $cust_out = $row["cust_out"];
		 
		 echo number_format($cust_out,2);
	 
	?>
	 
<?php 
?>