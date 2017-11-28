<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

  $shop_ho 	= $_SESSION['shop_head'];
 if($shop_ho==0)
 {
	 echo "<script>window.location='index.php'</script>";
 }
 
 $cur_date = date("Y-m-d");
	 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;

	if(isset($_GET["pro_id"]))
	{
	
		$getSQL = "select * from production where pro_id = '".$_GET["pro_id"]."' and pro_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$daily_rate	 	 = $rowg["daily_rate"];
		$pro_date	 	 = $rowg["pro_date"];
		$pro_status	 	 = $rowg["pro_status"];
		$pr_qty		 	 = $rowg["pr_qty"];
		$pr_weight		 = $rowg["pr_weight"];
		$dress_weight	 = $rowg["dress_weight"];
		$perc			 = $rowg["perc"];
	
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
url: "add_production.php", // Url to which the request is send
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

$( document ).ready(function() {  
$("#dress_weight").bind("propertychange change keyup paste input", function(){

	calc();

});
});

function calc() {

		var first_number 	= parseInt(document.getElementById("dress_weight").value);
		var second_number 	= parseInt(document.getElementById("pr_weight").value);
		var result 			= parseInt((first_number/second_number)*100);
		  
            document.getElementById("perc").value = result;
        }
		
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
										<li class="active-page"> Production </li>
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
								<h4>Add Production</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Production Detail</h2>
										<h4 style="text-align:right;">Stock Detail</h4>
			<h6 style="text-align:right;">No of Chicken : <?php echo $live_qty = get_stock(live_qty,get_title(shop_head,1,$dbconfig),9999,$dbconfig); ?>
										Weight : <?php echo $live_weight = get_stock(live_weight,get_title(shop_head,1,$dbconfig),9999,$dbconfig);?></h6>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										<div class="form-group">
											<label class="col-md-2 control-label"> Date *</label>
											<div class=" col-md-8">
												<input type="date" min="<?php echo $cur_date; ?>" name="pro_date" class="form-control" value="<?php echo $pro_date; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Number of Chicken *</label>
											<div class=" col-md-3">
												<input type="text" name="pr_qty" class="form-control validateNumber" maxlength="5" placeholder="Enter no of Birds" value="<?php echo $pr_qty; ?>" required>
											</div>
											<label class="col-md-2 control-label">Weight (kg) *</label>
											<div class=" col-md-3">
												<input type="text" name="pr_weight" id="pr_weight" class="form-control number" maxlength="7" placeholder="Enter Weight" value="<?php echo $pr_weight; ?>" required>
											</div>
										</div>
									 
										<div class="form-group">
											<label class="col-md-2 control-label">Daily Rate *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="daily_rate" value="<?php echo get_mandirate(mr_rate,get_title(shop_head,1),date("Y-m-d"),$dbconfig); ?>" placeholder="Enter Daily Rate" maxlength="10" readonly required>
											</div>
											<label class="col-md-2 control-label">Dress Weight (kg) *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="dress_weight" id="dress_weight"  value="<?php echo $dress_weight; ?>" maxlength="10" required>
											</div>
										</div>
										 
										<div class="form-group">
											<label class="col-md-2 control-label">Percentage %</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="perc" id="perc" value="<?php echo $perc; ?>" maxlength="10" readonly >
											</div>
											 
										</div>
										 
										 
										  
										
										<?php if(isset($_GET["pro_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="pro_id" value="<?php echo $_GET["pro_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["pro_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="production.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="production.php" class="btn btn-default">  New  </a>
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
							<h2>Production</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Production Detail</h4>
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
											Date
										</th>
										<th>
											Qty 
										</th>
										<th>
											Weight
										</th>
										<th>
											Daily Rate
										</th>
										<th>
											Avg Weight
										</th>
										<th>
											Dress Weight
										</th>
										<th>
											Per (%)
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
											Date
										</th>
										<th>
											Qty 
										</th>
										<th>
											Weight (kg)
										</th>
										<th>
											Daily Rate
										</th>
										<th>
											Avg Weight (kg)
										</th>
										<th>
											Dress Weight (kg)
										</th>
										<th>
											Per (%)
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
							$selectSQL = "select * from production ORDER BY pro_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pro_id'];
								$pro_status_  	= $row1['pro_status'];
								$pro_date_  	= $row1['pro_date'];
								$pro_datetime_ 	= $row1['pro_datetime'];
								$daily_rate_  	= $row1['daily_rate'];
								$pr_qty_  		= $row1['pr_qty'];
								$pr_weight_  	= $row1['pr_weight'];
								$dress_weight_  = $row1['dress_weight'];
								$perc_  		= $row1['perc'];
								$avg_wgt		= $pr_weight_/$pr_qty_;
								
								$pp_prod_fn 	= get_title(pp_prod_fn,$id,$dbconfig)
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo $pro_datetime_; ?>
										</td>
										<td>
											<?php echo $pr_qty_; ?>
										</td>
										<td>
											<?php echo $pr_weight_; ?>
										</td>
										<td>
											<?php echo $daily_rate_; ?>
										</td>
										<td>
											<?php echo number_format($avg_wgt,2); ?>
										</td>
										<td>
											<?php echo $dress_weight_; ?>
										</td>
										<td>
											<?php echo $perc_; ?>
										</td>
										 
										<td>
								<?php if($pro_status_==0){ ?>		
	<a href="production.php?pro_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
				 
	
	
								<span id="response<?php echo $id;?>"> </span>
	
	
								<?php } else if($pro_status_==2) {
									echo '<label class="label label-success">Added to stock</label>';
									?>
				 	
								<?php
								}
								else
								{
									echo "";
								}									
								?>
										</td>
										
										<td>
										<?php if($pro_status_==0){ ?>		
	<a href="batches.php?pro_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-plus"></i> Batches</a>	<br>
	<a href="pro_products.php?pro_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-plus"></i> Products</a> <br>	
	
	
										<?php } ?>
										
										</td>
										<td>
	<a href="production_print.php?pro_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-print"></i> </a>	
							
							<?php if($pp_prod_fn>0){ ?>		
						<form id="stock<?php echo $id;?>" method="post" >
						<input type="hidden" name="pro_id" value="<?php echo $id; ?>" /> 
						<input type="submit" value="Finalize" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to add production to stock ?');" />
						</form>
						
		<script>

$(document).ready(function (e) {
$("#stock<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_pro_stock.php", // Url to which the request is send
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
