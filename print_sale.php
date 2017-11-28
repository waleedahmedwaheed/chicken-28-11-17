<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 
 $sl_datetime		= date('Y-m-d h:i:s');
 
$sales_id = $_GET["sales_id"];
				
				
						$selectsSQL = "select * from sales where sales_id = '".$_GET["sales_id"]."'";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Results = mysql_query($selectsSQL, $dbconfig) or die(mysql_error());	 
						$rows = mysql_fetch_assoc($Results);
							
							$shop_id		= $rows["shop_id"];				
							$cash_tendered	= $rows["cash_tendered"];				
							$discount		= $rows["discount"];				
							$amount_due		= $rows["amount_due"];				
							$total			= $rows["total"];				
							$changed		= $rows["changed"];				
							$roundoff		= $rows["roundoff"];				
							$sales_no		= $rows["sales_no"];				
				 
 
				
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        

        <title>IC - Admin Dashboard </title>
		
		<style>
@media print{    
  font-size:xx-small
}
</style>

<style>
table {
    font-family: arial, sans-serif;
	font-size: 10px;
    border-collapse: collapse;
    width: 45%;
	margin-left:auto; 
    margin-right:auto;
}

td {
    text-align: left;
    padding: 4px;
}

th {
    text-align: center;
    padding: 0px;
}

tr:nth-child(even) {
    background-color: #dddddd;
	line-height: 14px;
}
h3{
	font-size: 14px;
}
h4{
	font-size: 11px;
}

</style>
	
	<script type="text/javascript" src="../js/jquery.min.js"></script>

	 <script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


		<link rel="shortcut icon" href="assets/images/favicon-16x16.png">
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
    </head>


    <body>
    
					
			
                       <table width="45%" style="margin-left:auto;margin-right:auto;">
<tr><td>
<button style="float:right; display:none;"  onclick="printDiv('printableArea')"><img src="image/print.png" title="Print" width='25'></button>	
</td></tr>
</table>

				
<div id="printableArea">
<table width="45%" style="margin-left:auto;margin-right:auto;">
<thead>
	<tr>
	<th align="center"> <h3 style="font-size: 6px;text-align: center;">  </h3> </th>
	</tr>
	<tr>
	<th align="center" colspan="5"> <h4 style="font-size: 14px;text-align: center;"> Islamabad Chicken  </h4>
	<span style="float:left;padding-bottom:2px;padding-right: 2px;"> <b> Sales #: <?php echo $sales_no; ?></span>
	<span style="float:right;padding-bottom:2px;padding-right: 2px;"> <b> </b> <?php echo date("jS F, Y h:i:s A", strtotime("$sl_datetime")); ?></span>
											</th>
	</tr>
	
	
	<tr>
	<th align="center"> 
	<span style="float:left;padding-bottom:2px;padding-right: 2px;"> <b> Customer : </b> Retail </span>
											</th>
	<th align="center"> 
	<span style="float:right;padding-bottom:2px;padding-right: 2px;"> <b> Shop : </b><?php echo get_title(shop_name,$shop_id,$dbconfig); ?></span>
											</th>										
	</tr>
	
	 

	</thead>
</table>

<table cellpadding="3" id="printTable" width="45%" style="margin-left:auto;margin-right:auto;">
	
	<tbody>
	<tr style="border: 2px solid black;">
		<td nowrap><b>Product</b></td>
		<td style="text-align:center;"><b>Qty</b></td>		
		<td style="text-align:center;"><b>Weight (kg)</b></td>		
		<td style="text-align:center;"><b>Price (kg)</b></td>
		<td style="text-align:right;"><b>Amount</b></td>
	</tr>
	
	 <?php
			$selectsSQL = "select * from sales_detail where sales_id = '$sales_id' and sd_status <> 1 ORDER BY sd_id DESC";
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
						$live	= get_mandirate(sale_rate,$shop_id,$sdate_,$dbconfig);
					}
					else
					{
						$price__ = get_price(sale_price,$prod_id_,$shop_id,$sdate_,$dbconfig);
					}
					
					 
								?>
	
	<tr>
		<td ><?php if($prod_id_=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); }; ?></td>
		<td style="text-align:center;"><?php echo $qty_; ?></td>		
		<td style="text-align:center;"><?php echo $weight_; ?></td>		
		<td style="text-align:center;"><?php if($prod_id_=="9999"){ echo number_format($live,2); } else { echo number_format($price__,2) ; } ?></td>
		<td style="text-align:right;"><?php if($prod_id_=="9999"){ echo number_format($live*$weight_,2); } else { echo number_format($price__*$weight_,2); }; ?></td>
	</tr>
	
				<?php  
		$qty = $qty + $quantity;		
		$tot_price = $tot_price + $price;		
		} ?>
	<tr>
		<td style="border-top: 2px solid black;"><b>Total</b></td>		
	  <td style="text-align:right;border-top: 2px solid black;" colspan="4"><b><?php echo number_format($total,2); ?></b></td>		
	</tr>
	 
	<tr>
		<td colspan="4"><b>Discount:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($discount,2); ?></b></td>		
	</tr>
	
	<tr>
		<td colspan="4"><b>Cash Tendered:</b></td>		
		<td style="text-align:right;"><b><?php echo number_format($cash_tendered,2); ?></b></td>		
	</tr>
	 
	<tr>
		<td colspan="4" style="border-top: 2px solid black;"><b>Net Total Rs:</b></td>		
		<td style="text-align:right;border-top: 2px solid black;"><b><?php echo number_format($amount_due,2); ?></b></td>		
	</tr>
	
	
	
	<tr>
		<td colspan="5" style="text-align:center;"><p>Hope to see you Soon <br> Thank You for your purchasing </p></td>		
	</tr>
	
	 
	
	<tr>
	<td nowrap colspan="5" style="text-align:center;"><b> Contact : <?php echo get_title(shop_contact,$shop_id,$dbconfig); ?> </b></td>		
	</tr>
	
	
</tbody>
</table>
</div>
	
</body>
</html>