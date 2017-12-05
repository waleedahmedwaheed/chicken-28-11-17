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
	$shop_id   = $_POST["shop_id"];
	
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

<style>
th
{
	font-weight: bold;
    font-size: 16px;
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
										<li class="active-page"> Report </li>
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
								<h4>Select Options</h4>
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
										  <div class="col-md-2">
												 
													<input type="submit" class="btn btn-primary" value="Submit" name="search" />
												 
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
								<h4>Summary Branch</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table">
									<thead>
									<tr>
										<th>
											Date
										</th>
										<th>
											<?php echo date("jS F, Y", strtotime("$date_from")); ?> 
										</th>
										<th>
											Branch 
										</th>
										<th colspan="2">
											<?php echo get_title(shop_name,$shop_id,$dbconfig); ?>
										</th>
									 </tr>
									</thead>
									 
									<tbody>
									
									<tr>
									
									<th> Product </th>
					
						<?php
							
				$selectSQL = "select * from product_category where pcat_status = 0 order by pcat_id";
							//echo $selectSQL;
							
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pcat_id'];
								$pcat_desc  	= $row1['pcat_desc'];
						?>
						
								<td> <?php echo $pcat_desc; ?> </td>  
							
						<?php 
						
						$curqty = $curtqy + $qty_;
						$curwgt = $curwgt + $weight_;
						$qty_ 	 = 0;
						$weight_ = 0;
						} ?>
									</tr>
									
									
									<tr>
										<th>
											Opening Stock
										</th>
											<?php
							
				$selectSQL = "select * from product_category where pcat_status = 0 order by pcat_id";
							//echo $selectSQL;
							
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pcat_id'];
								$pcat_desc  	= $row1['pcat_desc'];
								$openwgt 		= get_openprodstock(weight_open,$shop_id,$id,$date_from,$date_to,$dbconfig);
						?>
				
										<td>
											<?php echo number_format($openwgt,3); ?>
										</td>
							<?php } ?>				
									</tr>
									
									<tr>
										<th>
											Sale
										</th>
											<?php
							
				$selectSQL = "select * from product_category where pcat_status = 0 order by pcat_id";
							//echo $selectSQL;
							
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pcat_id'];
								$pcat_desc  	= $row1['pcat_desc'];
								$salewgt 		= get_openprodstock(weight_sales,$shop_id,$id,$date_from,$date_to,$dbconfig);
						?>
				
										<td>
											<?php echo number_format($salewgt,3); ?>
										</td>
							<?php } ?>				
									</tr>
									 
									 <tr>
										<th>
											Loss
										</th>
											<?php
							
				$selectSQL = "select * from product_category where pcat_status = 0 order by pcat_id";
							//echo $selectSQL;
							
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pcat_id'];
								$pcat_desc  	= $row1['pcat_desc'];
								$losswgt 		= get_openprodstock(weight_loss,$shop_id,$id,$date_from,$date_to,$dbconfig);
						?>
				
										<td>
											<?php echo number_format($losswgt,3); ?>
										</td>
							<?php } ?>				
									</tr>

									<tr>
										<th>
											Closing Stock
										</th>
											<?php
							
				$selectSQL = "select * from product_category where pcat_status = 0 order by pcat_id";
							//echo $selectSQL;
							
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pcat_id'];
								$pcat_desc  	= $row1['pcat_desc'];
								$closwgt = get_openprodstock(weight_open,$shop_id,$id,$date_from,$date_to,$dbconfig) - 
		(get_openprodstock(weight_sales,$shop_id,$id,$date_from,$date_to,$dbconfig) + get_openprodstock(weight_loss,$shop_id,$id,$date_from,$date_to,$dbconfig));
						?>
				
										<td>
		<?php echo number_format($closwgt,3); ?>
										</td>
							<?php } ?>				
									</tr>
									
									<tr>
										<th>
											Total Amount
										</th>
											<?php
							
				$selectSQL = "select * from product_category where pcat_status = 0 order by pcat_id";
							//echo $selectSQL;
							
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pcat_id'];
								$pcat_desc  	= $row1['pcat_desc'];
								$price = get_openprodstock(weight_price,$shop_id,$id,$date_from,$date_to,$dbconfig);
						?>
				
										<td>
								<?php echo number_format($price,2); ?>
										</td>
							<?php 
							
							$total_price = $total_price + $price;
							
							} 
							?>				
									</tr>
									
									<tr>
										<td>
											 
										</td>
											<?php
							
						?>
				
										<td colspan="3">
		<?php
							
				
						?>
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
