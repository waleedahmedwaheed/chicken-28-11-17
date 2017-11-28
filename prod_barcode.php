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

	$prod_name		 = $_POST["prod_name"];
	//$prod_code  	 = $_POST["prod_code"];	
	$qty		  	 = $_POST["qty"];	
	$weight		  	 = $_POST["weight"];	
	
	$prod_id_		 = $_POST["prod_id"]; 
	 

if(!empty($prod_name))
{
		$where1[] = "prod_name like '$prod_name%'";
}	

if(!empty($prod_code))
{
		$where1[] = "prod_code='$prod_code'";
}

if(empty($qty))
{
		$qty = 0;
}		

if(empty($weight))
{
		$weight = 0;
}		

	 $insertSQL = "INSERT INTO barcode
	 (prod_id,qty,wgt,user_id) 
			VALUES('$prod_id_','$qty','$weight','".$_SESSION['id']."')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
	
	$selectSQL = "SELECT LAST_INSERT_ID() as bar_id from barcode where user_id = '".$_SESSION['id']."'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	
	$row 	= mysql_fetch_assoc($Result);
	$bar_id = $row["bar_id"];
	
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
{ window.printFrame.location.href="print_barcode.php?bar_id="+arg;
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
										<li class="active-page">Barcode Generation </li>
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
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-3">
												<select name="pcat_id" id="cat" required class="form-control">
													<option value="">--Select--</option>
										<option value="9999" <?php if($pcat_id==9999){ echo "selected"; } ?>>Live Chicken</option>			
													<?php 
													$getSQLs = "select * from product_category order by pcat_desc";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
													while($rowgs = mysql_fetch_assoc($Resultgs))
													{
													$pcat_desc_s		 = $rowgs["pcat_desc"];
													$pcat_id_s		 	 = $rowgs["pcat_id"];
													?> 
						
						<option value="<?php echo $pcat_id_s; ?>" <?php if($pcat_id_s==$pcat_id){ echo "selected"; } ?>><?php echo $pcat_desc_s; ?></option>
													<?php } ?>
												</select>
											</div>
											
											<label class="col-md-2 control-label">Product *</label>
											<div class=" col-md-3">
												<select name="prod_id" id="product" required class="form-control">
													<option value="">--Select--</option>
												</select>
											</div>
											
											</div>
											
										<div class="form-group">
											
											<label class="col-md-2 control-label">Weight *</label>
											<div class=" col-md-2">
												<input type="text" name="weight" class="form-control number" maxlength="7" value="<?php echo $weight; ?>" required>
											</div>
											<label class="col-md-3 control-label">Qty </label>
											<div class=" col-md-2">
												<input type="text" name="qty" class="form-control validateNumber" maxlength="5" value="<?php echo $qty; ?>" >
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
                                            <button type="button" onclick="doPrint(<?php echo $bar_id; ?>); blur(this);" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
					<div class="row">
					<div class="col-md-12">
						
						<div class="section-header hide">
							<h2>Product</h2>
						</div>
						<div class="box-widget widget-module">
							 
							<div class="widget-container" id="printableArea">
								<div class=" widget-block">
									
									<table class="table">
									<thead>
									 
									</thead>
									 
									<tbody>
									<?php	
							/*if (!empty($where1))
							{								
							$selectSQL = "select * from product where ".implode(' and ', $where1)." ORDER BY prod_id";
							}
							else
							{
							$selectSQL = "select * from product ORDER BY prod_id";
							}
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id			 	= $row1['prod_id'];
								$prod_status_ 	= $row1['prod_status'];			
								$prod_code_ 	= $row1['prod_code'];			
									?>
									 
										<?php }*/ ?>
									
								 
									</tbody>
									</table>
									
									<table class="table">
									<?php for($i=1;$i<=10;$i++){ ?>
									<tr>
										<td style="text-align: center">
											<img src="barcode.php?codeText=<?php echo $bar_id; ?>" height="40" width="100" />
											<br> <p style="text-align: center"> <?php echo $bar_id; ?> </p>  
										</td>
										<td style="text-align: center">
											<img src="barcode.php?codeText=<?php echo $bar_id; ?>" height="40" width="100" />
											<br> <p style="text-align: center"> <?php echo $bar_id; ?> </p> 
										</td>
										<td style="text-align: center">
											<img src="barcode.php?codeText=<?php echo $bar_id; ?>" height="40" width="100" />
											<br> <p style="text-align: center"> <?php echo $bar_id; ?> </p> 
										</td>
										<td style="text-align: center">
											<img src="barcode.php?codeText=<?php echo $bar_id; ?>" height="40" width="100" />
											<br> <p style="text-align: center"> <?php echo $bar_id; ?> </p> 
										</td>
										<td style="text-align: center">
											<img src="barcode.php?codeText=<?php echo $bar_id; ?>" height="40" width="100" />
											<br> <p style="text-align: center"> <?php echo $bar_id; ?> </p> 
										</td>
										 
									</tr>
									<?php } ?>
									</table>
									
									 <iframe width="0" height="0" name ="printFrame" id="printFrame" onload="printIt()"></iframe>
									 
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
$("select#cat").change(function(){

	var cat =  $("select#cat option:selected").attr('value'); 
	//alert(cat);
	//$("#product").html( "" );
	//$("#location").html( "" );
	
	if (cat.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-records.php",
			data: "cat="+cat,
			cache: false,
			beforeSend: function () { 
				$('#product').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#product").html( html );
			}
		});
	} 
});
</script>


</body>
</html>
