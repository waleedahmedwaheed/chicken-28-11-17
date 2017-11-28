<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

if(isset($_GET["co_id"]))
	{
	
		$getSQL = "select * from cust_order d where d.co_id = '".$_GET["co_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$row1 = mysql_fetch_assoc($Resultg);
		 
			$co_id			= $row1['co_id'];
			$co_datetime	= $row1['co_datetime'];
			$co_status		= $row1['co_status'];
			 
		
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
                                    <h2 style="text-align: center;font-weight: 400;">Customer Order </h2>
										 <h4 style="text-align: center;font-weight: 400;">Status : 
									
									<?php if($co_status==0){ ?>		
										In Process	
								<?php } else if($co_status==1) { ?>
										Sent to Customer
								<?php } else if($co_status==2) { ?>
										Approved
								<?php } else if($co_status==3) { ?>
										Received by Shop
								<?php } else if($co_status==4) { ?>
										For Approval at Slaughter House
								<?php } ?>
									
									</h4>	
                                 </div>
                            </div>
                        </div>
                            
						 <div class="row">	
							<div class="col-md-12" style="text-align: center;">
                                <h4>Date : <?php echo $co_datetime; ?></h4>
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
                                                    #
                                                </th>
                                                <th class="invoice-qty">
                                                    Product
                                                </th>
                                                <th class="invoice-qty">
                                                    Quantity <small> (sent) </small>
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight (kg) <small> (sent) </small>
                                                </th>
												<th class="invoice-qty">
                                                    Quantity <small> (received) </small>
                                                </th>
                                                <th class="invoice-qty">
                                                    Weight (kg) <small> (received) </small>
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
								 	
							$selectSQL = "select * from cust_order_detail where co_id = '".$co_id."'";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
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
												<td class="invoice-qty">
                                                    <?php echo $rv_qty; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $rv_weight; ?>
                                                </td>
                                            </tr>
							<?php } ?>           
                                         
                                            <tr class="invoice-cal">
                                                <td colspan="2">
                                                    <span>Total</span>
                                                </td>
                                                <td class="invoice-qty">
                                                    <?php echo $p_qty_total; ?> 
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $p_weight_total; ?> 
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $r_qty_total; ?> 
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $r_weight_total; ?> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
