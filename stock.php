<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 //error_reporting(0);

 $s_id = $_SESSION['s_id'];
	
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
 
<style type="text/css">
	.panel
	{
	display:none;
	}
</style>

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
										<li class="active-page"> Stock </li>
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
						
						<div class="section-header">
							<h2>Stock</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Stock Detail</h4>
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
