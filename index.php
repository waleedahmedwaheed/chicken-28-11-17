<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	$shop_ho 	= $_SESSION['shop_head'];
   
	$date	 	= date("Y-m-d");
	$month 		= date("m");
	$year	 	= date("Y");	

 
 
 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="IC">
<title>IC - POS</title>

<?php include("style.php"); ?>

</head>
<body>
<div class="page-container list-menu-view">

	<?php include("left_sidebar.php"); ?>

<div class="page-content">
    <!--Topbar Start Here -->
		
	<?php include("header.php"); ?>	
		
	<div class="main-container">
			<div class="container-fluid">
				<div class="page-breadcrumb">
					<div class="row">
						<div class="col-md-3">
							
						</div>
						 <div class="col-md-4 responsive-fix top-mid">
                    <div class="notification-nav">
							<h2 style="text-align: center;font-weight: 400;"> <img src="images/logo-large.png" style="height: 80px;" alt="Islamabad Chicken"> </h2>	
							 	
						</div>
                    <div class="pull-left mobile-search">
						 
                    </div>
                </div>
				
					 
						<div class="col-md-3">
						
						<div class="page-breadcrumb-wrap">
								<div class="page-breadcrumb-info">
									<h2 class="breadcrumb-titles"> Mandi Rate : <b> <?php echo get_mandirate(mr_rate,$_SESSION['s_id'],date("Y-m-d"),$dbconfig); ?> Rs </b> </h2>
									<ul class="list-page-breadcrumb">
										<li> <h6> <?php echo date('l jS \of F Y h:i:s A'); ?> </h6>  </li>
									</ul>
								</div>
							</div>
 
						
						</div>
					</div>

					<div class="row">
						<div class="col-md-7">
							<div class="page-breadcrumb-wrap">
								<div class="page-breadcrumb-info">
									<h2 class="breadcrumb-titles">Dashboard <small>POS</small></h2>
									<ul class="list-page-breadcrumb">
										<li><a href="#">Home</a>
										</li>
										<li class="active-page"> Dashboard</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-5">
						</div>
					</div>
				</div>
                
				<?php if($shop_ho==1)
				{ ?>
				
				<div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap number-rotate">
                <span class="stat-w-title">Orders Today</span>
                <a href="#" class="ico-cirlce-widget w_bg_cyan">
                    <span><i class="fa fa-cart-plus"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value number-animate" data-value="<?php echo get_title(count_order,$date,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_title(count_order,$date,$dbconfig); ?></span>
                    <span class="w-meta-title">Orders</span>
                   
                </div>
            </div>
        </div>
							
        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap iconic-w-wrap">
                <span class="stat-w-title">Total Customers</span>
                <a href="#" class="ico-cirlce-widget w_bg_grey">
                    <span><i class="ico-users"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value number-animate" data-value="<?php echo get_title(count_cust,0,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_title(count_cust,0,$dbconfig); ?></span>
                    <span class="w-meta-title">Customers</span>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap iconic-w-wrap"> 
                <span class="stat-w-title">Sales Today</span>
                <a href="#" class="ico-cirlce-widget w_bg_blue_grey">
                    <span><i class="fa fa-money"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value" data-value="<?php echo get_title(daily_sp_cons,$date,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_title(daily_sp_cons,$date,$dbconfig); ?></span>
                    <span class="w-meta-title">PKR</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap iconic-w-wrap">
                <span class="stat-w-title">Total Products</span>
                <a href="#" class="ico-cirlce-widget w_bg_green">
                    <span><i class="ico-chart"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value number-animate" data-value="<?php echo get_title(count_prod,0,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_title(count_prod,0,$dbconfig); ?></span>
                    <span class="w-meta-title">Products</span>
                </div>
            </div>
        </div>
    </div>
				
				<?php } ?>
				
				
				
				<?php if($shop_ho==0)
				{ ?>
				
				<div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap number-rotate">
                <span class="stat-w-title">No of Sales Today</span>
                <a href="#" class="ico-cirlce-widget w_bg_cyan">
                    <span><i class="fa fa-cart-plus"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value number-animate" data-value="<?php echo get_mandirate(cur_sale,$shop_id,$cur_date,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_mandirate(cur_sale,$shop_id,$cur_date,$dbconfig); ?></span>
                    <span class="w-meta-title">Sales</span>
                </div>
            </div>
        </div>
							
        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap iconic-w-wrap">
                <span class="stat-w-title">Total Customers</span>
                <a href="#" class="ico-cirlce-widget w_bg_grey">
                    <span><i class="ico-users"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value number-animate" data-value="<?php echo get_title(count_cust,0,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_title(count_cust,0,$dbconfig); ?></span>
                    <span class="w-meta-title">Customers</span>
                </div>
            </div>
        </div>
		
        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap iconic-w-wrap"> 
                <span class="stat-w-title">Sales Today</span>
                <a href="#" class="ico-cirlce-widget w_bg_blue_grey">
                    <span><i class="fa fa-money"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value" data-value="<?php echo get_mandirate(daily_sp_shop,$_SESSION['s_id'],$date,$dbconfig); ?>" data-animation-duration="1500"><?php echo get_mandirate(daily_sp_shop,$_SESSION['s_id'],$date,$dbconfig); ?></span>
                    <span class="w-meta-title">PKR</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="iconic-w-wrap iconic-w-wrap">
                <span class="stat-w-title">Current Live Stock</span>
                <a href="#" class="ico-cirlce-widget w_bg_green">
                    <span><i class="ico-chart"></i></span>
                </a>
                <div class="w-meta-info">
                    <span class="w-meta-value number-animate"  data-animation-duration="1500"><?php echo get_stock(qty,$_SESSION['s_id'],9999,$dbconfig); echo " - "; echo get_stock(weight,$_SESSION['s_id'],9999,$dbconfig); ?></span>
                    <span class="w-meta-title">Birds - Weight (kg)</span>
                </div>
            </div>
        </div>
    </div>
				
				<?php } ?>
				
				
				<div class="row hide">
                    <div class="col-md-3 col-sm-6">
                        <div class="mini-stats-widget full-block-mini-chart">
                            <div class="mini-stats-top">
                                <span class="mini-stats-value">6,000</span>
                                <span class="mini-stats-label">Purchase Birds Today</span>
                            </div>
                            <div class="mini-stats-chart">
                                <div class="sparkline" data-type="line" data-resize="true" data-height="80" data-width="100%" data-line-width="2" data-min-spot-color="#e65100" data-max-spot-color="#ffb300" data-line-color="#26a69a" data-spot-color="#00838f" data-fill-color="#26a69a" data-highlight-line-color="#00acc1" data-highlight-spot-color="#ff8a65" data-spot-radius="false" data-data="[450,480,500,590,600,640,560,530,500,540, 570,600,550,520,510,500,510,540,580,590,580,564,600,700]">
                                </div>
                            </div>
                            <div class="mini-stats-bottom w_bg_teal">
                                <span><i class="ico-arrow-up"></i></span> Increase <span>10% </span>
                            </div>
                        </div>
                    </div>
					
					
					
                    <div class="col-md-3 col-sm-6">
                        <div class="mini-stats-widget">
                            <div class="mini-stats-top">
                                <span class="mini-stats-value">4,000</span>
                                <span class="mini-stats-label">Sales Today</span>
                            </div>
                            <div class="mini-stats-chart">
                                <div class="sparkline" data-type="bar" data-resize="true" data-height="80" data-width="90%" data-bar-color="#26c6da" data-bar-spacing="3" data-bar-width="4" data-data="[5,10,15,20,25,30,25,20,30,50,40,30,20,10,5]">
                                </div>
                            </div>
                            <div class="mini-stats-bottom">
                                <span><i class="ico-arrow-up"></i></span> Increase <span>20% </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="mini-stats-widget">
                            <div class="mini-stats-top">
                                <span class="mini-stats-value">2,000</span>
                                <span class="mini-stats-label">Supplies Today</span>
                            </div>
                            <div class="mini-stats-chart">
                                <div class="sparkline" data-type="bar" data-resize="true" data-height="80" data-width="90%" data-bar-color="#303f9f" data-bar-spacing="3" data-bar-width="4" data-data="[10,15,20,25,30,40,50,60,70,60,40,30,40,50,40]">
                                </div>
                            </div>
                            <div class="mini-stats-bottom">
                                <span><i class="ico-arrow-up"></i></span> Increase <span>30% </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="mini-stats-widget full-block-mini-chart">
                            <div class="mini-stats-top">
                                <span class="mini-stats-value">12,200</span>
                                <span class="mini-stats-label">Other Income</span>
                            </div>
                            <div class="mini-stats-chart">
                                <div class="sparkline" data-type="line" data-resize="true" data-height="80" data-width="100%" data-line-width="2" data-min-spot-color="#e65100" data-max-spot-color="#ffb300" data-line-color="#b388ff" data-spot-color="#00838f" data-fill-color="#b388ff" data-highlight-line-color="#00acc1" data-highlight-spot-color="#ff8a65" data-spot-radius="false" data-data="[450,480,500,590,600,640,560,530,500,540, 570,600,550,520,510,500,510,540,580,590,580,564,600,700]">
                                </div>
                            </div>
                            <div class="mini-stats-bottom w_bg_deep_purple">
                                <span><i class="ico-arrow-up"></i></span> Increase <span>10% </span>
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php 
					if($shop_ho==0)
					{
					?>
					
				<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<marquee behavior="alternate">
				<h5>Welcome to Point Of Sale, choose a common task below to get started!</h5>
				</marquee>
				</div>
				</div>
				
				<div class="row quick-actions">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="sales.php?it_id=1"> <i class="icon ti-shopping-cart"></i> Start a New Sale</a>
			</div>
		</div>
	

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hide">
			<div class="list-group">
					<a class="list-group-item" href="#"> <i class="ion-clipboard"></i> Today's summary items report</a>
			</div>
		</div>
		
	
  			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hide">
			<div class="list-group">
					<a class="list-group-item" href="#"> <i class="ion-clock"></i> Today's closeout report</a>
			</div>
		</div>
		
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="sales_report.php"> <i class="ion-stats-bars"></i> Today's detailed sales report</a>
			</div>
		</div>
		
			
			
	
</div>
					<?php } ?>

					<?php 
					if($shop_ho==1)
					{
					?>
				
				<div class="row">
                    <div class="col-md-12">
                        <div class="box-widget widget-module">
                            
                          <div id="container"  ></div>
						  
						  
                        
						</div>
                    </div>
                   
                </div>
				
				<div class="row">
                    <div class="col-md-6">
                        <div class="box-widget widget-module">
                            
                          <div id="container2"  ></div>
						  
						  
                        
						</div>
                    </div>
                   
				   <div class="col-md-6">
                        <div class="box-widget widget-module">
                            
                          <div id="container3"  ></div>
						  
						  
                        
						</div>
                    </div>
                   
                </div>
				
					<?php } ?>
				
				
				

                <div class="row">
                    <div class="col-md-8">
                        <div class="box-widget widget-module">
                          
						  <div id="container4"  ></div>
						 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-widget widget-module">
                            <div class="widget-head clearfix">
                                <span class="h-icon"><i class="fa fa-pie-chart"></i></span>
                                <h4>Daily Live Chicken Rate</h4>
                            </div>
                            <div class="widget-container">
                              <table class="table">
									<thead>
									<tr>
										<th> Mandi Rate </th>
										<td> <?php echo get_mandirate(mr_rate,$_SESSION['s_id'],date("Y-m-d"),$dbconfig); ?> Rs </td>
									</tr>
									<tr>
										<th> Sale Rate </th>
										<td> <?php echo get_mandirate(sale_rate,$_SESSION['s_id'],date("Y-m-d"),$dbconfig); ?> Rs </td>
									</tr>
									</thead>
							   </table>		
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