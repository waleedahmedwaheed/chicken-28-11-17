<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);

  $shop_ho = get_title(shop_ho,$_SESSION["s_id"],$dbconfig);
  
 	
	$date_from = $_REQUEST["start"];
	$date_to   = $_REQUEST["end"];
	$shop_id   = $_REQUEST["shop_id"];
	
	
	if(!empty($shop_id))
{
		$where1[] = "shop_id='$shop_id'";
}
		
if(!empty($date_from) || !empty($date_to)){
		
$where1[]= "date_added between '$date_from 00:00:00' and '$date_to 23:59:59'"; 		

}
 
	
 
	 
	
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        

        <title>IC - POS   </title>
		
		<style>
@media print{    
  font-size:xx-small;
  #print {
    display: none;
  }
}
</style>

<style>
table {
    font-family: arial, sans-serif;
	font-size: 10px;
    border-collapse: collapse;
    width: 100%;
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
 
h3{
	font-size: 14px;
}
h4{
	font-size: 11px;
}

</style>
	
	<script type="text/javascript" src="js/jquery.min.js"></script>

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

      <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        
    </head>


<body>

 <table width="45%" style="margin-left:auto;margin-right:auto;">
<tr><td>
<button style="float:right;"><a href="index.php">BACK</a></button>	
<button style="float:right;"  onclick="printDiv('printableArea')" ><img src="image/print.png" title="Print" width='25'></button>	
</td></tr>
</table>

<div id="printableArea">
<table cellpadding="3"  style="margin-left:auto;margin-right:auto;" border="1" class="table">
									 
									<tr>
										<th colspan="6" style="text-align: center;font-size: 12px;">
											Sales of Shop <?php echo get_title(shop_name,$_SESSION["id"],$dbconfig); ?>
											from <?php echo $date_from; ?> to <?php echo $date_to; ?>
										</th>
										 
										 
									</tr>
									
									<tr>
										<th>
											#
										</th>
										<th>
											Sales No
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
										 
									</tr>
								 
									 
									
									 
									 
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
											<?php echo number_format($total_,2); ?>
										</td>
										<td>
											<?php echo number_format($discount_,2); ?>
										</td>
										<td>
											<?php echo number_format($amount_due_,2); ?>
										</td>
										  
										 
									</tr>
							
						
							
							
										<?php } ?>
								
									<tr>
										<th colspan="4">
											Total
										</th>										 
										<th>
											<?php echo number_format($total,2); ?>
										</th>
										 
									</tr>
					  
					 
									 
									</table>
									</div>
								
								
</body>
</html>
