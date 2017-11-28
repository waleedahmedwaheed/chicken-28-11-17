<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

 $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
										<li class="active-page"> Rates </li>
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
								<h4>Add Products Rate</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2> <center><?php //echo get_title(shop_name,$_SESSION["s_id"],$dbconfig); ?> </center> </h2>
										
										<form class="form-horizontal" method="get" id="userForm">
										
										
										<div class="form-group">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-8">
												<select class="form-control" name="s_id" required >
													<option value="">--Select--</option>
													<?php
													if($shop_ho==1)
													{
														$selectSQL = "select * from shop ORDER BY shop_id ASC";
													}
													else if($shop_ho==0)
													{
														$selectSQL = "select * from shop where shop_id = '".$_SESSION["s_id"]."'";
													}
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["shop_id"]; ?>" <?php if($row1["shop_id"]==$_GET["s_id"]){ echo "selected"; } ?>><?php echo $row1["shop_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
												  <input type="submit" class="btn btn-primary" value="Submit" />
												 </div>
											</div>
										</div>
									</form>
											<span id="response"> </span>
											
										
										
										<h3> <center><?php $date = date('Y-m-d'); echo date('l jS \of F Y'); ?> </center> </h3>
									</div>
									
									<?php if(isset($_GET["s_id"]))
									{	?>
									
									<table class="table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Product
										</th>
										<th>
											Sale Price <small> (kg) </small>
										</th>
										<th class="hide">
											Wholesale Price
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
											Product
										</th>
										<th>
											Sale Price <small> (kg) </small>
										</th>
										<th class="hide">
											Wholesale Price
										</th>
										 <th>
											Status
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							 $selectSQL = "select * from product where prod_status = 0 ORDER BY prod_id desc";
							 mysql_select_db($database_dbconfig, $dbconfig);
							 $Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							 while($row1 = mysql_fetch_assoc($Result1))
							 {
								 $prod_id 		  	= $row1['prod_id'];
								 $prod_status_ 		= $row1['prod_status'];
								 
								 $date = date('Y-m-d');
								
									//$pur_price = get_price(pur_price,$prod_id,$_SESSION["s_id"],$date);
									$sale_price = get_price(sale_price,$prod_id,$_GET["s_id"],$date,$dbconfig);
									$ws_price = get_price(ws_price,$prod_id,$_GET["s_id"],$date,$dbconfig);
									//$sup_price = get_price(sup_price,$prod_id,$_SESSION["s_id"],$date,$dbconfig);
									?>
								<form class="form-horizontal" method="post" id="userForm<?php echo $prod_id; ?>">	
									<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>" />
									<input type="hidden" name="r_date" value="<?php echo $date; ?>" />
									<input type="hidden" name="shop_id" value="<?php echo $_GET["s_id"]; ?>" />

									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php echo $row1['prod_name']; ?>
										</td>
										<td>
											<input type="text" name="sale_price" id="sale_price<?php echo $prod_id; ?>" onchange="change_values<?php echo $prod_id; ?>();" value="<?php echo $sale_price; ?>" <?php if($sale_price<>""){ ?> style="background-color:#337ab7; color:white;width: 50%;" <?php } else { ?> style="width: 50%;" <?php } ?> class="decimal form-control" placeholder="0.00"  /> 
										</td>
										<td>
											<!--<input type="text" name="ws_price" id="ws_price<?php echo $prod_id; ?>" onchange="change_values<?php echo $prod_id; ?>();" value="<?php echo $ws_price; ?>" <?php if($ws_price<>""){ ?> style="background-color:#337ab7; color:white;width: 50%;" <?php } else { ?> style="width: 50%;" <?php } ?> class="decimal form-control hide" placeholder="0.00"  /> -->
										</td>
										<td id="response<?php echo $prod_id; ?>" nowrap>
										 
										</td>
									</tr>
								</form>
								
	<script>							
	function change_values<?php echo $prod_id; ?>()
	{
		//var pur_price<?php echo $prod_id; ?> 	= document.getElementById("pur_price<?php echo $prod_id; ?>").value;
		var sale_price<?php echo $prod_id; ?> 	= document.getElementById("sale_price<?php echo $prod_id; ?>").value;
		//var ws_price<?php echo $prod_id; ?> 	= document.getElementById("ws_price<?php echo $prod_id; ?>").value;
		//var sup_price<?php echo $prod_id; ?> 	= document.getElementById("sup_price<?php echo $prod_id; ?>").value;
		
		//if ((sale_price<?php echo $prod_id; ?> != "") && (ws_price<?php echo $prod_id; ?> != ""))
		if (sale_price<?php echo $prod_id; ?> != "")
		{
			console.log("ok");
			//document.getElementById("pur_price<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			//document.getElementById("pur_price<?php echo $prod_id; ?>").style.color = "white";
			document.getElementById("sale_price<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			document.getElementById("sale_price<?php echo $prod_id; ?>").style.color = "white";
			//document.getElementById("ws_price<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			//document.getElementById("ws_price<?php echo $prod_id; ?>").style.color = "white";
			//document.getElementById("sup_price<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			//document.getElementById("sup_price<?php echo $prod_id; ?>").style.color = "	white";
			
			//$('#userForm<?php echo $prod_id; ?>').submit();
			
			  $.ajax({
				  type: "POST",
				  url: "add_rates.php",
				  data: $("#userForm<?php echo $prod_id; ?>").serialize(),
				  success: function(data) {
					$("#response<?php echo $prod_id; ?>").html(data)
				  }
				});
			
			   
		}
		else
		{
			console.log("not ok");
			//document.getElementById("pur_price<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			//document.getElementById("pur_price<?php echo $prod_id; ?>").style.color = "#555555";
			document.getElementById("sale_price<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			document.getElementById("sale_price<?php echo $prod_id; ?>").style.color = "#555555";
			//document.getElementById("ws_price<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			//document.getElementById("ws_price<?php echo $prod_id; ?>").style.color = "#555555";
			//document.getElementById("sup_price<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			//document.getElementById("sup_price<?php echo $prod_id; ?>").style.color = "#555555";
		}
		
		/*if ((pur_price<?php echo $prod_id; ?> !== null) && (sale_price<?php echo $prod_id; ?> !== null)
			&& 	(ws_price<?php echo $prod_id; ?> !== null) && (sup_price<?php echo $prod_id; ?> !== null))
		{
			//alert('Changed');
			console.log("changed");
		}
		else
		{
			//alert('Not Changed');
			console.log("not changed");
		}*/
		
	}
	</script>							
 
								
							 <?php	}	 ?>	
									
									
									
                                       </tbody>
										</table>
									
										<div class="form-group hide">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-4">
												<div class="form-actions">
													 
													<input type="submit" class="btn btn-primary btn-block" value="Finalize" />
													  
												</div>
											</div>
											<div class="col-md-4">
											</div>
										</div>
									<?php } ?>	 
									 
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