<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

 $pro_id = $_GET["pro_id"];
 
 $getSQL = "select * from production where pro_id = '".$_GET["pro_id"]."' and pro_status <> 1";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$daily_rate	 	 = $rowg["daily_rate"];
		$pro_date	 	 = $rowg["pro_date"];
		$pro_status	 	 = $rowg["pro_status"];
		$pr_qty		 	 = $rowg["pr_qty"];
		$pr_weight		 = $rowg["pr_weight"];
	
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
<body class="invoice-page">
<div class="page-container list-menu-view">
<!--Leftbar Start Here -->
	<?php include("left_sidebar.php"); ?>
	
<div class="page-content">
    <!--Topbar Start Here -->
		<?php include("header.php"); ?>
		
	
	<div class="main-container">
                <div class="invoice-container">
                    <div class="container-fluid">
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
						 
						 <div class="col-md-12 responsive-fix top-mid">
                    <div class="notification-nav">
							<h2 style="text-align: center;font-weight: 400;"> <img src="images/logo-large.png" style="height: 80px;" alt="Islamabad Chicken"> </h2>	
							 	
						</div>
                   
                </div>
				
					 
					 
					</div>
					
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <h2 style="text-align: center;font-weight: 400;">Daily Production Report</h2>
                                 </div>
                            </div>
                        </div>
                            
						 <div class="row">	
							<div class="col-md-6" style="text-align: center;">
                                <h4>Date : <?php echo $pro_date; ?></h4>
                                <address>
							<strong></strong>No of Chicken : <?php echo $pr_qty; ?> Qty</address>
                            </div>
							
							<div class="col-md-6" style="text-align: center;">
                                <h4>Daily Rate : <?php echo $daily_rate; ?></h4>
                                <address>
							<strong></strong> 
							 Weight : <?php echo $pr_weight; ?> kg <br> 
							 Avg Weight : <?php echo $pr_weight/$pr_qty; ?> kg <br></address>
                            </div>
                        </div>
                        
						<div class="row">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <h3 style="text-align: center;font-weight: 400;">Products Detail</h3>
                                 </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-qty">
                                                    Id
                                                </th>
                                                <th class="invoice-qty">
                                                    Product
                                                </th>
												<th class="invoice-qty">
                                                    Exp Time
                                                </th>
                                                <th class="invoice-qty">
                                                    Quantity
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight (kg)
                                                </th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$selectSQL = "select * from production_prod where pp_status <> 1 and pro_id = '".$_GET["pro_id"]."' ORDER BY pp_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pp_id'];
								$pp_status_  	= $row1['pp_status'];
								$p_qty_  		= $row1['p_qty'];
								$p_weight_  	= $row1['p_weight'];
								//$pro_id_		= $row1['pro_id'];
								$prod_id_		= $row1['prod_id'];
								$pro_date_		= $row1['pro_date'];
								$prod_exp_		= get_title(prod_exp,$prod_id_,$dbconfig);
								
								$p_weight_total = $p_weight_total + $p_weight_;
								$p_qty_total	= $p_qty_total + $p_qty_;
							?>
                                            <tr>
                                                <td class="invoice-qty">
                                                    <?php echo $a = $a + 1; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                    <?php echo get_title(prod_name,$prod_id_,$dbconfig); ?>
                                                </td>
												<td class="invoice-qty">
                                                   <?php echo date('d-m-Y', strtotime($pro_date_." +$prod_exp_ days")); ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $p_weight_; ?>
                                                </td>
												
                                            </tr>
							<?php } ?>           
                                         
                                            <tr class="invoice-cal">
                                                <td colspan="3">
                                                    <span>Total</span>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_total; ?> 
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
								
								<div class="row">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <h3 style="text-align: center;font-weight: 400;">Batches Detail</h3>
                                 </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-qty">
                                                    #
                                                </th>
												<th class="invoice-qty">
                                                    Time
                                                </th>
                                                <th class="invoice-qty">
                                                    Quantity
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight (kg)
                                                </th>
												
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php	
							$selectSQL = "select * from production_batches where pb_status <> 1 and pro_id = '".$_GET["pro_id"]."' ORDER BY pb_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pb_id'];
								$pb_status_  	= $row1['pb_status'];
								$pb_qty_  		= $row1['pb_qty'];
								$pb_weight_  	= $row1['pb_weight'];
								$pb_datetime_  	= $row1['pb_datetime'];
								//$pro_id_		= $row1['pro_id'];
								
								$pb_qty_total	 = $pb_qty_total + $pb_qty_;
								$pb_weight_total = $pb_weight_total + $pb_weight_;
											
									?>
									
                                            <tr>
                                               <td class="invoice-qty">
                                                    <?php echo $b = $b + 1; ?>
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $pb_datetime_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $pb_weight_; ?>
                                                </td>
												
                                            </tr>
							<?php } ?>         
                                            <tr class="invoice-cal">
                                                <td colspan="2">
                                                    <span>Total</span>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $pb_qty_total; ?>
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $pb_weight_total; ?> 
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
