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
										<li class="active-page">Chiller Production </li>
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
							<h2>Chiller Production</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Chiller Transfer Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Shop 
										</th>
										<th>
											Date
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
											Date
										</th>
									   <th>
											Detail
										</th>
										 
									</tr>
									</tfoot>
									<tbody>
									 
								  <?php	
							$selectSQL = "select * from prod_processed_view ORDER BY ppr_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['ppr_id'];
								$shop_id_  		= $row1['shop_id'];
								$ppr_date_  	= $row1['ppr_date'];
								$ppr_status_  	= $row1['ppr_status'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $ppr_date_; ?>
										</td>
										  
										<td>
	<a href="processed_print.php?ppr_id=<?php echo $id;?>" class="btn btn-info btn-xs" data-toggle = "modal" ><i class = "fa fa-print"></i> </a>	
							
							 
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
