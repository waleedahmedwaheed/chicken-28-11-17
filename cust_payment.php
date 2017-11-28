<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	 	if(isset($_GET["cp_id"]))
		{
	
		$getSQL = "select * from cust_paid where cp_id = '".$_GET["cp_id"]."' and cp_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$cp_id		 	 = $rowg["cp_id"];
		$cust_id	 	 = $rowg["cust_id"];
		$u_id		 	 = $rowg["u_id"];
		$cp_amount	 	 = $rowg["cp_amount"];
		$cp_status	 	 = $rowg["cp_status"];
		
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
url: "add_cust_payment.php", // Url to which the request is send
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
										<li class="active-page"> Customer Payment </li>
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
								<h4>Add Payment </h4>
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
												<select class="form-control" name="cust_id" id="cust_id" required >
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
											<label class="col-md-2 control-label">Outstandings</label>
											<div class=" col-md-8">
												<input type="text" name="outstandings" id="outstandings" value="" class="form-control" readonly>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Amount *</label>
											<div class=" col-md-8">
												<input type="text" name="cp_amount" maxlength="10" class="validateNumber form-control" value="<?php echo $cp_amount; ?>" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<input type="hidden" name="shop_id" value="<?php echo $_SESSION['s_id']; ?>">
										<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
										
										<?php if(isset($_GET["cp_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="cp_id" value="<?php echo $_GET["cp_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
											<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["cp_id"]))
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
											Amount
										</th>
										 <th>
											Date
										</th>
										<th>
											Shop
										</th>
										<th>
											Receive by
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
											Amount
										</th>
										 <th>
											Date
										</th>
										<th>
											Shop
										</th>
										<th>
											Receive by
										</th>
										<th>
											Status
										</th>
									</tr>
									</tfoot>
									<tbody>
									 
								  <?php	
							$selectSQL = "select * from cust_paid where cp_status <> -1 ORDER BY cp_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['cp_id'];
								$cust_id_		= $row1['cust_id'];
								$u_id_			= $row1['u_id'];
								$cp_amount_  	= $row1['cp_amount'];
								$shop_id_	  	= $row1['shop_id'];
								$cp_status_  	= $row1['cp_status'];
								$cp_datetime_  	= $row1['cp_datetime'];
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(cust_name,$cust_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $cp_amount_; ?>
										</td>
										<td>
											<?php echo $cp_datetime_; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo get_title(username,$u_id_,$dbconfig); ?>
										</td>
										 
										<td>
								<?php if($cp_status_==0){ ?>		
	<a href="cust_payment.php?cp_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
	<a href="#" class="active_class<?php echo $id; ?> btn btn-danger btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Delete" ><i class = "fa fa-trash-o"></i> Approve</a>

	<a href="#" class="delete_class<?php echo $id; ?> btn btn-success btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Active" ><i class = "ico-done"></i> Delete</a>
	

	<script>
									 
				$(document).delegate('.delete_class<?php echo $id; ?>', 'click', function(){
					
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=13&cp_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="cust_payment.php";
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
                    msg: "Are you sure you want to approve?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=12&cp_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="cust_payment.php";
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
									

	
	
								<?php } else if($cp_status_==2) {
									echo '<label class="label label-success">Approved</label>';
									 
								}
								else if($cp_status_==-1) {
									echo '<label class="label label-danger">Deleted</label>';
									 
								}
								 else
								{
									echo "";
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


<script>
$("select#cust_id").change(function(){

	var cust_id =  $("select#cust_id option:selected").attr('value'); 
	//alert(cust_id);
	//$("#product").html( "" );
	//$("#location").html( "" );
	
	if (cust_id.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-out.php",
			data: "cust_id="+cust_id,
			cache: false,
			beforeSend: function () { 
				$('#outstandings').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				document.getElementById("outstandings").value = html ;
			}
		});
	} 
});
</script>


</body>
</html>