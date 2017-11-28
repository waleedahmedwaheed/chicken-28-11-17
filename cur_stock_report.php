<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 	 
$cur_date = date("Y-m-d");

if(isset($_POST["search"]))
{
	$s_id   = $_POST["shop_id"];		
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
										<li class="active-page"> Current Stock </li>
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
								<h4>Select Shop</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									 
									<form class="form-horizontal" method="post" action="?id=1">
										
									   
										<div class="form-group">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-4">
												<select class="form-control" name="shop_id"  required>
													<option value="">--Select--</option>
													<?php
													//$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";
													$selectSQL = "select * from shop ORDER BY shop_id ASC";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["shop_id"]; ?>" <?php if($row1["shop_id"]==$s_id){ echo "selected"; } ?>><?php echo $row1["shop_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-2">
												 
													<input type="submit" class="btn btn-primary" value="Submit" name="search" />
												 
											</div>
										</div> 
											 
										  
										  
									</form>
											 
								</div>
							</div>
						</div>
						
						
						
					</div>
					
					</div>
					
					<?php if(isset($_POST["search"]))
					{ ?>
					
					 <div class="row">
                            <div class="col-md-6 col-md-offset-6">
                                <div class="invoice-toolbar">
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <button type="button" onclick="printDiv('printableArea')" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
					<div id="printableArea">
					<div class="row">
					<div class="col-md-12">
						
						<div class="section-header hide">
							<h2>Current Stock</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Current Stock Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
										  Product
										</th>
										<th>
											Qty 
										</th>
										<th>
											Weight
										</th>
										 
										 
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
										  Product 	 
										</th>
										<th>
											Qty 
										</th>
										<th>
											Weight
										</th>
										 
										 
									</tr>
									</tfoot>
									<tbody>
									
									<tr>
										<td>
											Live Chicken
										</td>
										<td>
											<?php echo get_stock(live_qty,$s_id,9999,$dbconfig); ?>
										</td>
										<td>
											<?php echo get_stock(live_weight,$s_id,9999,$dbconfig); ?>
										</td>
									 
									
									</tr>
									
									<?php	
							$selectSQL = "select * from product ORDER BY prod_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id 		  = $row1['prod_id'];
								$pcat_id_	  = $row1['pcat_id'];
								$prod_status_ = $row1['prod_status'];
								
									   
									
									?>
									<tr>
										<td>
											<?php echo get_title(prod_name,$id,$dbconfig); ?>
										</td>
										<td>
											<?php echo get_stock(qty,$s_id,$id,$dbconfig); ?>
										</td>
										<td>
											<?php echo get_stock(weight,$s_id,$id,$dbconfig); ?>
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
				
					<?php } ?>
				
				
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
