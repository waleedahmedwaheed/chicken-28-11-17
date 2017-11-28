<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

  $cur_date = date("Y-m-d");
  
	 	if(isset($_GET["co_id"]))
		{
	
		$getSQL = "select * from cust_order where co_id = '".$_GET["co_id"]."' and co_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$co_id		 	 = $rowg["co_id"];
		$cust_id	 	 = $rowg["cust_id"];
		$co_date	 	 = $rowg["co_date"];
		$co_status	 	 = $rowg["co_status"];
		
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
url: "add_cust_order.php", // Url to which the request is send
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
										<li class="active-page"> Customer Order </li>
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
								<h4>Add Order</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h3> <center><?php $date = date('Y-m-d'); echo date('l jS \of F Y'); ?> </center> </h3>
									</div>
									
									<form class="form-horizontal" method="post" id="userForm">
										<div class="form-group">
											<label class="col-md-2 control-label">Customer Name *</label>
											<div class=" col-md-8">
												<select class="form-control" name="cust_id" required >
													<option value="">--Select Customer--</option>
													<?php
													//$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";
													$selectSQL = "select * from customer where cust_status = 0 ORDER BY cust_name ASC";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["cust_id"]; ?>" <?php if($row1["cust_id"]==$cust_id){ echo "selected"; } ?>><?php echo $row1["cust_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Date *</label>
											<div class=" col-md-8">
												<input type="date" min="<?php echo  $cur_date; ?>" name="co_date" class="form-control" value="<?php echo $co_date; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<?php if(isset($_GET["co_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="co_id" value="<?php echo $_GET["co_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
											<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["co_id"]))
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
											Customer 
										</th>
										<th>
											Date
										</th>
										 <th>
											Action
										</th>
										<th>
											Detail
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
											Customer 
										</th>
										<th>
											Date
										</th>
										 <th>
											Action
										</th>
										<th>
											Detail
										</th>
										<th>
											Status
										</th>
									</tr>
									</tfoot>
									<tbody>
									 
								  <?php	
							$selectSQL = "select * from cust_order ORDER BY co_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['co_id'];
								$cust_id_		= $row1['cust_id'];
								$co_date_  		= $row1['co_date'];
								$co_status_  	= $row1['co_status'];
								$cod_status_	= get_title(cod_status,$id,$dbconfig);	
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(cust_name,$cust_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $co_date_; ?>
										</td>
										 
										<td>
								<?php if($co_status_==0){ ?>		
	<a href="cust_order.php?co_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
				  
	
								<?php } else if($co_status_==1) {
									echo '<label class="label label-success">Sent to customer</label>';
									 
								}
								else if($co_status_==2) {
									echo '<label class="label label-success">Approved</label>';
									 
								}
								else if($co_status_==3) {
									echo '<label class="label label-success">Received</label>';
									 
								}
								else
								{
									echo "";
								}									
								?>
										</td>
										
										<td>
										<?php if($co_status_==0){ ?>		
	<a href="cust_order_prod.php?co_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-plus"></i> Products</a> <br>	
										<?php } else if($co_status_==1){ ?>		
	<a href="cust_order_prod.php?co_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-plus"></i> Delivered Products</a> <br>	
										<?php } ?>
										
										</td>
										
										<td>
	<a href="cust_order_print.php?co_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-print"></i> </a>	
							
							<?php if($co_status_==0){ ?>		
						<form id="stock<?php echo $id;?>" method="post">
						<input type="hidden" name="co_id" value="<?php echo $id; ?>" /> 
						<input type="submit" value="Send to Customer?" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to send to customer ?');" />
						</form>
						
		<script>

$(document).ready(function (e) {
$("#stock<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_cust_pro.php", // Url to which the request is send
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
window.location='cust_order.php';
}
});

}));
});


</script>				
							<?php } 

							if($cod_status_==3)
							{
							?>	
							 	
						<form id="stockr<?php echo $id;?>" method="post">
						<input type="hidden" name="co_id" value="<?php echo $id; ?>" /> 
						<input type="submit" value="Finalize" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to approve ?');" />
						</form>
						<span id="response<?php echo $id;?>"> </span>
		<script>

$(document).ready(function (e) {
$("#stockr<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_cust_received.php", // Url to which the request is send
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