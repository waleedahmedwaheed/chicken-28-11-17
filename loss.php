<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

 $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;

	if(isset($_GET["loss_id"]))
	{
	
		$getSQL = "select * from loss where loss_id = '".$_GET["loss_id"]."' and loss_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$shop_id	 	 = $rowg["shop_id"];
		$prod_id	 	 = $rowg["prod_id"];
		$loss_id	 	 = $rowg["loss_id"];
		$loss_status	 = $rowg["loss_status"];
		$loss_qty		 = $rowg["loss_qty"];
		$loss_weight	 = $rowg["loss_weight"];
		
		if($prod_id == 9999)
		{
			$pcat_id 	= 9999;
		}
		else
		{
			$pcat_id 	= get_title(pcat_id,$prod_id,$dbconfig);
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
url: "add_loss.php", // Url to which the request is send
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
										<li class="active-page"> Loss </li>
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
								<h4>Add Loss</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Loss Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										<?php 
										if($shop_ho==1)
										{
										?>
										<div class="form-group">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-8">
												<select class="form-control" name="shop_id" required >
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
										<?php } else if($shop_ho==0) { ?>
						
						<input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />	
										
										<?php } ?>
								  
										<div class="form-group">
											<label class="col-md-2 control-label">Product Category </label>
											<div class=" col-md-8">
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
											<div class=" col-md-2">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Product </label>
											<div class=" col-md-8">
												<select name="prod_id" id="product" required class="form-control">
													
													<?php
													if(isset($_GET["loss_id"]))
													{
													?>
													<option value="<?php echo $prod_id; ?>"><?php if($prod_id=="9999"){ echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id,$dbconfig); } ?></option>
													<?php } else { ?>
													<option value="">--Select--</option>
													<?php } ?>
													
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Qty *</label>
											<div class=" col-md-3">
												<input type="text" name="loss_qty" class="form-control validateNumber" maxlength="5" value="<?php echo $loss_qty; ?>" >
											</div>
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-3">
												<input type="text" name="loss_weight" class="form-control number" maxlength="7" value="<?php echo $loss_weight; ?>" required>
											</div>
										</div>
										
									 
										<?php if(isset($_GET["loss_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="loss_id" value="<?php echo $_GET["loss_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["loss_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="loss.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="loss.php" class="btn btn-default">  New  </a>
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
							<h2>Loss</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Loss Detail</h4>
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
											Product
										</th>
										<th>
											Qty
										</th>
										<th>
											Weight<small> (kg) </small>
										</th>
										<th>
											Date
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
											Shop
										</th>
										<th>
											Product
										</th>
										<th>
											Qty
										</th>
										<th>
											Weight<small> (kg) </small>
										</th>
										<th>
											Date
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from loss ORDER BY loss_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['loss_id'];
								$shop_id_		= $row1['shop_id'];
								$prod_id_		= $row1['prod_id'];
								$loss_qty_		= $row1['loss_qty'];
								$loss_weight_	= $row1['loss_weight'];
								$loss_datetime_	= $row1['loss_datetime'];
								$loss_status_  	= $row1['loss_status'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php if($prod_id_=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); }; ?>
										</td>
										<td>
											<?php echo $loss_qty_; ?>
										</td>
										<td>
											<?php echo $loss_weight_; ?>
										</td>
										<td>
											<?php echo $loss_datetime_; ?>
										</td>
										<td>
								<?php if($loss_status_==0){ ?>		
	<a href="loss.php?loss_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
							
									<form id="stock<?php echo $id;?>" method="post" >
						<input type="hidden" name="loss_id" value="<?php echo $id; ?>" />	
						<input type="submit" value="Finalize" class="btn btn-info btn-xs" onclick="return confirm('Are you sure to add this loss to stock ?');" />
						</form>
	
	<script>

$(document).ready(function (e) {
$("#stock<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_loss_pro.php", // Url to which the request is send
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
		
								<?php	}
									else if($loss_status_==2){
									echo '<label class="label label-success"> Added to stock</label>';	
								} ?>
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
