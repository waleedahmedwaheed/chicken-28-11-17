<?php
include("db/dbcon.php"); 
include("functions.php"); 
error_reporting(0);

$ie_type = $_REQUEST["ie_type"];
?>
	<option class="option" value="">--Select--</option>
<?php
	$query="select * from ie_cat where ie_type = '$ie_type' and ie_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$result = mysql_query($query, $dbconfig) or die(mysql_error());
	while($row=mysql_fetch_assoc($result))

	{
		$iecat_id_ = $row["iecat_id"];
		$ie_desc   = $row["ie_desc"];
	 
	?>
	<option value="<?php echo $iecat_id_; ?>" <?php if($iecat_id_==$iecat_id){ echo "selected"; } ?>><?php echo $ie_desc; ?></option>
<?php } ?>