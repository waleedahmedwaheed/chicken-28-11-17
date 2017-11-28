<?php include("db/dbcon.php"); 
 include("functions.php"); 
error_reporting(0);
session_start();

	if(isset($_GET["fact_id"]))
	{
	
		$getSQL = "select * from cust_factor where fact_id = '".$_GET["fact_id"]."' and fact_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$cust_id		 = $rowg["cust_id"];
		$prod_id		 = $rowg["prod_id"];
		$mandi_fact	 	 = $rowg["mandi_fact"];
		$other			 = $rowg["other"];
		$fact_status	 = $rowg["fact_status"];
	
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

	var value1 = document.getElementById('mandi_fact').value;
    var value2 = document.getElementById('other').value;
	
	//alert(value1);
	//alert(value2);
	
    /* if( value1 != "" && value2 == "" ) {
        //alert("true");   
		var app = 1;	
    }
	else if( value1 == "" && value2 != "" ) 
	{
		//alert("false tru");
		var app = 1;
	}
	else
	{
		alert("Please fill either mandi(+) field or other field");
		var app = 0;
	}
	
	//alert(app);
	if(app==1)
	{ */
 e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "add_cust_fact.php", // Url to which the request is send
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
 
	//}
	
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
										<li class="active-page"> Customers Factor </li>
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
								<h4>Add Customer Factor</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Factor Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										<div class="form-group">
											<label class="col-md-2 control-label">Customer Name *</label>
											<div class=" col-md-8">
												<select class="form-control" name="cust_id" required >
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
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-8">
												<select name="pcat_id" id="cat" required class="form-control">
												<option value="">--Select--</option>
										<option value="9999" <?php if($pcat_id==9999){ echo "selected"; } ?>>Live Chicken</option>			
													<?php 
													$getSQLs = "select * from product_category order by pcat_desc";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
													while($rowgs = mysql_fetch_assoc($Resultgs))
													{
													$pcat_desc_s		 = $rowgs["pcat_desc"];
													$pcat_id_s		 	 = $rowgs["pcat_id"];
													?> 
						
						<option value="<?php echo $pcat_id_s; ?>" <?php if($pcat_id_s==$pcat_id){ echo "selected"; } ?>><?php echo $pcat_desc_s; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Product *</label>
											<div class=" col-md-8">
												<select name="prod_id" id="product" required class="form-control">
													
													<?php
													if(isset($_GET["fact_id"]))
													{
													?>
													<option value="<?php echo $prod_id; ?>"><?php echo get_title(prod_name,$prod_id,$dbconfig); ?></option>
													<?php } else { ?>
													<option value="">--Select Product--</option>
													<?php } ?>
													
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										 
										<div class="form-group">
											<label class="col-md-2 control-label">Mandi (+) *</label>
											<div class=" col-md-3">
												<input type="text" class="form-control number" name="mandi_fact" id="mandi_fact" value="<?php echo $mandi_fact; ?>" maxlength="5" required>
											</div>
											<label class="col-md-2 control-label">Other</label>
											<div class=" col-md-3">
												<input type="text" class="form-control validateNumber" name="other" id="other" value="<?php echo $other; ?>" maxlength="4" >
											</div>
										</div> 
										
										
										
										<?php if(isset($_GET["fact_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="fact_id" value="<?php echo $_GET["fact_id"]; ?>">
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
													<a href="cust_factor.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="cust_factor.php" class="btn btn-default">  New  </a>
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
							<h2>Customer Factor</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Factors Detail</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											Customer
										</th>
										<th>
											Product
										</th>
										<th>
											Mandi (+)
										</th>
										<th>
											Other
										</th>
										<th>
											Action
										</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											Customer
										</th>
										<th>
											Product
										</th>
										<th>
											Mandi (+)
										</th>
										<th>
											Other
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from cust_factor ORDER BY fact_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id			 	= $row1['fact_id'];
								$fact_status_ 	= $row1['fact_status'];			
								$cust_id_	 	= $row1['cust_id'];			
								$prod_id_	 	= $row1['prod_id'];			
								$mandi_fact_ 	= $row1['mandi_fact'];			
								$other_		 	= $row1['other'];			
									?>
									<tr>
										<td>
											<?php echo get_title(cust_name,$cust_id_,$dbconfig); ?>
										</td>
										<td>
											<?php if($prod_id_=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); } ?>
										</td>
										<td>
											<?php echo $mandi_fact_; ?>
										</td>
										<td>
											<?php echo $other_; ?>
										</td>
										<td style="display:none;">
											<?php switch($fact_status_)
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
	<a href="cust_factor.php?fact_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
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
$("select#cat").change(function(){

	var cat =  $("select#cat option:selected").attr('value'); 
	//alert(cat);
	$("#product").html( "" );
	//$("#location").html( "" );
	
	if (cat.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-records.php",
			data: "cat="+cat,
			cache: false,
			beforeSend: function () { 
				$('#product').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#product").html( html );
			}
		});
	} 
});
</script>


</body>
</html>