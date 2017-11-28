<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);
 
   $shop_ho 	= $_SESSION['shop_head'];
 if($shop_ho==1)
 {
	 echo "<script>window.location='index.php'</script>";
 }
 
 
		if(isset($_GET["sd_id"]))
		{
				$selectsSQL = "select * from sales_detail where sd_id = '".$_GET["sd_id"]."' and sd_status = 0";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Results = mysql_query($selectsSQL, $dbconfig) or die(mysql_error());	 
							$rows = mysql_fetch_assoc($Results);
							
									$prod_id_	= $rows["prod_id"];
									$sales_id	= $rows["sales_id"];
									$sdate_		= $rows["sd_date"];
									$qty_		= $rows["qty"];
									$weight_	= $rows["weight"];
									$price_		= $rows["price"];
									$sd_id_		= $rows["sd_id"];
									$item_type_ = get_title(item_type,$sales_id,$dbconfig);
									$shop_id    = get_title(shop_id,$sales_id,$dbconfig);
									$sales_no 	= $rows["sales_no"];
									
									if($prod_id_ == 9999)
									{
										$pcat_id 	= 9999;
									}
									else
									{
										$pcat_id 	= get_title(pcat_id,$prod_id_,$dbconfig);
									}
		}
		else
		{
			$getSQL = "select (IFNULL(MAX(sales_id), 0)+1) as sales_id from sales where shop_id = '".$_SESSION["s_id"]."' and sale_status <> 0 and item_type = '".$_GET["it_id"]."'";
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultg 	= mysql_query($getSQL, $dbconfig) or die(mysql_error());
			$rowg 		= mysql_fetch_assoc($Resultg);
			$sales_id	= $rowg["sales_id"];
			$sales_no 	= "ORD-".$_SESSION["s_id"].$_GET["it_id"]."-".$sales_id;	 
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
 
<script>

$(document).ready(function (e) {
	document.getElementById('barcode').value = "";
	$("#barcode").focus();
var sales_no = '<?php echo $sales_no; ?>';	
 $( "#table_id" ).load( "table_sales.php?sales_no="+sales_no); 
 $( "#salebar" ).load("salebar.php?sales_no="+sales_no);
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "add_sales.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#loader").hide();
$('#userForm')[0].reset();
$("#response").html(data);
//window.location="product.php";
 $( "#table_id" ).load( "table_sales.php?sales_no="+sales_no);
 $( "#salebar" ).load("salebar.php?sales_no="+sales_no);
 //document.getElementById('barcode').value = "";
 //$("#barcode").focus();
}
});

}));
});


/* function getQueryVariable(url, query) {

  url = url.replace(/.*?\?/, "");
  url = url.replace(/_&_/, "_%26_");

    var vars = url.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == query) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}
 */
//var url = "http://test/Preview.aspx?By=AJ_Swift&Title=Meeting_Planning_&_Participation";

function sale()
{
//alert("asdas");	
//var url = document.getElementById("barcode").value;
//document.getElementById('barcode').value = "";

//var input = "2000108002652";


//console.log(part1, part2, part3);
//alert(part1, part2, part3);
 
//var qty = document.getElementById("bqty").value;
//alert(qty);
var wgt = document.getElementById("bwgt").value;
var prod_id = document.getElementById("bprod_id").value;

//var prod_id = part2;
//alert(part2);  

var qty_ = document.getElementById("qty").value = 1;
var wgt_ = document.getElementById("weight").value = wgt;



var newOptionsHtml = "<option value='"+prod_id+"'>Product</option>";

$("#product").html(newOptionsHtml);
 
  $.ajax({
		  type: "POST",
		  url: "add_sales.php",
		  data: $("#userForm").serialize(),
		  success: function(data) {
			$("#response").html(data);
			var sales_no = '<?php echo $sales_no; ?>';	
			 $( "#table_id" ).load( "table_sales.php?sales_no="+sales_no); 
			 $( "#salebar" ).load("salebar.php?sales_no="+sales_no);
			 $('#userForm')[0].reset();
		  }
		});
 
 document.getElementById('barcode').value = "";
 $("#barcode").focus();
// alert(prod_id);
//alert(qty);
//alert(wgt);
}
</script>


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
				<div class="page-breadcrumb hide">
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
							
							<div class="widget-container">
								<div class="widget-block" style="padding-top: 0px;">
									<div class="page-header">
										<h3> <center><?php echo get_title(shop_name,$_SESSION["s_id"],$dbconfig); ?> </center> </h3>
										<h4> <center><?php $date = date('Y-m-d'); echo date('l jS \of F Y'); ?> </center> </h4>
										<h4> <center>
							<?php  echo $sales_no; ?> 
								</center> </h4>
									
									</div>
									
									<div class="row">
									<div class="col-md-8">
									
							<form class="form-horizontal" method="post" id="userForm">
								
								<input type="hidden" name="shop_id" value="<?php echo $_SESSION["s_id"]; ?>" />
								<input type="hidden" name="sales_no" id="sales_no" value="<?php echo $sales_no; ?>" />
								<input type="hidden" name="item_type" id="item_type" value="<?php echo $_GET["it_id"]; ?>" />
								
	<!--<input type="text" name="barcode" id="barcode" onchange="sale();" onblur="sale();" value="&amp;prod_id=2&amp;qty=0&amp;wgt=10" style="width: 1%;" />-->
		<input type="text" name="barcode" id="barcode" maxlength="13" placeholder="barcode" value="" style="width: 100%;" />
								<div id="bar"> </div>
									<table class="table">
									<tr>
									 
										<th>
											<center>Cat</center>
										</th>
										<th>
											<center>Product</center>
										</th>
										<th>
											<center>Qty</center>
										</th>
										<th>
											<center>Weight</center>
										</th>
										<th>
											 
										</th>
									</tr>
									<tr>
										 
										
										<th width="30%">
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
										</th>
										
										<th width="30%">
											<select name="prod_id" id="product" required class="form-control">
													
													<?php
													if(isset($_GET["sd_id"]))
													{
													?>
													<option value="<?php echo $prod_id_; ?>"><?php if($prod_id_=="9999"){ echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); } ?></option>
													<?php } else { ?>
													<option value="">--Select--</option>
													<?php } ?>
													
												</select>
										</th>
										<th width="12%">
											<input type="text" name="qty" id="qty" value="<?php echo $qty_; ?>" class="form-control validateNumber" />	
										</th>
										<th width="18%">
											<input type="text" name="weight" id="weight" value="<?php echo $weight_; ?>" class="form-control number" />	
										</th>
										<th width="20%">
										
										<?php if(isset($_GET["sd_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="sd_id" value="<?php echo $_GET["sd_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
											<?php if(isset($_GET["sd_id"]))
											{ ?>
								<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-edit"> </i> </button>	
											<?php } else { ?>
								<button type="submit" name="submit" class="btn btn-success"><i class="ico-circle-with-plus"> </i> </button>	
											<?php } ?>
											
						

									</th>
									</tr>
									</table>
									</form>
									
									<span id="response"> </span>
									
					
								<div id="table_id" >
											

									</div>
									 
									 </div>
									
								<div class="col-md-4" id="salebar">
								
															
						 
									 
									 </div>
									 
									 <iframe width="0" height="0" name="printFrame" id="printFrame" onload="printIt()"></iframe>
									 
									 </div>
									 
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

<script>
 $("#barcode").bind("propertychange change click keyup input paste blur", function(){

	var barcode =  document.getElementById("barcode").value;
	//alert("barcode="+barcode);
	$("#bar").html( "" );
	//$("#location").html( "" );
	
	//var input = document.getElementById('barcode').value = "";
	barcode = barcode.replace(/\\D/g, "");
	var part1 = barcode.substring(0, 1),
    part2 = barcode.substring(4, 7),
    part3 = barcode.substring(7, 13);
	
	if (barcode.length == 13 ) { 
		
	 $.ajax({
			type: "POST",
			url: "fetch-records-b.php",
			data: "barcode="+part2+"&wgt="+part3/10000,
			cache: false,
			beforeSend: function () { 
				$('#bar').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#bar").html( html );
				sale();
			}
		});
	} 
	//sale();
}); 
</script>

<script>
   /*  shortcut.add("d", function() {
        $("#discount").focus();
    }); 
	shortcut.add("t", function() {
        $("#cash").focus();
    });   
	shortcut.add("h", function() {
        $("#changed").focus();
    });   
    shortcut.add("r", function() {
        $("#roundoff").focus();
    });
	shortcut.add("q", function() {
        $("#qty").focus();
    });
	shortcut.add("w", function() {
        $("#weight").focus();
    }); 
	shortcut.add("c", function() {
        $("#cat").focus();
    });
	shortcut.add("p", function() {
        $("#product").focus();
    });
	shortcut.add("b", function() {
        $("#barcode").focus();
    }); 
	shortcut.add("enter", function() {
        $( "#userForm" ).submit();
    });
	shortcut.add("ctrl+enter", function() {
       $( "#complete" ).click();
    });   
      */
</script>		 
  
</body>
</html>