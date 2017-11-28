<?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 
 $sl_datetime		= date('Y-m-d h:i:s');
 
$bar_id = $_GET["bar_id"];
				
				
						$selectsSQL = "select * from barcode where bar_id = '".$_GET["bar_id"]."'";
						mysql_select_db($database_dbconfig, $dbconfig);
						$Results = mysql_query($selectsSQL, $dbconfig) or die(mysql_error());	 
						$rows = mysql_fetch_assoc($Results);
							
							$prod_id		= $rows["prod_id"];				
							$qty			= $rows["qty"];				
							$wgt			= $rows["wgt"];				
							 	
				 
 
				
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        

        <title>IC - POS   </title>
		
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
 
 <table class="table">					
									<tr> 
									<td nowrap colspan="4"><center>
									<?php if($prod_id=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id,$dbconfig); } ?>
									 : Qty = <?php echo $qty; ?> : Weight <?php echo $wgt; ?>
									</center></td>
									</tr>
									<?php for($i=1;$i<=7;$i++){ ?>
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
										 
										 
									</tr>
									<?php } ?>
									</table>
 
</div>
 
</body>
</html>