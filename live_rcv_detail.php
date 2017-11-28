<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	 	if(isset($_GET["tr_id"]))
		{
	
		$getSQL = "select * from live_transfer where tr_id = '".$_GET["tr_id"]."' and tr_status = 1";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$id			 	 = $rowg["tr_id"];
		$shop_id_	 	 = $rowg["shop_id"];
		$s_qty_		 	 = $rowg["s_qty"];
		$s_weight_	 	 = $rowg["s_weight"];
		$tr_status_	 	 = $rowg["tr_status"];
		
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
										<li class="active-page"> Live Chicken </li>
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
								<h4>Live Chicken</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2> <center><?php echo get_title(shop_name,$_SESSION["s_id"],$dbconfig); ?> </center> </h2>
										<h3> <center><?php $date = date('Y-m-d'); echo date('l jS \of F Y'); ?> </center> </h3>
									</div>
									
							  
									<table class="table">
									<thead>
									<tr>
										 <th>
											Qty
										</th>
										<th>
											Weight <small> (kg) </small>
										</th>
										<th>
											Action
										</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										 <th>
											Qty
										</th>
										<th>
											Weight <small> (kg) </small>
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									 
								  
									
				<form id="stock<?php echo $id;?>" method="post" >
									
									<tr>
										  <td width="20%">
											<input type="text" name="s_qty" id="s_qty" value="<?php echo $s_qty_; ?>"  class="validateNumber form-control" placeholder="0.00" style="width: 50%;" />
										</td>
										<td width="20%">
											<input type="text" name="s_weight" id="s_weight" value="<?php echo $s_weight_; ?>"  class="validateNumber form-control" placeholder="0.00" style="width: 50%;" />
										</td>
										  
										
										<td width="30%">
	 					 	
					
						 <input type="hidden" name="tr_id" value="<?php echo $id; ?>" /> 
						 <input type="submit" value="Verify" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to verify this product?')" />
						</form>
						
						<span id="response<?php echo $id;?>"> </span>
		<script>

$(document).ready(function (e) {
$("#stock<?php echo $id;?>").on('submit',(function(e) {
e.preventDefault();
$('#response<?php echo $id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_live_rcv.php", // Url to which the request is send
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
//window.location='live_rcv.php';
}
});

}));
});


</script>				
							 
										</td>
									
									</tr>
							  
									
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