<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	if(isset($_GET["shop_id"]))
	{
	
		$getSQL = "select * from shop where shop_id = '".$_GET["shop_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$shop_name		 = $rowg["shop_name"];
		$shop_address	 = $rowg["shop_address"];
		$shop_contact	 = $rowg["shop_contact"];
	
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
url: "add_shop.php", // Url to which the request is send
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
									<h2 class="breadcrumb-titles">Islamabad Chicken Shops</small></h2>
									<ul class="list-page-breadcrumb">
										<li><a href="#">Home</a>
										</li>
										<li class="active-page"> Shops </li>
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
								<h4>Add Shop</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Shop Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										<div class="form-group">
											<label class="col-md-2 control-label">Name *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="shop_name" value="<?php echo $shop_name; ?>" placeholder="Enter Name" maxlength="50" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Address *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="shop_address" value="<?php echo $shop_address; ?>" placeholder="Enter Address" maxlength="100" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Contact *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="shop_contact" value="<?php echo $shop_contact; ?>" placeholder="Enter Contact" maxlength="15" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<?php if(isset($_GET["shop_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="shop_id" value="<?php echo $_GET["shop_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["shop_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="shop.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="shop.php" class="btn btn-default">  New  </a>
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
							<h2>Shops</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Shops</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											Name
										</th>
										<th>
											Address
										</th>
										<th>
											Contact
										</th>
										<th>
											Action
										</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											Name
										</th>
										<th>
											Address
										</th>
										<th>
											Contact
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from shop ORDER BY shop_id ASC";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id=$row1['shop_id'];
											
									?>
									<tr>
										<td>
											<?php echo $row1['shop_name']; ?>
										</td>
										<td>
											<?php echo $row1['shop_address']; ?>
										</td>
										<td>
											<?php echo $row1['shop_contact']; ?>
										</td>
										<td>
	<a href="shop.php?shop_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
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