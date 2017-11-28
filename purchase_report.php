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
										<li class="active-page"> Purchase </li>
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
								<h4>Select Dates</h4>
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
							<h2>Purchases</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Purchase Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table dt-table" id="example">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Shop
										</th>
										<th>
											Purchase Date 
										</th>
										<th>
											Purchase From
										</th>
										<th>
											Party Name
										</th>
										<th>
											Purchase Rate
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Birds
										</th>
										<th>
											Weight
										</th>
										 <th>
											Detail
										</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											#
										</th>
										<th>
											Shop
										</th>
										<th>
											Purchase Date 
										</th>
										<th>
											Purchase From
										</th>
										<th>
											Party Name
										</th>
										<th>
											Purchase Rate
										</th>
										<th>
											Mandi Rate
										</th>
										<th>
											Birds
										</th>
										<th>
											Weight
										</th>
										 <th>
											Detail
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php
							if($shop_ho==1)
							{
								$selectSQL = "select * from purchase_view where pur_date between '$date_from' and '$date_to' ORDER BY pur_id desc";
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
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $pur_date_; ?>
										</td>
										<td>
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
										</td>
										<td>
											<?php echo $party_name_; ?>
										</td>
										<td>
											<?php echo number_format($party_rate_,2)." Rs "; ?>
										</td>
										<td>
											<?php echo number_format($mandi_rate_,2)." Rs ";; ?>
										</td>
										<td>
											<?php echo $qty_; ?>
										</td>
										<td>
											<?php echo $weight_; ?>
										</td>
										  
									 
									  
										 
								<td>
								
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $id; ?>"><i class="fa fa-file-word-o"></i></button>					
				
		<!-- Modal -->
<div id="myModal<?php echo $id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Purchase Detail</h4>
      </div>
      <div class="modal-body">
        <table class="table">
									<thead>
									<tr>
										 <th> Shop </th>
										<th> <?php echo get_title(shop_name,$shop_id_,$dbconfig); ?> </th>
									</tr>
									 <tr>
										<th> Purchase Date </th>
										<th> <?php echo $pur_date_; ?> </th>
										</tr>
										<tr>
										<th> Purchase From </th>
										<th> <?php 
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
											?> </th>
										</tr>
										<tr>
										<th> Party Name </th>
										<th> <?php echo $party_name_; ?> </th>
										</tr>
										<tr>
										<th> Purchase Rate </th>
										<th> <?php echo number_format($party_rate_,2)." Rs "; ?> </th>
										</tr>
										<tr>
										<th> Mandi Rate </th>
										<th>  <?php echo number_format($mandi_rate_,2)." Rs "; ?></th>
										</tr>
										<tr>
										<th> Birds </th>
										<th> <?php echo $qty_; ?> </th>
										</tr>
										<tr>
										<th> Weight (kg) </th>
										<th> <?php echo $weight_; ?> </th>
										</tr>
										<tr>
										<th> Driver </th>
										<th> <?php echo $driver_; ?> </th>
										</tr>
										<tr>
										<th> Vehicle </th>
										<th><?php echo $vehicle_; ?> </th>
										</tr>
										<tr>
										<th> Location </th>
										<th> <?php echo $location_; ?> </th>
										</tr>
										<tr>
										<th> Wgt Loss (kg) </th>
										<th> <?php echo $weight_loss_; ?> </th>
										</tr>
										<tr>
										<th> Mortality (# of birds/kg) </th>
										<th><?php echo $qty_loss_; ?> / <?php echo $bird_wgt_loss_; ?> </th>
										</tr>
										
										
									</thead>
									 
									<tbody>
									</tbody>
									</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>			
								
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
