<?php
include("db/dbcon.php"); 
include("functions.php"); 
error_reporting(0);

$bar_id = $_REQUEST["barcode"];
$wgt 	= $_REQUEST["wgt"];
?>

<input type="hidden" id="bqty" value="<?php echo get_title(bqty,$bar_id,$dbconfig); ?>" />
<input type="hidden" id="bwgt" value="<?php echo $wgt; ?>" />
<input type="hidden" id="bprod_id" value="<?php echo get_title(prod_id,$bar_id,$dbconfig); ?>" />