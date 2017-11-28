<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

 $shop_ho 	= $_SESSION['shop_head'];
 
 
	 	if(isset($_GET["tr_id"]))
		{
	
		$getSQL = "select * from live_transfer where tr_id = '".$_GET["tr_id"]."' and tr_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$tr_id		 	 = $rowg["tr_id"];
		$shop_id	 	 = $rowg["shop_id"];
		$s_qty		 	 = $rowg["s_qty"];
		$s_weight	 	 = $rowg["s_weight"];
		$tr_status	 	 = $rowg["tr_status"];
		
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
url: "add_live_transfer.php", // Url to which the request is send
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
										<li class="active-page"> Live Chicken Transfer </li>
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
								<h4>Add Chicken </h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
										<div class="page-header">
										 <h4 style="text-align:right;">Stock Detail</h4>
				<?php if($shop_ho==1){ ?>						 
			<h6 style="text-align:right;">No of Chicken : <?php echo $live_qty = get_stock(live_qty,get_title(shop_head,1,$dbconfig),9999,$dbconfig); ?>
										Weight : <?php echo $live_weight = get_stock(live_weight,get_title(shop_head,1,$dbconfig),9999,$dbconfig);?></h6>
				<?php } else { ?>	
			<h6 style="text-align:right;">No of Chicken : <?php echo $live_qty = get_stock(live_qty,$_SESSION["s_id"],9999,$dbconfig); ?>
										Weight : <?php echo $live_weight = get_stock(live_weight,$_SESSION["s_id"],9999,$dbconfig);?></h6>
				<?php } ?>			
									</div>
									
									<form class="form-horizontal" method="post" id="userForm">
									
									<input type="hidden" name="s_shop_id" value="<?php echo $_SESSION['s_id']; ?>" />
									
										<div class="form-group">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-8">
												<select class="form-control" name="shop_id" required >
													<option value="">--Select--</option>
													<?php
													//$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";
													if($shop_ho==1){
													$selectSQL = "select * from shop where shop_head <> 1 ORDER BY shop_id ASC";
													}
													else
													{
													$selectSQL = "select * from shop where shop_id <> '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";	
													}
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
										
										<div class="form-group">
											<label class="col-md-2 control-label">Number of Chicken *</label>
											<div class=" col-md-3">
												<input type="text" name="s_qty" class="form-control validateNumber" maxlength="5" placeholder="Enter no of Birds" value="<?php echo $s_qty; ?>" required>
											</div>
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-3">
												<input type="text" name="s_weight" class="form-control number" maxlength="7" placeholder="Enter Weight" value="<?php echo $s_weight; ?>" required>
											</div>
										</div>
										
										<?php if(isset($_GET["tr_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="tr_id" value="<?php echo $_GET["tr_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
											<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["tr_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="prod_processed.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="prod_processed.php" class="btn btn-default">  New  </a>
													<?php } ?>
													
												</div>
											</div>
										</div>
										
									</form>	
										
										<span id="response"> </span>
										
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
											Date
										</th>
										 <th>
											Action
										</th>
										 <th>
											Status
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
											Date
										</th>
										 <th>
											Action
										</th>
										 <th>
											Status
										</th>
									</tr>
									</tfoot>
									<tbody>
									 
								  <?php	
							$selectSQL = "select * from live_transfer ORDER BY tr_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['tr_id'];
								$shop_id_  		= $row1['shop_id'];
								$tr_datetime_  	= $row1['tr_datetime'];
								$tr_status_  	= $row1['tr_status'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $tr_datetime_; ?>
										</td>
										 
										<td>
								<?php if($tr_status_==0){ ?>		
	<a href="live_transfer.php?tr_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
				  
	
								<?php } else if($tr_status_==1) {
									echo '<label class="label label-success">Sent to shop</label>';
									 
								}
								else if($tr_status_==2) {
									echo '<label class="label label-success">Approved</label>';
									 
								}
								else if($tr_status_==4) {
									echo '<label class="label label-success">Verified</label>';
									 
								}
								else
								{
									echo "";
								}									
								?>
										</td>
										
									 
										<td>
	<a href="live_print.php?tr_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-print"></i> </a>	
							
							<?php if($tr_status_==0){ ?>		
						<form id="stockli<?php echo $id;?>" method="post" >
						<input type="hidden" name="tr_id" value="<?php echo $id; ?>" /> 
						<input type="submit" value="Send to Shop?" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to transfer to shop?')" />
						</form>
						
						<span id="response<?php echo $id;?>"> </span>
		<script>

$(document).ready(function (e) {
$("#stockli<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_live_pro.php", // Url to which the request is send
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
//window.location='live_transfer.php';
}
});

}));
});


</script>				
							<?php } ?>
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