<?php include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0);

	 
//echo $_SESSION["s_id"]."asdasdasdasdas";exit;

	if(isset($_GET["pp_id"]))
	{
	
		$getSQL = "select * from production_prod where pp_id = '".$_GET["pp_id"]."' and pro_id = '".$_GET["pro_id"]."' and pp_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		  
		$pro_id		 	 = $rowg["pro_id"];
		$pp_status	 	 = $rowg["pp_status"];
		$prod_id	 	 = $rowg["prod_id"];
		$p_qty		 	 = $rowg["p_qty"];
		$p_weight		 = $rowg["p_weight"];
		$pp_id			 = $rowg["pp_id"];
	
	}
	
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
 


<script type="text/javascript">
$(document).ready(function()
{
$(".pcl_button").click(function(){

var element = $(this);
var I = element.attr("id");

$("#slidepanel"+I).slideToggle(300);
$(this).toggleClass("active"); 

return false;});});
</script>
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
										<li class="active-page"> Production </li>
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
								<h4>Add Products</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Products Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										 <input type="hidden" name="pro_id" value="<?php echo $_GET["pro_id"]; ?>" />
										
										<div class="form-group">
											<label class="col-md-2 control-label">Category *</label>
											<div class=" col-md-8">
												<select name="pcat_id" id="cat" required class="form-control">
													<option value="">--Select Category--</option>
													<?php 
													$getSQLs = "select * from product_category order by pcat_desc";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Resultgs = mysql_query($getSQLs, $dbconfig) or die(mysql_error());	 
													while($rowgs = mysql_fetch_assoc($Resultgs))
													{
													$pcat_desc_s		 = $rowgs["pcat_desc"];
													$pcat_id_s		 	 = $rowgs["pcat_id"];
													?> 
						<option value="<?php echo $pcat_id_s; ?>" <?php if($pcat_id_s==get_title(pcat_id,$prod_id,$dbconfig)){ echo "selected"; } ?>><?php echo $pcat_desc_s; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
									  
										<div class="form-group">
											 <div class=" col-md-12" id="product">
												
												
												
												
											</div>
											 
										</div>
										 
									
									</form>
											<span id="response"> </span>	
								</div>
							</div>
						</div>
						
						
						
					</div>
					
					</div>
					
					
					<div class="row">
					<div class="col-md-12">
						
						<div class="section-header">
							<h2>Products</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Products Detail</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block" id="dttable">
									
									
									
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

<script>
var pro_id = <?php echo $_GET["pro_id"]; ?>;
$("#dttable").load("pro_prod.php?pro_id="+pro_id);
$("select#cat").change(function(){

	var cat =  $("select#cat option:selected").attr('value'); 
	var pro_id = <?php echo $_GET["pro_id"]; ?>;
	//alert(pro_id);
	$("#product").html( "" );
	//$("#location").html( "" );
	
	if (cat.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-recordst.php",
			data: "cat="+cat+"&pro_id="+pro_id,
			cache: false,
			beforeSend: function () { 
				$('#product').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#product").load("fetch-recordst.php?cat="+cat+"&pro_id="+pro_id);
				$("#dttable").load("pro_prod.php?pro_id="+pro_id);
			}
		});
	} 
});
</script>

</body>
</html>
