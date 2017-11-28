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
						 
						 <div class="col-md-6 responsive-fix top-mid">
							<div class="notification-nav">
							 <h6 style="text-align: center;font-weight: 400;"><img src="images/logo-large.png" style="height: 80px;" alt="Islamabad Chicken"> </h6>
							<h2 style="text-align: center;font-weight: 400;"> Commercial Shop </h2>	
							</div>
						 </div>
						 
						 <div class="col-md-6 responsive-fix top-mid">
							<div class="notification-nav">
								<div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-qty"> Date </th>
												<td class="invoice-qty">  </td>
											</tr>
											<tr>
                                                <th class="invoice-qty"> Day </th>
												<td class="invoice-qty">  </td>
											</tr>	
                                            <tr>
                                                <th class="invoice-qty"> # Customers </th>
												<td class="invoice-qty">  </td>
											</tr>	
                                            <tr>
                                                <th class="invoice-qty"> # Home Deliveries </th>
												<td class="invoice-qty">  </td>
											</tr>	
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										</tbody>
                                    </table>
                                </div>
								
							</div>
						 </div>
						 
				
					 
					 
					</div>
					 
						<div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-qty">
                                                    ITEM
                                                </th>
                                                <th class="invoice-qty">
                                                    # Birds
                                                </th>
                                                <th class="invoice-qty">
                                                    Live Weight <small>(kg)</small>
                                                </th>
                                                <th class="invoice-qty">
                                                    Sale Rate <small> (Rs) </small>
                                                </th>
												<th class="invoice-qty">
                                                    Amount <small> (Rs) </small>
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										 
                                            <tr>
                                                <td class="invoice-qty">
                                                    <?php echo $a = $a + 1; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                    <?php echo get_title(prod_name,$prod_id_,$dbconfig); ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $p_weight_; ?>
                                                </td>
												<td class="invoice-qty">
                                                   <?php echo $p_weight_; ?>
                                                </td>
                                            </tr>
							     
                                         
                                            <tr class="invoice-cal">
                                                <td colspan="4">
                                                    <span>Credit Sale</span>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>

											<tr class="invoice-cal">
                                                <td colspan="4">
                                                    <span>Previous cash received against credit</span>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td colspan="4">
                                                    <span><b>Total Cash Collected</b></span>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>
                                        
										
										</tbody>
                                    </table>
                                </div>
                              </div>
							  
							  <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                             <tr>
                                                <th class="invoice-qty">
                                                     
                                                </th>
                                                <th class="invoice-qty">
                                                     Birds
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight <small>(kg)</small>
                                                </th>
                                                <th class="invoice-qty">
                                                    Rate <small> (Rs) </small>
                                                </th>
												<th class="invoice-qty">
                                                    Amount <small> (Rs) </small>
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										 
                                            <tr>
                                                <td class="invoice-qty">
                                                    <?php echo $a = $a + 1; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                    <?php echo get_title(prod_name,$prod_id_,$dbconfig); ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $p_weight_; ?>
                                                </td>
												<td class="invoice-qty">
                                                   <?php echo $p_weight_; ?>
                                                </td>
                                            </tr>
							     
                                         
                                            <tr class="invoice-cal">
                                                <td colspan="5">
                                                     Purchases 
                                                </td>
                                            </tr>

											<tr class="invoice-cal">
                                                <td>
                                                    Farm Name
                                                </td>
                                                <td colspan="4" class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    Farm Rate
                                                </td>
                                                <td colspan="4" class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    Mandi Rate
                                                </td>
                                                <td colspan="4" class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    
                                                </td>
                                                <td colspan="2" class="invoice-qty">
                                                    # Birds 
                                                </td>
												<td colspan="2" class="invoice-qty">
                                                    Weight <small>(kg)</small>
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    From Farm
                                                </td>
                                                <td colspan="2" class="invoice-qty">
                                                      
                                                </td>
												<td colspan="2" class="invoice-qty">
                                                     
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    Received at shop
                                                </td>
                                                <td colspan="2" class="invoice-qty">
                                                      
                                                </td>
												<td colspan="2" class="invoice-qty">
                                                     
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    Weight Loss
                                                </td>
                                                <td colspan="2" class="invoice-qty">
                                                      
                                                </td>
												<td colspan="2" class="invoice-qty">
                                                     
                                                </td>
                                            </tr>
											
											<tr class="invoice-cal">
                                                <td>
                                                    Mortality <small>@transportation</small>
                                                </td>
                                                <td colspan="2" class="invoice-qty">
                                                      
                                                </td>
												<td colspan="2" class="invoice-qty">
                                                     
                                                </td>
                                            </tr>
											
											 
                                        
										
										</tbody>
                                    </table>
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
                                                    Supplies Detail
                                                </th>
                                                <th class="invoice-qty">
                                                    Item
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight (kg)
                                                </th>
												<th class="invoice-qty">
                                                    Rate
                                                </th>
                                                <th class="invoice-qty">
                                                    Factor
                                                </th>
                                                <th class="invoice-qty">
                                                    Amount
                                                </th>
                                                <th class="invoice-qty">
                                                    Credit / Cash
                                                </th>
                                                <th class="invoice-qty">
                                                    Payment Received
                                                </th>
                                                <th class="invoice-qty">
                                                    Outstanding
                                                </th>
                                                <th class="invoice-qty">
                                                    Cost
                                                </th>
                                                <th class="invoice-qty">
                                                    Profit / (loss)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										 
									
                                            <tr>
                                               <td class="invoice-qty">
                                                    <?php echo $b = $b + 1; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
												<td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                   <?php echo $pb_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $pb_weight_; ?>
                                                </td>
                                            </tr>
							        
                                            <tr class="invoice-cal">
                                                <td colspan="9">
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
						
						
						
						<div class="row">
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="invoice-qty">
                                                    Other Income
                                                </th>
                                                <th class="invoice-qty">
                                                    Rate
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight <small>(kg)</small>
                                                </th>
                                                <th class="invoice-qty">
                                                    Amount <small> (Rs) </small>
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										 
                                            <tr>
                                                <td class="invoice-qty">
                                                    <?php echo $a = $a + 1; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                    <?php echo get_title(prod_name,$prod_id_,$dbconfig); ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $p_weight_; ?>
                                                </td>
                                            </tr>
							      
										
										</tbody>
                                    </table>
                                </div>
                              </div>
							  
							  <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                             <tr>
                                                <th class="invoice-qty">
                                                     Shop Manager
                                                </th>
                                                <th class="invoice-qty">
                                                     Name
                                                </th>
                                                <th class="invoice-qty">
                                                    Cash Collected
                                                </th>
                                                 
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										 
                                            <tr>
                                                <td class="invoice-qty">
                                                    <?php echo $a = $a + 1; ?>
                                                </td>
                                                 <td class="invoice-qty">
                                                    <?php echo get_title(prod_name,$prod_id_,$dbconfig); ?>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_; ?>
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
