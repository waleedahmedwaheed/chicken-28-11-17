<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
 //echo "asdsadadsad";
	 
$where1 = array();

$cur_date = date("Y-m-d");

if(isset($_POST["search"]))
{

	$auth_person = $_POST["auth_person"];
	$cust_contact   = $_POST["cust_contact"];	
	 

if(!empty($auth_person))
{
		$where1[] = "auth_person='$auth_person'";
}	

if(!empty($cust_contact))
{
		$where1[] = "cust_contact='$cust_contact'";
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
										<li class="active-page">Customer </li>
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
								<h4>Enter Information</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									 
									<form class="form-horizontal" method="post" action="?id=1">
										
									 
										
										<div class="form-group">
											<label class="col-md-2 control-label">Auth Person </label>
											<div class=" col-md-3">
												<input type="text" name="auth_person" class="form-control" value="<?php echo $auth_person; ?>"  >
											</div>
											<label class="col-md-2 control-label">Contact</label>
											<div class=" col-md-3">
												<input type="text" name="cust_contact" class="form-control" value="<?php echo $cust_contact; ?>"  >
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
							<h2>Customer</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Customer Report</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											Name
										</th>
										<th>
											Address
										</th>
										<th>
											Contact
										</th>
										<th>
											Auth Person
										</th>
										<th>
											Status
										</th>
										 
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											Name
										</th>
										<th>
											Address
										</th>
										<th>
											Contact
										</th>
										<th>
											Auth Person
										</th>
										<th>
											Status
										</th>
										 
									</tr>
									</tfoot>
									<tbody>
									<?php	
							if (!empty($where1))
							{								
							$selectSQL = "select * from customer where ".implode(' and ', $where1)." ORDER BY cust_name";
							}
							else
							{
							$selectSQL = "select * from customer ORDER BY cust_name";
							}
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id			 	= $row1['cust_id'];
								$cust_status_ 	= $row1['cust_status'];			
									?>
									<tr>
										<td>
											<?php echo $row1['cust_name']; ?>
										</td>
										<td>
											<?php echo $row1['cust_address']; ?>
										</td>
										<td>
											<?php echo $row1['cust_contact']; ?>
										</td>
										<td>
											<?php echo $row1['auth_person']; ?>
										</td>
										<td>
											<?php switch($cust_status_)
											{
												case 0:
												echo "<span style='color:green;'>Active</span>";
												break;
												case 1:
												echo "<span style='color:red;'>Inactive</span>";
												break;
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
