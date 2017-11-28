<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 //echo "asdsadadsad";
	 
$where1 = array();

$cur_date = date("Y-m-d");

if(isset($_POST["search"]))
{

	$cust_id = $_POST["cust_id"];
	
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
										<li class="active-page">Customer </li>
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
								<h4>Select Customer</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									 
									<form class="form-horizontal" method="post" action="?id=1">
										
									 
										
										<div class="form-group">
											<label class="col-md-2 control-label">Customer * </label>
											<div class=" col-md-6">
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
							<h2>Customer</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Customer Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											Date
										</th>
										<th>
											Debit
										</th>
										<th>
											Credit
										</th>
										<th>
											Closing Balance
										</th>
										 
									</tr>
									</thead>
									
									<tbody>
									<?php	
									
									$open_balance = 5000;	
									$cl = 0;	
										
							$selectSQL = "select co_id,co_date from cust_order where cust_id = '$cust_id' and co_status = 2 order by co_date";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$co_id			 	= $row1['co_id'];
										
									?>
									<tr>
										<td>
											<?php echo $row1['co_date']; ?>
										</td>
										<td>
											<?php echo '0'; ?>
										</td>
										<td>
											<?php $credit = get_title(co_amount,$co_id,$dbconfig); 
											echo number_format(get_title(co_amount,$co_id,$dbconfig),2); ?>
										</td>
										<td>
											<?php //echo number_format(get_title(co_amount,$co_id,$dbconfig),2);
											//echo $cl - $credit; ?>
										</td>
										 
									</tr>
										<?php 
										$tot_credit = $tot_credit + $credit;
										$credit = 0;
										} 
										
															
							$selectSQL = "select cp_amount,cp_datetime from cust_paid where cust_id = '$cust_id' and cp_status = 2 order by cp_datetime";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$cp_amount			 	= $row1['cp_amount'];
								$cp_datetime			= $row1['cp_datetime'];
										
									?>
									<tr>
										<td>
											<?php echo date("Y-m-d", strtotime("$cp_datetime")); ?>
										</td>
										<td>
											<?php $debit = $cp_amount;
											echo number_format($cp_amount,2);	?>
										</td>
										<td>
											<?php echo '0'; ?>
										</td>
										<td>
											<?php //echo number_format($cp_amount,2);
											//echo $cl + $debit;	?>
										</td>
										 
									</tr>
										<?php
										$tot_debit = $tot_debit + $debit;
										$debit = 0;
										} ?>
									
									<tr>
										<th>
											GRAND TOTAL
										</th>
										<td>
											<?php echo number_format($tot_debit,2); ?>
										</td>
										<td>
											<?php echo number_format($tot_credit,2); ?>
										</td>
										<td>
											<?php $tot_net = $tot_debit - $tot_credit;
												echo number_format($tot_net,2); ?>
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
