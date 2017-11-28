<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

 $cur_date = date("Y-m-d");

	if(isset($_GET["ie_id"]))
	{
	
		$getSQL = "select * from ie_detail where ie_id = '".$_GET["ie_id"]."' and ie_dstatus = 0 ";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$ie_id			 = $rowg["ie_id"];
		$iecat_id		 = $rowg["iecat_id"];
		$ie_amount	 	 = $rowg["ie_amount"];
		$ie_date	 	 = $rowg["ie_date"];
		$ie_dstatus	 	 = $rowg["ie_dstatus"];
		$ie_type	  	 = get_title(ie_type,$iecat_id);
		
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
url: "add_ie_cat_detail.php", // Url to which the request is send
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
										<li class="active-page"> Income/Expense </li>
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
								<h4>Add Income/Expense Detail</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Income/Expense Details</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										<input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />	
										
										<div class="form-group">
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-8">
												<select name="ie_type" id="ie_type" required class="form-control">
													<option value="">--Select--</option>
													<option value="1" <?php if($ie_type==1){ echo "selected"; } ?>>Income</option>
													<option value="2" <?php if($ie_type==2){ echo "selected"; } ?>>Expense</option>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										
										<div class="form-group">
											<label class="col-md-2 control-label">Name *</label>
											<div class=" col-md-8">
												<select name="iecat_id" id="iecat_id" required class="form-control">
													
													<?php
													if(isset($_GET["ie_id"]))
													{
													?>
													<option value="<?php echo $iecat_id; ?>"><?php echo get_title(ie_desc,$iecat_id,$dbconfig); ?></option>
													<?php } else { ?>
													<option value="">--Select--</option>
													<?php } ?>
													
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										
										<div class="form-group">
											<label class="col-md-2 control-label">Amount *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control number" name="ie_amount" value="<?php echo $ie_amount; ?>" placeholder="Enter Amount" maxlength="20" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Date *</label>
											<div class=" col-md-8">
												<input type="date" class="form-control" min="<?php echo $cur_date; ?>" name="ie_date" value="<?php echo $ie_date; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										
										
										<?php if(isset($_GET["ie_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="ie_id" value="<?php echo $_GET["ie_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["ie_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="ie_cat_detail.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="ie_cat_detail.php" class="btn btn-default">  New  </a>
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
							<h2>Income/Expense Detail</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Detail</h4>
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
											Category
										</th>
										<th>
											Name
										</th>
										<th>
											Amount
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
											Category
										</th>
										<th>
											Name
										</th>
										<th>
											Amount
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
							$selectSQL = "select * from ie_detail where ie_dstatus = 0 ORDER BY ie_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id 		  = $row1['ie_id'];
								$ie_amount_	  = $row1['ie_amount'];
								$ie_date_     = $row1['ie_date'];
								$ie_dstatus_  = $row1['ie_dstatus'];
								$iecat_id_	  = $row1['iecat_id'];
								
								$ie_type_	  = get_title(ie_type,$iecat_id_,$dbconfig);
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php switch($ie_type_)
											{
												case 1:
												echo "INCOME";
												break;
												case 2:
												echo "EXPENSE";
												break;
											}
											?>
										</td>
										<td><?php echo get_title(ie_desc,$iecat_id_,$dbconfig); ?></td>
										<td><?php echo number_format($ie_amount_,2,$dbconfig); ?></td>
										<td><?php echo $ie_date_; ?></td>
										<td>
										<?php if($ie_dstatus_==0){ ?>
	<a href="ie_cat_detail.php?ie_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	&nbsp;
	<a href="#" class="delete_class<?php echo $id; ?> btn btn-danger btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Delete" ><i class = "fa fa-trash-o"></i> Delete</a>
										<?php } else { ?>
											<?php } ?>
									</td>
									</tr>
									
		<script>
									 
				$(document).delegate('.delete_class<?php echo $id; ?>', 'click', function(){
					
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=7&ie_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="ie_cat_detail.php";
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

<script>
$("select#ie_type").change(function(){

	var ie_type =  $("select#ie_type option:selected").attr('value'); 
	//alert(ie_type);
	$("#iecat_id").html( "" );
	//$("#location").html( "" );
	
	if (ie_type.length > 0 ) { 
		
	 $.ajax({
			ie_type: "POST",
			url: "fetch-records-cat.php",
			data: "ie_type="+ie_type,
			cache: false,
			beforeSend: function () { 
				$('#iecat_id').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#iecat_id").html( html );
			}
		});
	} 
});
</script>


</body>
</html>