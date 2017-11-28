<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 //echo "asdsadadsad";
	 
$cur_date = date("Y-m-d");
$where1 = array();

if(isset($_POST["search"]))
{
	
	$date_from = $_POST["date_from"];
	$date_to   = $_POST["date_to"];
	$shop_id   = $_POST["shop_id"];
	
	if(!empty($shop_id))
{
		$where1[] = "shop_id='$shop_id'";
}
		
if(!empty($date_from) || !empty($date_to)){
		
$where1[]= "date_added between '$date_from 00:00:00' and '$date_to 23:59:59'"; 		

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
 
 
 <script type="text/javascript">
var okToPrint=false;

function isIE()
{
return (navigator.appName.toUpperCase() == 'MICROSOFT INTERNET EXPLORER');
}

function doPrint(arg)

//{ window.printFrame.location.href="http://www.mysite.com/somepage.html";
{ window.printFrame.location.href="print_sale.php?sales_id="+arg;
okToPrint=true;
}

function printIt()
{if (okToPrint)
{ if ( isIE() )
{ document.printFrame.focus();
document.printFrame.print();
}
else
{ window.frames['printFrame'].focus();
window.frames['printFrame'].print();
}
}
}

</script> 
 

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
										<li class="active-page"> Sales </li>
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
                                            <button type="button" class="btn btn-default"><i class="fa fa-print"></i> 
											<a href="sales_report_print.php?shop_id=<?php echo $shop_id; ?>&start=<?php echo $date_from; ?>&end=<?php echo $date_to; ?>">Print </a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
					<div id="printableArea">
					<div class="row">
					<div class="col-md-12">
						
						<div class="section-header hide">
							<h2>Sales</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Sales Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Sales No
										</th>
										<th>
											Shop 
										</th>
										<th>
											Total
										</th>
										<th>
											Discount
										</th>
										<th>
											Net Total
										</th>
										 <th>
											
										</th>
										<th>
											Detail
										</th>
									</tr>
									</thead>
									 
									
									 
									<tbody>
									<?php

						 $selectSQL = "select * from sales where ".implode(' and ', $where1)." and sale_status = 2 order by sales_id desc";

							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['sales_id'];
								$sales_no_  	= $row1['sales_no'];
								$shop_id_  		= $row1['shop_id'];
								$total_		  	= $row1['total'];
								$discount_	  	= $row1['discount'];
								$amount_due_  	= $row1['amount_due'];
								
								$total 			= $total + $amount_due_;
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo $sales_no_; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$shop_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo number_format($total_,2); ?>
										</td>
										<td>
											<?php echo number_format($discount_,2); ?>
										</td>
										<td>
											<?php echo number_format($amount_due_,2); ?>
										</td>
										  
										<td>
					<button class="btn btn-xs btn-primary" type="button" onclick="doPrint(<?php echo $id; ?>);">
                        Print
                      </button>
										</td>
									  
										 
								<td>
								
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $id; ?>"><i class="fa fa-file-word-o"></i></button>					
				
		<!-- Modal -->
<div id="myModal<?php echo $id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sales Detail</h4>
      </div>
      <div class="modal-body">
        <table class="table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Product Name
										</th>
										<th>
											Price
										</th>
										<th>
											Quantity
										</th>
										<th>
											Weight
										</th>
										<th>
											Total
										</th>
									</tr>
									<?php
							$selectsSQL = "select * from sales_detail where sales_no = '$sales_no_' and sd_status <> 1 ORDER BY sd_id DESC";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Results = mysql_query($selectsSQL, $dbconfig) or die(mysql_error());	 
							while($rows = mysql_fetch_assoc($Results))
								{
									$sales_id	= $rows["sales_id"];
									$prod_id_	= $rows["prod_id"];
									$sdate_		= $rows["sd_date"];
									$qty_		= $rows["qty"];
									$weight_	= $rows["weight"];
									$price_		= $rows["price"];
									$id			= $rows["sd_id"];
									$item_type_ = get_title(item_type,$sales_id,$dbconfig);
									if($prod_id_=="9999"){
									$live 		= get_mandirate(sale_rate,$shop_id_,$sdate_,$dbconfig);
									}
									else
									{
										$price__ = get_price(sale_price,$prod_id_,$shop_id_,$sdate_,$dbconfig);
									}
									
									
									switch($item_type_)
									{
										case 1:
										$mode = "sale_price";
										break;
										case 2:
										$mode = "ws_price";
										break;
										case 3:
										$mode = "sup_price";
										break;
									}
									//echo $mode;
								?>		
									<tr>
										<td>
											<?php echo $b = $b + 1; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); }; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999"){ echo number_format($live,2); } else { echo number_format($price__,2) ; } ?>
										</td>
										<td>
											<?php echo $qty_; ?>
										</td>
										<td>
											<?php echo $weight_; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999"){ echo number_format($live * $weight_,2); } else { echo number_format($price__ * $weight_,2); } ?>
										</td>
									 </tr>
									 
									 
								<?php } ?>	 
									 
									</thead>
									 
									<tbody>
									</tbody>
									</table>
									
									
									
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>			
								
										</td>
									</tr>
							
						
							
							
										<?php } ?>
								
									<tr>
										<th>
											Total
										</th>
										<th>
											 
										</th>
										<th>
											 
										</th>
										<th>
											 
										</th>
										<th>
											 
										</th>
										<th>
											<?php echo number_format($total,2); ?>
										</th>
										 <th>
											
										</th>
										<th>
											Detail
										</th>
									</tr>
					  
					  <iframe width="0" height="0" name="printFrame" id="printFrame" onload="printIt()"></iframe>
					  
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

<script>
$('#example').dataTable( {
  "pageLength": 50
} );
</script>

</body>
</html>
