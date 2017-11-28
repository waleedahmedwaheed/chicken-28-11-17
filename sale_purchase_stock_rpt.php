<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 //echo "asdsadadsad";
	 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;
$cur_date = date("Y-m-d");

if(isset($_POST["search"]))
{
	
	$date_from = $_POST["date_from"];
	$date_to   = $_POST["date_to"];
	$shop_id   = $_POST["shop_id"];
	
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
										<li class="active-page"> Report </li>
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
								<h4>Select Options</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									 
									<form class="form-horizontal" method="post" action="?id=1">
										
									 
										
										<div class="form-group">
											<label class="col-md-2 control-label">Date From *</label>
											<div class=" col-md-3">
												<input type="date" name="date_from" class="form-control" value="<?php echo $date_from; ?>" required>
											</div>
											<label class="col-md-2 control-label">Date To *</label>
											<div class=" col-md-3">
												<input type="date" name="date_to" class="form-control" value="<?php echo $date_to; ?>" required>
											</div>
											
										</div>
										
											<div class="form-group">
											<label class="col-md-2 control-label">Shop</label>
											<div class=" col-md-3">
												<select class="form-control" name="shop_id"  >
													<option value="">--Select--</option>
													<?php
													//$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."' ORDER BY shop_id ASC";
													$selectSQL = "select * from shop ORDER BY shop_id ASC";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["shop_id"]; ?>" <?php if($row1["shop_id"]==$shop_id){ echo "selected"; } ?>><?php echo $row1["shop_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
										  <div class="col-md-2">
												 
													<input type="submit" class="btn btn-primary" value="Submit" name="search" />
												 
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
							<h2>Purchases</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Stock,Sale and Purchase Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table">
									<thead>
									<tr>
										<th>
											Description
										</th>
										<th>
											Qty
										</th>
										<th>
											Weight (kg) 
										</th>
										<th>
											Rate (kg)
										</th>
										<th>
											Amount
										</th>
									 </tr>
									</thead>
									 
									<tbody>
									
									<tr>
										<td>
											Opening Balance Live Chicken
										</td>
										<td>
											<?php echo $openqty = get_openstock(qty,$shop_id,9999,$date_from,$dbconfig); ?>
										</td>
										<td>
											<?php echo $openwgt = get_openstock(weight,$shop_id,9999,$date_from,$dbconfig); ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig),2); ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig) * get_openstock(weight,$shop_id,9999,$date_from,$dbconfig),2); ?>
										</td>
									 </tr>
									 
									<?php
							if($shop_ho==1)
							{
								$selectSQL = "select * from purchase_view where pur_date between '$date_from' and '$date_to' and shop_id = '".$shop_id."' and prod_id = 9999 ORDER BY pur_id desc";
							} else if($shop_ho==0)
							{
								$selectSQL = "select * from purchase_view where pur_date between '$date_from' and '$date_to' and shop_id = '".$_SESSION["s_id"]."'";
							}
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pur_id'];
								$p_status_  	= $row1['p_status'];
								$shop_id_  		= $row1['shop_id'];
								$prod_id_  		= $row1['prod_id'];
								$pur_date_  	= $row1['pur_date'];
								$pur_from_  	= $row1['pur_from'];
								$party_name_  	= $row1['party_name'];
								$party_rate_  	= $row1['party_rate'];
								$mandi_rate_  	= $row1['mandi_rate'];
								$qty_  			= $row1['qty'];
								$weight_  		= $row1['weight'];
								$driver_  		= $row1['driver'];
								$vehicle_  		= $row1['vehicle'];
								$location_  	= $row1['location'];
								$weight_loss_  	= $row1['weight_loss'];
								$qty_loss_  	= $row1['qty_loss'];
								$bird_wgt_loss_ = $row1['bird_wgt_loss'];
								
								$loss_status = get_title(loss_status,$id,$dbconfig);
											
									?>
									<tr>
										<td>
											Purchased
											<?php if($prod_id_=="9999"){ echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); } ?>
											from
											<?php 
											switch($pur_from_)
											{
												case 1:
												echo "Farm";
												break;
												case 2:
												echo "Mandi";
												break;
												case 3:
												echo "Other";
												break;
											}
											?>
											-
											<?php echo $party_name_; ?>
										</td>
										<td>
											<?php echo $qty_; ?>
										</td>
										<td>
											<?php echo $weight_; ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig),2); ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig)*$weight_,2); ?>
										</td>  
									  	 
								 	</tr>
							
							
							
										<?php 
										
										$curqty = $curtqy + $qty_;
										$curwgt = $curwgt + $weight_;
										$qty_ 	 = 0;
										$weight_ = 0;
										} ?>
									
									<tr>
										<td>
											Total Stock for Sale
										</td>
										<td>
											<?php echo $stockqty = $openqty + $curqty; ?>
										</td>
										<td>
											<?php echo $stockwgt = $openwgt + $curwgt; ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig),2); ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig) * $stockwgt,2); ?>
										</td>
									 </tr>
									 
									 <tr>
										<td>
											Weight Sold
										</td>
										<?php
							$selectSQL2 = "select COALESCE (SUM(co_qty) ,0) as coqty,COALESCE (SUM(co_weight) ,0) as cowgt
							from cust_order_detail cod where cod.co_id IN  
							(select co_id from cust_order where co_date = '$cur_date' and shop_id = $shop_id and prod_id = 9999)";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result2 = mysql_query($selectSQL2, $dbconfig) or die(mysql_error());	 
							$row2 = mysql_fetch_assoc($Result2);
										?>
										<td>
											<?php echo $coqty = $row2["coqty"]; ?>
										</td>
										<td>
											<?php echo $cowgt = $row2["cowgt"]; ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig),2); ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig) * $cowgt,2); ?>
										</td>
									 </tr>

									 <tr>
										<td>
											Transfer
										</td>
										<?php
							$selectSQL = "select COALESCE (SUM(s_qty) ,0) as tqty,COALESCE (SUM(s_weight) ,0) as twgt
										from live_transfer where s_shop_id = $shop_id and tr_datetime like '$cur_date%'";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							$row = mysql_fetch_assoc($Result);
										?>
										<td>
											<?php echo $tqty = $row["tqty"]; ?>
										</td>
										<td>
											<?php echo $tqty = $row["twgt"]; ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig),2); ?>
										</td>
										<td>
											<?php echo number_format(get_mandirate(sale_rate,$shop_id,$cur_date,$dbconfig) * $twgt,2); ?>
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
