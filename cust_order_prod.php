<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	  
	if(isset($_GET["cod_id"]))
	{
	
		$selectSQL = "select * from cust_order_detail where cod_id = '".$_GET["cod_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
		$row1 = mysql_fetch_assoc($Result1);
		
			$cod_id			= $row1['cod_id'];
			$co_id			= $row1['co_id'];
			$prod_id		= $row1['prod_id'];
			$co_qty			= $row1['co_qty'];
			$co_weight		= $row1['co_weight'];
			$price			= $row1['price'];
			$prod_price		= $row1['prod_price'];
			$cod_status  	= $row1['cod_status'];
			if($prod_id==9999)
			{
				 $pcat_id=9999;
			}
			else
			{
				 $pcat_id		= get_title(pcat_id,$prod_id,$dbconfig);
			}
			$co_status 		= get_title(co_status,$co_id,$dbconfig);
	}
	
	if(isset($_GET["co_id"]))
	{
	
		$selectSQL = "select * from cust_order where co_id = '".$_GET["co_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
		$row1 = mysql_fetch_assoc($Result1);
		
			$co_id			= $row1['co_id'];
			$co_status  	= $row1['co_status'];
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
 <?php if($co_status==0){ ?>
<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "add_cust_order_prod.php", // Url to which the request is send
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
 <?php } ?>
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
										<li class="active-page"> Customer Order Products </li>
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
								<h4>Add Products</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Products Detail</h2>
									</div>
									
									<?php if($co_status==0){ ?>
									<form class="form-horizontal" method="post" id="userForm">
										
										 <input type="hidden" name="co_id" value="<?php echo $_GET["co_id"]; ?>" />
										 <input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />
										
										<div class="form-group">
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-3">
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
											<label class="col-md-2 control-label">Product *</label>
											<div class=" col-md-3">
													<select name="prod_id" id="product" required class="form-control">
													
													<?php
													if(isset($_GET["cod_id"]))
													{
													?>
													<option value="<?php echo $prod_id; ?>"><?php if($prod_id=="9999"){ echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id,$dbconfig); } ?></option>
													<?php } else { ?>
													<option value="">--Select--</option>
													<?php } ?>
													
												</select>
											</div>
											
										</div>
										
										
										<div class="form-group">
											<label class="col-md-2 control-label">Qty </label>
											<div class=" col-md-3">
												<input type="text" name="co_qty" class="form-control validateNumber" maxlength="5" value="<?php echo $co_qty; ?>" >
											</div>
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-3">
												<input type="text" name="co_weight" class="form-control number" maxlength="7" value="<?php echo $co_weight; ?>" required>
											</div>
										</div>
										 
											
											<?php if(isset($_GET["cod_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="cod_id" value="<?php echo $_GET["cod_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
										 	<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["cod_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													
													<?php } ?>
													
												</div>
											</div>
										</div>
										
										 
										 
									
									</form>
											<span id="response"> </span>	
									<?php } else if($co_status==1){ ?>
									 	
										
										<table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-qty" nowrap>
                                                    #
                                                </th>
                                                <th class="invoice-qty" nowrap>
                                                    Product
                                                </th>
                                                <th class="invoice-qty" nowrap>
                                                    Quantity <small> (sent) </small>
                                                </th>
                                                <th class="invoice-qty" nowrap>
                                                    Weight <small> (sent) </small>
                                                </th>
												<th class="invoice-qty" nowrap>
                                                    Quantity <small> (delivered) </small>
                                                </th>
                                                <th class="invoice-qty" nowrap>
                                                    Weight (kg) <small> (delivered) </small>
                                                </th>
												<th class="invoice-qty" nowrap>
                                                    
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
								 	
							$selectSQL = "select * from cust_order_detail where co_id = '".$co_id."' and cod_status = 1";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$cod_id			= $row1['cod_id'];
								$prod_id		= $row1['prod_id'];
								$co_qty			= $row1['co_qty'];
								$co_weight		= $row1['co_weight'];
								$rv_qty			= $row1['rv_qty'];
								$rv_weight		= $row1['rv_weight'];
								$price			= $row1['price'];
								$prod_price		= $row1['prod_price'];
								
								$p_weight_total = $p_weight_total + $co_weight;
								$p_qty_total	= $p_qty_total + $co_qty;
								$r_weight_total = $r_weight_total + $rv_weight;
								$r_qty_total	= $r_qty_total + $rv_qty;
							?>
							<form id="stocku<?php echo $cod_id;?>" method="post" onsubmit="return confirm('Are you sure to verify this product ?');">
                                            <tr>
                                                <td class="invoice-qty">
                                                    <?php echo $a = $a + 1; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php if($prod_id=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id,$dbconfig); }; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $co_qty; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $co_weight; ?>
                                                </td>
												<td width="20%">
		<input type="text" name="rv_qty" id="rv_qty<?php echo $cod_id; ?>" value="<?php echo $rv_qty; ?>"  class="validateNumber form-control" style="width: 100%;" />
												</td>
												<td width="20%">
		<input type="text" name="rv_weight" id="rv_weight<?php echo $cod_id; ?>" value="<?php echo $rv_weight; ?>"  class="validateNumber form-control" style="width: 100%;" />
											</td>
                                         
												
										<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>" />
										<input type="hidden" name="co_qty" value="<?php echo $co_qty; ?>" />
										<input type="hidden" name="co_weight" value="<?php echo $co_weight; ?>" />
										<input type="hidden" name="co_id" value="<?php echo $_GET["co_id"]; ?>" />
										 <input type="hidden" name="cod_id" value="<?php echo $cod_id; ?>" />
									<td>
									<input type="submit" value="Verify" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to verify this product ?');" />
									</tr>
						</form>
						
						<span id="response<?php echo $cod_id;?>"> </span>
						   </tr>
		
<script>

$(document).ready(function (e) {
$("#stocku<?php echo $cod_id;?>").on('submit',(function(e) {
	//alert("test");
e.preventDefault();
$('#response<?php echo $cod_id;?>').show();
//$("#loader").show();
$.ajax({
url: "add_cust_rcv.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
//$("#loader").hide();
//$('#userForm')[0].reset();
$("#response<?php echo $cod_id;?>").html(data);
//window.location='cust_order_prod.php?co_id=<?php echo $_GET["co_id"];  ?>';
}
});

}));
});


</script>						
							<?php } ?>           
                                         
                                          
                                        </tbody>
                                    </table>
                                  
									<?php } ?>	
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
								<h4>Products Detail</h4>
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
											Product 
										</th>
										<th>
											Qty
										</th>
										 <th>
											Weight
										</th>
										<th>
											Price
										</th>
										<th>
											Total Price
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
											Product 
										</th>
										<th>
											Qty
										</th>
										 <th>
											Weight
										</th>
										<th>
											Price
										</th>
										<th>
											Total Price
										</th>
										<th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									 
								  <?php	
							$selectSQL = "select * from cust_order_detail where co_id = '".$_GET["co_id"]."' ORDER BY cod_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['cod_id'];
								$co_id_			= $row1['co_id'];
								$prod_id_		= $row1['prod_id'];
								$co_qty_		= $row1['co_qty'];
								$co_weight_		= $row1['co_weight'];
								$price_			= $row1['price'];
								$prod_price_	= $row1['prod_price'];
								$cod_status_  	= $row1['cod_status'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); }; ?>
										</td>
										<td>
											<?php echo $co_qty_; ?>
										</td>
										<td>
											<?php echo $co_weight_; ?>
										</td>
										<td>
											<?php echo number_format($price_,2); ?>
										</td>
										<td>
											<?php echo number_format($prod_price_,2); ?>
										</td>
										 
										<td>
								<?php if($cod_status_==0){ ?>		
	<a href="cust_order_prod.php?cod_id=<?php echo $id;?>&co_id=<?php echo $co_id_; ?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
	
				  
	
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
