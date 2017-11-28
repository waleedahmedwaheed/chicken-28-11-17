<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	 	if(isset($_GET["ppr_id"]))
		{
	
		$getSQL = "select * from prod_processed where ppr_id = '".$_GET["ppr_id"]."' and ppr_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$ppr_id		 	 = $rowg["ppr_id"];
		$shop_id	 	 = $rowg["shop_id"];
		$ppr_date	 	 = $rowg["ppr_date"];
		$ppr_status	 	 = $rowg["ppr_status"];
		
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
url: "add_prod_processed.php", // Url to which the request is send
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
										<li class="active-page"> Chiller </li>
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
								<h4>Chiller Received </h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2> <center><?php echo get_title(shop_name,$_SESSION["s_id"],$dbconfig); ?> </center> </h2>
										<h3> <center><?php $date = date('Y-m-d'); echo date('l jS \of F Y'); ?> </center> </h3>
									</div>
									
							  
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
											Date
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
							$selectSQL = "select * from prod_processed where shop_id = '".$_SESSION['s_id']."' ORDER BY ppr_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['ppr_id'];
								$shop_id_  		= $row1['shop_id'];
								$s_shop_id_		= $row1['s_shop_id'];
								$ppr_date_  	= $row1['ppr_date'];
								$ppr_status_  	= $row1['ppr_status'];
								$ppr_rcv_fn		= get_title(ppr_rcv_fn,$id,$dbconfig);
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$s_shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $ppr_date_; ?>
										</td>
										 
										<td>
								<?php if($ppr_status_==1) {
									echo '<label class="label label-success">Received at shop</label>';
									 
								}
								else if($ppr_status_==2) {
									echo '<label class="label label-success">Approved</label>';
									 
								}
								else if($ppr_status_==4) {
									echo '<label class="label label-success">Verified</label>';
									 
								}
								else
								{
									echo "";
								}									
								?>
										</td>
										
										 
										
										<td>
										<?php if($ppr_status_==1){ ?>
	<a href="prod_rcv_detail.php?ppr_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-plus"></i></a>	
										<?php } ?>
	<a href="processed_print.php?ppr_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-print"></i> </a>	
							
							<?php if($ppr_rcv_fn==3){ ?>		
						<form id="stock<?php echo $id;?>" method="post" >
						<input type="hidden" name="ppr_id" value="<?php echo $id; ?>" /> 
						<input type="submit" value="Finalize" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to update stock?')" />
						</form>
						
		<script>

$(document).ready(function (e) {
$("#stock<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_pro_received.php", // Url to which the request is send
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
window.location='prod_rcv.php';
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