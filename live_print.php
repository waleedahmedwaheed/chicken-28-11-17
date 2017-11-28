<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

if(isset($_GET["tr_id"]))
	{
	
		$getSQL = "select * from live_transfer where tr_id = '".$_GET["tr_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$tr_id		 	 = $rowg["tr_id"];
		$shop_id	 	 = $rowg["shop_id"];
		$s_qty_		 	 = $rowg["s_qty"];
		$s_weight_	 	 = $rowg["s_weight"];
		$r_qty_		 	 = $rowg["r_qty"];
		$r_weight_	 	 = $rowg["r_weight"];
		$tr_datetime 	 = $rowg["tr_datetime"];
		$tr_status	 	 = $rowg["tr_status"];
		
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
                                    <h2 style="text-align: center;font-weight: 400;">Live Chicken Transfer </h2>
                                    <h4 style="text-align: center;font-weight: 400;">Status : 
									
									<?php if($tr_status==0){ ?>		
										In Process	
								<?php } else if($tr_status==1) { ?>
										Sent to Shop
								<?php } else if($tr_status==2) { ?>
										Approved
								<?php } else if($tr_status==3) { ?>
										Verified at Shop
								<?php } else if($tr_status==4) { ?>
										For Approval at Slaughter House
								<?php } ?>
									
									</h4>
                                 </div>
                            </div>
                        </div>
                            
						 <div class="row">	
							<div class="col-md-6" style="text-align: center;">
                                <h4>Date : <?php echo $tr_datetime; ?></h4>
                                
                            </div>
							
							<div class="col-md-6" style="text-align: center;">
                                <h4>Shop : <?php echo get_title(shop_name,$shop_id,$dbconfig); ?></h4>
 
                            </div>
                        </div>
                        
						<div class="row">
                            <div class="col-md-12">
                                <div class="invoice-title">
                                    <h3 style="text-align: center;font-weight: 400;">Transfer Detail</h3>
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
										 
                                            <tr>
                                                 
                                                <td class="invoice-qty">
                                                    <?php echo $s_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $s_weight_; ?>
                                                </td>
												<td class="invoice-qty">
                                                    <?php echo $r_qty_; ?>
                                                </td>
                                                <td class="invoice-qty">
                                                   <?php echo $r_weight_; ?>
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
