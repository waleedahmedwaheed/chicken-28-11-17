<?php	
		$selectlSQL = "select * from loss where pur_id = '$id' ORDER BY loss_id desc";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1l = mysql_query($selectlSQL, $dbconfig) or die(mysql_error());	 
		while($rowl = mysql_fetch_assoc($Result1l))
		{
			$loss_status_ 	= $rowl["loss_status"];
			$loss_id_ 		= $rowl["loss_id"];
	?>							
 	<tr>
		<td><?php echo $rowl["loss_type"]; ?></td>
		<td><?php echo $rowl["type"]; ?></td>
		<td><?php echo $rowl["loss_qty"]; ?></td>
		<td><?php echo $rowl["prod_id"]; ?></td>
		<td><?php echo $rowl["loss_weight"]; ?></td>
		<td>
		<?php if($loss_status_== 0){ ?>		
	<a href="loss.php?loss_id=<?php echo $loss_id_;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
						<form id="loss<?php echo $loss_id_;?>" method="post" onsubmit="return confirm('Are you sure to add this loss to stock ?');">
						<input type="hidden" name="qty" value="<?php echo $rowl['loss_qty']; ?>" />	
						<input type="hidden" name="weight" value="<?php echo $rowl['loss_weight']; ?>" />	
						<input type="hidden" name="pur_id" value="<?php echo $row1['pur_id']; ?>" />	
						<input type="hidden" name="shop_id" value="<?php echo $row1['shop_id']; ?>" />	
						<input type="hidden" name="loss_id" value="<?php echo $loss_id_; ?>" />	
						<input type="hidden" name="inout" value="0" />	
						<input type="hidden" name="type" value="<?php echo $rowl["type"]; ?>" />	
						<input type="submit" value="Finalize" class="btn btn-info btn-xs" />
						</form>
	
	<script>

$(document).ready(function (e) {
$("#loss<?php echo $loss_id_;?>").on('submit',(function(e) {
e.preventDefault();
$('#responsel<?php echo $loss_id_;?>').show();
//$("#loader").show();
$.ajax({
url: "add_stock.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
//$("#loader").hide();
//$('#userForm')[0].reset();
$("#responsel<?php echo $loss_id_;?>").html(data);
}
});

}));
});


</script>



								<span id="responsel<?php echo $loss_id_;?>"> </span>
	
	
								<?php } else {
									echo '<label class="label label-success">Added to stock</label>';				 
								} 
								?>
	   
	   </td>
</tr>


 

						 
		<?php } ?>