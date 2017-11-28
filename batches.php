<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;

	if(isset($_GET["pb_id"]))
	{
	
		$getSQL = "select * from production_batches where pb_id = '".$_GET["pb_id"]."' and pro_id = '".$_GET["pro_id"]."' and pb_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		  
		$pro_id		 	 = $rowg["pro_id"];
		$pb_status	 	 = $rowg["pb_status"];
		$pb_qty		 	 = $rowg["pb_qty"];
		$pb_weight		 = $rowg["pb_weight"];
	
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="A Components Mix Bootstarp 3 Admin Dashboard Template">
<meta name="author" content="Westilian">
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
url: "add_batches.php", // Url to which the request is send
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
								<h4>Add Batches</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Batches Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										 <input type="hidden" name="pro_id" value="<?php echo $_GET["pro_id"]; ?>" />
										
										<div class="form-group">
											<label class="col-md-2 control-label">Number of Chicken *</label>
											<div class=" col-md-3">
												<input type="text" name="pb_qty" class="form-control validateNumber" maxlength="5" placeholder="Enter no of Birds" value="<?php echo $pb_qty; ?>" required>
											</div>
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-3">
												<input type="text" name="pb_weight" class="form-control number" maxlength="7" placeholder="Enter Weight" value="<?php echo $pb_weight; ?>" required>
											</div>
										</div>
									  
										
										<?php if(isset($_GET["pb_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="pb_id" value="<?php echo $_GET["pb_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["pb_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="batches.php?pro_id=<?php echo $pro_id; ?>" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="batches.php?pro_id=<?php echo $pro_id; ?>" class="btn btn-default">  New  </a>
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
							<h2>Batches</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Batches Detail</h4>
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
											Qty 
										</th>
										<th>
											Weight
										</th>
										<th>
											Time
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
											Qty 
										</th>
										<th>
											Weight
										</th>
										<th>
											Time
										</th>
										 <th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from production_batches where pb_status = 0 ORDER BY pb_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pb_id'];
								$pb_status_  	= $row1['pb_status'];
								$pb_qty_  		= $row1['pb_qty'];
								$pb_weight_  	= $row1['pb_weight'];
								$pb_datetime_  	= $row1['pb_datetime'];
								$pro_id_		= $row1['pro_id'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										 <td>
											<?php echo $pb_qty_; ?>
										</td>
										<td>
											<?php echo $pb_weight_; ?>
										</td>
										<td>
											<?php echo $pb_datetime_; ?>
										</td>
										 
										<td>
								<?php if($pb_status_==0){ ?>		
	<a href="batches.php?pro_id=<?php echo $pro_id_; ?>&pb_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	 
	<a href="#" class="delete_class<?php echo $id; ?> btn btn-danger btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Delete" ><i class = "fa fa-trash-o"></i> Delete</a>
								
								
								<script>
									 
				$(document).delegate('.delete_class<?php echo $id; ?>', 'click', function(){
					
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=9&pb_id="+ del_id,
                cache: false,
                success:function(result){
					//$("#response").html(result);
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						
						window.location="batches.php?pro_id=<?php echo $pro_id_; ?>";
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
								
								
								<?php
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



</body>
</html>
