<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;

	if(isset($_GET["pur_id"]))
	{
	
		$getSQL = "select * from purchase where pur_id = '".$_GET["pur_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$farm_name		 = $rowg["farm_name"];
		$farm_rate	 	 = $rowg["farm_rate"];
		$mandi_rate	 	 = $rowg["mandi_rate"];
		$pur_date	 	 = $rowg["pur_date"];
		$shop_id	 	 = $rowg["shop_id"];
		$p_status	 	 = $rowg["p_status"];
		$qty		 	 = $rowg["qty"];
		$weight		 	 = $rowg["weight"];
	
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="A Components Mix Bootstarp 3 Admin Dashboard Template">
<meta name="author" content="Westilian">
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
										<div class="form-group">
											<label class="col-md-2 control-label">Farm Name *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="farm_name" value="<?php echo $farm_name; ?>" placeholder="Enter purchase Name" maxlength="100" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Farm Rate *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="farm_rate" value="<?php echo $farm_rate; ?>" placeholder="Enter purchase Rate" maxlength="10" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Mandi Rate *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="mandi_rate" value="<?php echo $mandi_rate; ?>" placeholder="Enter Mandi Rate" maxlength="10" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Purchase Date *</label>
											<div class=" col-md-8">
												<input type="text" name="pur_date" class="form-control input-date-picker" value="<?php echo $pur_date; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Birds *</label>
											<div class=" col-md-8">
												<input type="text" name="qty" class="form-control" maxlength="5" placeholder="Enter no of Birds" value="<?php echo $qty; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-8">
												<input type="text" name="weight" class="form-control" maxlength="7" placeholder="Enter Weight" value="<?php echo $weight; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-8">
												<select class="form-control" name="shop_id" required >
													<option value="">--Select--</option>
													<?php
													$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["shop_id"]; ?>" <?php if($row1["shop_id"]==$_SESSION["s_id"]){ echo "selected"; } ?>><?php echo $row1["shop_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
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
									<table class="table ">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Name
										</th>
										<th>
											Farm Rate
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Purchase Date
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
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											#
										</th>
										<th>
											Name
										</th>
										<th>
											Farm Rate
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Purchase Date
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
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from purchase ORDER BY pur_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id			= $row1['pur_id'];
								$p_status_  = $row1['p_status'];
											
									?>
									<tr>
										<td>
		<input type="button"  value="+"  class="pcl_button" id="<?php echo $id; ?>" />
										</td>
										<td>
											<?php echo $row1['farm_name']; ?>
										</td>
										<td>
											<?php echo $row1['farm_rate']; ?>
										</td>
										<td>
											<?php echo $row1['mandi_rate']; ?>
										</td>
										<td>
											<?php echo $row1['pur_date']; ?>
										</td>
										<td>
											<?php echo $row1['qty']; ?>
										</td>
										<td>
											<?php echo $row1['weight']; ?>
										</td>
										<td>
								<?php if($p_status_==0){ ?>		
	<a href="purchase.php?pur_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
						<form id="stock<?php echo $id;?>" method="post" onsubmit="return confirm('Are you sure to add this purchase to stock ?');">
						<input type="hidden" name="qty" value="<?php echo $row1['qty']; ?>" />	
						<input type="hidden" name="weight" value="<?php echo $row1['weight']; ?>" />	
						<input type="hidden" name="pur_id" value="<?php echo $row1['pur_id']; ?>" />	
						<input type="hidden" name="shop_id" value="<?php echo $row1['shop_id']; ?>" />	
						<input type="hidden" name="inout" value="1" />	
						<input type="hidden" name="type" value="1" />	
						<input type="submit" value="Finalize" class="btn btn-info" />
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
									echo '<label class="label label-success">Added to stock</label>';
									?>
				<label class="label label-danger"><a style="color:white;" href="loss.php?pur_id=<?php echo $id; ?>"> Add Loss </a></label>	
								<?php
								} 
								?>
										</td>
									</tr>
							
							<tr   class='panel' id="slidepanel<?php echo $id; ?>" >

                      
<td id="<?php echo $id; ?>" colspan="8"> <!-- Print Voucher -->

<table class="table">
<thead>
	<tr class="info">
		<th>Loss Type</th>
		<th>Type</th>
		<th>Birds</th>
		<th>Product</th>
		<th>Weight</th>
		<th>Status</th>
	</tr>
</thead>
	<tbody>
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
  
</tbody>
</table>	 				  

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



</body>
</html>
