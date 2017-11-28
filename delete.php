<?php
require_once('db/dbcon.php');

$id = $_GET["id"];

switch($id)
{
	case 1:
	$insertSQL = "Update product set prod_status = '1' where prod_id = '".$_GET["prod_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 2:
	$insertSQL = "Update product set prod_status = '0' where prod_id = '".$_GET["prod_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 3:
	$insertSQL = "Update product_category set pcat_status = '1' where pcat_id = '".$_GET["pcat_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 4:
	$insertSQL = "Update product_category set pcat_status = '0' where pcat_id = '".$_GET["pcat_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 5:
	$insertSQL = "Update ie_cat set ie_status = '1' where iecat_id = '".$_GET["iecat_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 6:
	$insertSQL = "Update ie_cat set ie_status = '0' where iecat_id = '".$_GET["iecat_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 7:
	$insertSQL = "Update ie_detail set ie_dstatus = '1' where ie_id = '".$_GET["ie_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 8:
	$insertSQL = "Update sales_detail set sd_status = '1' where sd_id = '".$_GET["sd_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 9:
	$insertSQL = "Update production_batches set pb_status = '1' where pb_id = '".$_GET["pb_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 10:
	$insertSQL = "Update production_prod set pp_status = '1' where pp_id = '".$_GET["pp_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 11:
	$insertSQL = "Update ppr_products set pprp_status = '1' where pprp_id = '".$_GET["pprp_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
	
	case 12:
	$insertSQL = "Update cust_paid set cp_status = '2' where cp_id = '".$_GET["cp_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Approved Successfully') </script>";
	break;
	
	case 13:
	$insertSQL = "Update cust_paid set cp_status = '-1' where cp_id = '".$_GET["cp_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Approved Successfully') </script>";
	break;
	
	case 14:
	$insertSQL = "Update farm set farm_status = '-1' where farm_id = '".$_GET["farm_id"]."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	echo "<script type='text/javascript'> alert('Deleted Successfully') </script>";
	break;
}

	
	
?>