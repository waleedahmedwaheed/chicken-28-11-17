<?php
include("db/dbcon.php"); 
include("functions.php"); 
error_reporting(0);

$cat = $_REQUEST["cat"];

if($cat==9999)
{
?>	
	<option class="option" value="">--Select Product--</option>
	<option class="option" value="9999">Live Chicken </option>
	
	
<?php }
else
{

?>
	<option class="option" value="">--Select Product--</option>
<?php
	$query="select * from product where pcat_id = '$cat' and prod_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$result = mysql_query($query, $dbconfig) or die(mysql_error());
	while($row=mysql_fetch_assoc($result))

	{
		$prod_id_ = $row["prod_id"];
		$prod_name = $row["prod_name"];
	 
	?>
	<option value="<?php echo $prod_id_; ?>" <?php if($prod_id_==$prod_id){ echo "selected"; } ?>><?php echo $prod_name; ?></option>
<?php } 

}
?>