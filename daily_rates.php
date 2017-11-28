<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

 $cur_date = date("Y-m-d");

$shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);

	if(isset($_GET["mr_id"]))
	{
	
		$getSQL = "select * from daily_rates where mr_id = '".$_GET["mr_id"]."' and mr_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$mr_id			 = $rowg["mr_id"];
		$mr_rate	 	 = $rowg["mr_rate"];
		$cur_date	 	 = $rowg["cur_date"];
		$shop_id	 	 = $rowg["shop_id"];
		$sale_rate 	 	 = $rowg["mr_rate"];
	
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
url: "add_daily_rates.php", // Url to which the request is send
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
										<li class="active-page"> Daily Rates </li>
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
								<h4>Add Live Chicken Rate</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Rate Details of Live Chicken</h2>
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
										<?php }  else if($shop_ho==0) { ?>
						
						<input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />	
										
										<?php } ?>
										
										<div class="form-group">
											<label class="col-md-2 control-label"> Date *</label>
											<div class=" col-md-8">
												<input type="date" min="<?php echo $cur_date; ?>" name="cur_date" class="form-control" value="<?php echo $cur_date; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
									  
										<div class="form-group">
											<label class="col-md-2 control-label">Mandi Rate *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="mr_rate" value="<?php echo $mr_rate; ?>" placeholder="Enter Mandi Rate" maxlength="10" required>
											</div>
											
											<label class="col-md-2 control-label">Sale Rate *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="sale_rate" value="<?php echo $sale_rate; ?>" placeholder="Enter Sale Rate" maxlength="10" required>
											</div>
											
										</div>
										 
										 
										 
										
										<?php if(isset($_GET["mr_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="mr_id" value="<?php echo $_GET["mr_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["mr_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="daily_rates.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="daily_rates.php" class="btn btn-default">  New  </a>
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
							<h2>Rates</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Rates Detail</h4>
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
											Date 
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Sale Rate
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
											Date 
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Sale Rate
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from daily_rates ORDER BY mr_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['mr_id'];
								$shop_id_  		= $row1['shop_id'];
								$cur_date_  	= $row1['cur_date'];
								$sale_rate_  	= $row1['sale_rate'];
								$mr_rate_  		= $row1['mr_rate'];
								$mr_status_  	= $row1['mr_status'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $cur_date_; ?>
										</td>
										<td>
											<?php echo $mr_rate_; ?>
										</td>
										<td>
											<?php echo $sale_rate_; ?>
										</td>
										 
									  
										<td>
								<?php if(($mr_status_==0) and ($cur_date==$cur_date_)){ ?>		
	<a href="daily_rates.php?mr_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	  
	
								<?php } else {
									 
								} 
								?>
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
