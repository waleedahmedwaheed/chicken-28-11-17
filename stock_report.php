<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 //echo "asdsadadsad";
	 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;
$cur_date = date("Y-m-d");

$where1 = array();

$st_inout_='';

if(isset($_POST["search"]))
{

	$date_from = $_POST["date_from"];
	$date_to   = $_POST["date_to"];	
	$shop_id   = $_POST["shop_id"];	
	if(isset($_POST['st_inout']))
	{
		$st_inout_ = $_POST["st_inout"];	
	}
	//if($st_inout_==2) { $st_inout__==0000; } else { $st_inout__==1; }
	
//echo $st_inout_."asdadasdad";


if(!empty($shop_id))
{
		$where1[] = "shop_id='$shop_id'";
}

if(!empty(is_numeric($st_inout_)))
{
	if($st_inout_==2)
	{
		$where1[] = "st_inout=0";
	}
	else if($st_inout_==1)
	{
		$where1[] = "st_inout=1";
	}
		
}
		
		
if(!empty($date_from) || !empty($date_to)){
		
$where1[]= "st_date between '$date_from' and '$date_to'"; 		

}
	

	
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
											<label class="col-md-2 control-label">Status</label>
											<div class=" col-md-3">
												<select class="form-control" name="st_inout"  >
													<option>--Select--</option>
													<option value="2" <?php if($st_inout_==2){ echo "selected"; } ?>>Stock In</option>
													<option value="1" <?php if($st_inout_==1){ echo "selected"; } ?>>Stock Out</option>
													  
												</select>
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
							<h2>Stock</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Stock Report</h4>
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
											Date
										</th>
										<th>
											Shop
										</th>
										<th>
											Product 
										</th>
										<th>
											Qty 
										</th>
										<th>
											Weight
										</th>
										<th>
											Status
										</th>
									 
									</tr>
									</thead>
									<tfoot>
										<tr>
										<th>
											#
										</th>
										<th>
											Date
										</th>
										<th>
											Shop
										</th>
										<th>
											Product 
										</th>
										<th>
											Qty 
										</th>
										<th>
											Weight
										</th>
										<th>
											Status
										</th>
									 
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from stock_view where ".implode(' and ', $where1)." ORDER BY stock_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['stock_id'];
								$st_date_  		= $row1['st_date'];
								$prod_id		= $row1['prod_id'];
								$qty  			= $row1['qty'];
								$weight  		= $row1['weight'];
								$st_inout  		= $row1['st_inout'];
								$shop_id		= $row1['shop_id'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo $st_date_; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id,$dbconfig); ?>
										</td>
										<td>
											<?php 
											if($prod_id==9999)
											{
												echo "Live Chicken";
											}
											else
											{
												echo get_title(prod_name,$prod_id,$dbconfig);
											}
											?>
										</td>
										<td>
											<?php echo $qty; ?>
										</td>
										<td>
											<?php echo $weight; ?>
										</td>
										<td>
											<?php 
											
											switch($st_inout)
											{
												case 0: echo "<span style='color:green;font-weight: 500'> Stock In </span>"; break;
												case 1: echo "<span style='color:red;font-weight: 500'> Stock Out </span>"; break;
											}
												
											?>
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
