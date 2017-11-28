<?php include("db/dbcon.php"); 
 include("functions.php"); 
error_reporting(0);
session_start();

	if(isset($_GET["cust_id"]))
	{
	
		$getSQL = "select * from customer where cust_id = '".$_GET["cust_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$cust_name		 = $rowg["cust_name"];
		$cust_address	 = $rowg["cust_address"];
		$cust_contact	 = $rowg["cust_contact"];
		$cust_id		 = $rowg["cust_id"];
		$cust_status	 = $rowg["cust_status"];
		$auth_person	 = $rowg["auth_person"];
	
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
url: "add_cust.php", // Url to which the request is send
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
									<h2 class="breadcrumb-titles">Islamabad Chicken </small></h2>
									<ul class="list-page-breadcrumb">
										<li><a href="#">Home</a>
										</li>
										<li class="active-page"> Customers </li>
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
								<h4>Add Customer</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Customer Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										<div class="form-group">
											<label class="col-md-2 control-label">Name *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="cust_name" value="<?php echo $cust_name; ?>" placeholder="Enter Customer Name" maxlength="50" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Address *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="cust_address" value="<?php echo $cust_address; ?>" placeholder="Enter Customer Address" maxlength="100" <?php if(!isset($_GET["cust_id"])){ ?> required <?php } ?>>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Contact *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control validateNumber" name="cust_contact" value="<?php echo $cust_contact; ?>" placeholder="Enter Customer Contact" maxlength="11" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Authorized Person *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="auth_person" value="<?php echo $auth_person; ?>" placeholder="Enter Authorized Person Name" maxlength="50" >
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										 
										
										<?php if(isset($_GET["cust_id"]))
										{ ?>
                                            <div class="form-group">
											<label class="col-md-2 control-label">Status *</label>
											<div class=" col-md-8">
												<select class="form-control" name="cust_status" required>
													<option value="">--Select--</option>
													
													<option value="0" <?php if($cust_status==0){ echo "selected"; } ?>>Active</option>
													<option value="1" <?php if($cust_status==1){ echo "selected"; } ?>>Inactive</option>
													
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<?php } ?>
										
										<?php if(isset($_GET["cust_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="cust_id" value="<?php echo $_GET["cust_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["cust_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="cust.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="cust.php" class="btn btn-default">  New  </a>
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
							<h2>Customers</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Shop Customers</h4>
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
											Auth Person
										</th>
										<th>
											Status
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
											Auth Person
										</th>
										<th>
											Status
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from customer ORDER BY cust_name";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id			 	= $row1['cust_id'];
								$cust_status_ 	= $row1['cust_status'];			
									?>
									<tr>
										<td>
											<?php echo $row1['cust_name']; ?>
										</td>
										<td>
											<?php echo $row1['cust_address']; ?>
										</td>
										<td>
											<?php echo $row1['cust_contact']; ?>
										</td>
										<td>
											<?php echo $row1['auth_person']; ?>
										</td>
										<td>
											<?php switch($cust_status_)
											{
												case 0:
												echo "<span style='color:green;'>Active</span>";
												break;
												case 1:
												echo "<span style='color:red;'>Inactive</span>";
												break;
											}
											?>
										</td>
										<td>
	<a href="cust.php?cust_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
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