<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
  
$cur_date = date("Y-m-d");

	if(isset($_GET["pur_id"]))
	{
	
		$getSQL = "select * from purchase where pur_id = '".$_GET["pur_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$pur_id			 = $rowg["pur_id"];
		$party_name		 = $rowg["party_name"];
		$pur_from		 = $rowg["pur_from"];
		$party_rate	 	 = $rowg["party_rate"];
		$prod_id_		 = $rowg["prod_id"];
		$mandi_rate	 	 = $rowg["mandi_rate"];
		$pur_date	 	 = $rowg["pur_date"];
		$shop_id	 	 = $rowg["shop_id"];
		$p_status	 	 = $rowg["p_status"];
		$qty		 	 = $rowg["qty"];
		$weight		 	 = $rowg["weight"];
		$driver		 	 = $rowg["driver"];
		$vehicle	 	 = $rowg["vehicle"];
		$location	 	 = $rowg["location"];
		$weight_loss 	 = $rowg["weight_loss"];
		$qty_loss	 	 = $rowg["qty_loss"];
		$bird_wgt_loss 	 = $rowg["bird_wgt_loss"];
		
		if($prod_id_ == 9999)
		{
			$pcat_id 	= 9999;
		}
		else
		{
			$pcat_id 	= get_title(pcat_id,$prod_id_,$dbconfig);
		}
	
	}

	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IC - POS</title>

<?php include("style.php"); ?>

<script src="js/jquery.min.js"></script>
<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "add_purchase.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#loader").hide();
//$('#userForm')[0].reset();
$("#response").html(data);
}
});

}));
});


</script>


<script type="text/javascript">
$(document).ready(function()
{
$(".pcl_button").click(function(){

var element = $(this);
var I = element.attr("id");

$("#slidepanel"+I).slideToggle(300);
$(this).toggleClass("active"); 

return false;});});
</script>
<style type="text/css">
	.panel
	{
	display:none;
	}
</style>

</head>
<body>
<div class="page-container list-menu-view">
<!--Leftbar Start Here -->
	<?php include("left_sidebar.php"); ?>
	
<div class="page-content">
    <!--Topbar Start Here -->
		<?php include("header.php"); ?>
		
	<div class="main-container">
			<div class="container-fluid">
				<div class="page-breadcrumb">
					<div class="row">
						<div class="col-md-7">
							<div class="page-breadcrumb-wrap">

								<div class="page-breadcrumb-info">
									<h2 class="breadcrumb-titles">Islamabad Chicken</small></h2>
									<ul class="list-page-breadcrumb">
										<li><a href="#">Home</a>
										</li>
										<li class="active-page"> Purchase </li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-5">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-bars"></i></span>
								<h4>Add Purchase</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Purchase Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										<?php 
										if($shop_ho==1)
										{
										?>
										<div class="form-group hide">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-8">
												<select class="form-control" name=""  >
													<option value="">--Select--</option>
													<?php
													//$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";
													$selectSQL = "select * from shop ORDER BY shop_id ASC";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["shop_id"]; ?>" <?php if($row1["shop_id"]==$shop_id){ echo "selected"; } ?>><?php echo $row1["shop_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />	
										
										<?php } else if($shop_ho==0) { ?>
						
						<input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />	
										
										<?php } ?>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Purchase Date *</label>
											<div class=" col-md-8">
												<input type="date" name="pur_date" min="<?php echo $cur_date; ?>" class="form-control" value="<?php echo $pur_date; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-3">
												<select name="pcat_id" id="cat" required class="form-control">
													<option value="">--Select--</option>
										<option value="9999" <?php if($pcat_id==9999){ echo "selected"; } ?>>Live Chicken</option>			
													<?php 
													$getSQLs = "select * from product_category order by pcat_desc";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
													while($rowgs = mysql_fetch_assoc($Resultgs))
													{
													$pcat_desc_s		 = $rowgs["pcat_desc"];
													$pcat_id_s		 	 = $rowgs["pcat_id"];
													?> 
						
						<option value="<?php echo $pcat_id_s; ?>" <?php if($pcat_id_s==$pcat_id){ echo "selected"; } ?>><?php echo $pcat_desc_s; ?></option>
													<?php } ?>
												</select>
											</div>
											
											<label class="col-md-2 control-label">Product *</label>
											<div class=" col-md-3">
												<select name="prod_id" id="product" required class="form-control">
													<?php
													if(isset($_GET["pur_id"]))
													{
													?>
													<option value="<?php echo $prod_id_; ?>"><?php if($prod_id_=="9999"){ echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); } ?></option>
													<?php } else { ?>
													<option value="">--Select--</option>
													<?php } ?>
												</select>
											</div>
											
											</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Purchase From *</label>
											<div class=" col-md-8">
												<div class="radio">
													<label> <input type="radio" name="pur_from" value="1" required <?php if($pur_from==1){ echo "checked"; } ?>> Farm </label>
													<label> <input type="radio" name="pur_from" value="2" <?php if($pur_from==2){ echo "checked"; } ?>> Mandi </label>
													<label> <input type="radio" name="pur_from" value="3" <?php if($pur_from==3){ echo "checked"; } ?>> Other </label>
												</div>
												 
										 
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Party Name *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="party_name" value="<?php echo $party_name; ?>" placeholder="Enter Party Name" maxlength="100" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Driver Name </label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="driver" value="<?php echo $driver; ?>" placeholder="Enter Driver Name" maxlength="50" >
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Vehicle # </label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="vehicle" value="<?php echo $vehicle; ?>" placeholder="Enter Vehicle Name" maxlength="50" >
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Location </label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="location" value="<?php echo $location; ?>" placeholder="Enter Location Name" maxlength="50" >
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Purchase Rate *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="party_rate" value="<?php echo $party_rate; ?>" placeholder="Enter Purchase Rate" maxlength="10" required>
											</div>
											<label class="col-md-2 control-label">Mandi Rate *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="mandi_rate" value="<?php echo $mandi_rate; ?>" placeholder="Enter Mandi Rate" maxlength="10" required>
											</div>
										</div>
										 
										 
										<div class="form-group">
											<label class="col-md-2 control-label">Qty *</label>
											<div class=" col-md-3">
												<input type="text" name="qty" class="form-control validateNumber" maxlength="5" placeholder="Enter Qty" value="<?php echo $qty; ?>" required>
											</div>
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-3">
												<input type="text" name="weight" class="form-control number" maxlength="7" placeholder="Enter Weight" value="<?php echo $weight; ?>" required>
											</div>
										</div>
									   
										
										<div class="form-group">
											<label class="col-md-2 control-label">Weight Loss (kg) </label>
											<div class=" col-md-2">
												<input type="text" name="weight_loss" class="form-control number" maxlength="5" placeholder="" value="<?php echo $weight_loss; ?>" >
											</div>
											<label class="col-md-3 control-label">Mortality (qty/kg) </label>
											<div class=" col-md-1">
												<input type="text" name="qty_loss" class="form-control validateNumber" maxlength="7" placeholder="" value="<?php echo $qty_loss; ?>" >
											</div>
											<div class=" col-md-2">
												<input type="text" name="bird_wgt_loss" class="form-control number" maxlength="7" placeholder="" value="<?php echo $bird_wgt_loss; ?>" > (kg)
											</div>
										</div>
										
										<?php if(isset($_GET["pur_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="pur_id" value="<?php echo $_GET["pur_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["pur_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="purchase.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="purchase.php" class="btn btn-default">  New  </a>
													<?php } ?>
													
												</div>
											</div>
										</div>
									</form>
											<span id="response"> </span>	
								</div>
							</div>
						</div>
						
						
						
					</div>
					
					</div>
					
					
					<div class="row">
					<div class="col-md-12">
						
						<div class="section-header">
							<h2>Purchases</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Purchase Detail</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Shop
										</th>
										<th>
											Purchase Date 
										</th>
										<th>
											Purchase From
										</th>
										<th>
											Party Name
										</th>
										<th>
											Purchase Rate
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Birds
										</th>
										<th>
											Weight
										</th>
										<th>
											Action
										</th>
										<th>
											Detail
										</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											#
										</th>
										<th>
											Shop
										</th>
										<th>
											Purchase Date 
										</th>
										<th>
											Purchase From
										</th>
										<th>
											Party Name
										</th>
										<th>
											Purchase Rate
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Qty
										</th>
										<th>
											Weight
										</th>
										<th>
											Action
										</th>
										<th>
											Detail
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php
							if($shop_ho==1)
							{
								$selectSQL = "select * from purchase ORDER BY pur_id desc";
							} else if($shop_ho==0)
							{
								$selectSQL = "select * from purchase where shop_id = '".$_SESSION["s_id"]."'";
							}
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pur_id'];
								$p_status_  	= $row1['p_status'];
								$shop_id_  		= $row1['shop_id'];
								$pur_date_  	= $row1['pur_date'];
								$pur_from_  	= $row1['pur_from'];
								$party_name_  	= $row1['party_name'];
								$party_rate_  	= $row1['party_rate'];
								$prod_id__  	= $row1['prod_id'];
								$mandi_rate_  	= $row1['mandi_rate'];
								$qty_  			= $row1['qty'];
								$weight_  		= $row1['weight'];
								$driver_  		= $row1['driver'];
								$vehicle_  		= $row1['vehicle'];
								$location_  	= $row1['location'];
								$weight_loss_  	= $row1['weight_loss'];
								$qty_loss_  	= $row1['qty_loss'];
								$bird_wgt_loss_ = $row1['bird_wgt_loss'];
								
								$loss_status = get_title(loss_status,$id,$dbconfig);
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $pur_date_; ?>
										</td>
										<td>
											<?php 
											switch($pur_from_)
											{
												case 1:
												echo "Farm";
												break;
												case 2:
												echo "Mandi";
												break;
												case 3:
												echo "Other";
												break;
											}
											?>
										</td>
										<td>
											<?php echo $party_name_; ?>
										</td>
										<td>
											<?php echo $party_rate_; ?>
										</td>
										<td>
											<?php echo $mandi_rate_; ?>
										</td>
										<td>
											<?php echo $qty_; ?>
										</td>
										<td>
											<?php echo $weight_; ?>
										</td>
										  
									 
									  
										<td>
								<?php if($p_status_==0){ ?>		
	<a href="purchase.php?pur_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
						<form id="stock<?php echo $id;?>" method="post" >
						<input type="hidden" name="pur_id" value="<?php echo $row1['pur_id']; ?>" />	
						<input type="hidden" name="shop_id" value="<?php echo $row1['shop_id']; ?>" />	
						<input type="submit" value="Finalize" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to add this purchase to stock ?');" />
						</form>
	
	<script>

$(document).ready(function (e) {
$("#stock<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
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
$("#response<?php echo $id;?>").html(data);
}
});

}));
});


</script>
								<span id="response<?php echo $id;?>"> </span>
	
	
								<?php } else {
									echo '<label class="label label-success">Purchase stock updated</label>';
									//echo $pur_date_; echo $cur_date;
									?>
							 
								<?php
								} 
								?>
								</td>
								<td>
								
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $id;?>"><i class="fa fa-file-word-o"></i></button>					
				
		<!-- Modal -->
<div id="myModal<?php echo $id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Purchase Detail</h4>
      </div>
      <div class="modal-body">
        <table class="table">
									<thead>
									<tr>
										 <th> Purchase By </th>
										<th> <?php echo get_title(shop_name,$shop_id_,$dbconfig); ?> </th>
									</tr>
									 <tr>
										<th> Purchase Date </th>
										<th> <?php echo $pur_date_; ?> </th>
										</tr>
										<tr>
										<th> Product </th>
										<th> <?php if($prod_id__=="9999"){ echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id__,$dbconfig); } ?> </th>
										</tr>
										<tr>
										<th> Purchase From </th>
										<th> <?php 
											switch($pur_from_)
											{
												case 1:
												echo "Farm";
												break;
												case 2:
												echo "Mandi";
												break;
												case 3:
												echo "Other";
												break;
											}
											?> </th>
										</tr>
										<tr>
										<th> Party Name </th>
										<th> <?php echo $party_name_; ?> </th>
										</tr>
										<tr>
										<th> Purchase Rate </th>
										<th> <?php echo $party_rate_; ?> </th>
										</tr>
										<tr>
										<th> Mandi Rate </th>
										<th>  <?php echo $mandi_rate_; ?></th>
										</tr>
										<tr>
										<th> Qty </th>
										<th> <?php echo $qty_; ?> </th>
										</tr>
										<tr>
										<th> Weight (kg) </th>
										<th> <?php echo $weight_; ?> </th>
										</tr>
										<tr>
										<th> Driver </th>
										<th> <?php echo $driver_; ?> </th>
										</tr>
										<tr>
										<th> Vehicle </th>
										<th><?php echo $vehicle_; ?> </th>
										</tr>
										<tr>
										<th> Location </th>
										<th> <?php echo $location_; ?> </th>
										</tr>
										<tr>
										<th> Wgt Loss (kg) </th>
										<th> <?php echo $weight_loss_; ?> </th>
										</tr>
										<tr>
										<th> Mortality (qty/kg) </th>
										<th><?php echo $qty_loss_; ?> / <?php echo $bird_wgt_loss_; ?> </th>
										</tr>
										
										
									</thead>
									 
									<tbody>
									</tbody>
									</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>			
								
										</td>
									</tr>
							
							
							
										<?php } ?>
								
									</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				
				
			</div>
		</div>
    <!--Footer Start Here -->
   <?php include("footer.php"); ?>
	</div>
</div>
<!--Rightbar Start Here -->

<?php include("right_sidebar.php"); ?>
		
<?php include("scripts.php"); ?>

<script>
$("select#cat").change(function(){

	var cat =  $("select#cat option:selected").attr('value'); 
	//alert(cat);
	//$("#product").html( "" );
	//$("#location").html( "" );
	
	if (cat.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-records.php",
			data: "cat="+cat,
			cache: false,
			beforeSend: function () { 
				$('#product').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#product").html( html );
			}
		});
	} 
});
</script>


</body>
</html>
