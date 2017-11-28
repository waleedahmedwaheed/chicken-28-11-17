<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);


	if(isset($_GET["prod_id"]))
	{
	
		$getSQL = "select * from product where prod_id = '".$_GET["prod_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$prod_name		 = $rowg["prod_name"];
		$pcat_id	 	 = $rowg["pcat_id"];
		$prod_status	 = $rowg["prod_status"];
		$prod_exp		 = $rowg["prod_exp"];
		$prod_code		 = $rowg["prod_code"];
	
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="IC">
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
url: "add_product.php", // Url to which the request is send
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
//window.location="product.php";
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
										<li class="active-page"> Products </li>
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
								<h4>Add Product</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Product Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										<div class="form-group">
											<label class="col-md-2 control-label">Name *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="prod_name" value="<?php echo $prod_name; ?>" placeholder="Enter Name" maxlength="50" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-8">
												<select name="pcat_id" required class="form-control">
													<option value="">--Select--</option>
													<?php 
													$getSQLs = "select * from product_category order by pcat_desc";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
													while($rowgs = mysql_fetch_assoc($Resultgs))
													{
													$pcat_desc_s		 = $rowgs["pcat_desc"];
													$pcat_id_s		 	 = $rowgs["pcat_id"];
													?> 
					<option value="<?php echo $pcat_id_s; ?>" <?php if($pcat_id==$pcat_id_s){ echo "selected";} ?>><?php echo $pcat_desc_s; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
									
									<div class="form-group">
											<label class="col-md-2 control-label">Code *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="prod_code" value="<?php echo $prod_code; ?>" placeholder="Enter Code" maxlength="50" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
									<div class="form-group">
											<label class="col-md-2 control-label">Expire Time (Days) *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control validateNumber" name="prod_exp" value="<?php echo $prod_exp; ?>" placeholder="Enter Days" maxlength="2" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<?php if(isset($_GET["prod_id"]))
										{ ?>
									
										<div class="form-group">
											<label class="col-md-2 control-label">Status *</label>
											<div class=" col-md-8">
												<select name="prod_status" required class="form-control">
													<option value="">--Select--</option>
													<option value="0" <?php if($prod_status==0){ echo "selected"; } ?>> Active </option>
													<option value="1" <?php if($prod_status==1){ echo "selected"; } ?>> Inactive </option>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<?php } ?>
										 
										<?php if(isset($_GET["prod_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="prod_id" value="<?php echo $_GET["prod_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["prod_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="product.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="product.php" class="btn btn-default">  New  </a>
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
							<h2>Products</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Products</h4>
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
											Name
										</th>
										<th>
											Category
										</th>
										<th>
											Code
										</th>
										<th>
											Barcode
										</th>
										<th>
											Exp Time (Days)
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
											#
										</th>
										<th>
											Name
										</th>
										<th>
											Category
										</th>
										<th>
											Code
										</th>
										<th>
											Exp Time (Days)
										</th>
										<th>
											Barcode
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
							$selectSQL = "select * from product ORDER BY prod_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id 		  = $row1['prod_id'];
								$pcat_id_	  = $row1['pcat_id'];
								$prod_status_ = $row1['prod_status'];
								$prod_exp_	  = $row1['prod_exp'];
								$prod_code_	  = $row1['prod_code'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo $row1['prod_name']; ?>
										</td>
										<td>
											<?php echo get_title(pcat_desc,$pcat_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $prod_code_; ?>
										</td>
										<td>
											<img src="barcode.php?codeText=<?php echo $prod_code_; ?>" height="40" width="100" />
										</td>
										<td>
											<?php echo $prod_exp_; ?>
										</td>
										<td>
											<?php if($prod_status_==0){
												echo '<label class="label label-success">Active</label>';
											} 
											else
											{
												echo '<label class="label label-danger">Inactive</label>';
											}												
												?>
										</td>
										<td>
										<?php if($prod_status_==0){ ?>
	<a href="product.php?prod_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	&nbsp;
	<a href="#" class="delete_class<?php echo $id; ?> btn btn-danger btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Delete" ><i class = "fa fa-trash-o"></i> Inactive</a>
										<?php } else { ?>
	<a href="#" class="active_class<?php echo $id; ?> btn btn-success btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Active" ><i class = "ico-done"></i> Active</a>
										<?php } ?>
									</td>
									</tr>
									
		<script>
									 
				$(document).delegate('.delete_class<?php echo $id; ?>', 'click', function(){
					
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to modify this product?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=1&prod_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="product.php";
                    });
                }
            });
			
                        } else if (type === 'no') {
                            /* Lobibox.notify('info', {
                                msg: 'You have clicked "No" button.'
                            }); */
                        }
                    }
                });
 		});
		
									</script>
									
							<script>
									 
				$(document).delegate('.active_class<?php echo $id; ?>', 'click', function(){
					
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to modify this product?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=2&prod_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="product.php";
                    });
                }
            });
			
                        } else if (type === 'no') {
                            /* Lobibox.notify('info', {
                                msg: 'You have clicked "No" button.'
                            }); */
                        }
                    }
                });
 		});
		
									</script>		
									
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