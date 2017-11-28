<?php
include("db/dbcon.php"); 
include("functions.php"); 
error_reporting(0);

$cat = $_REQUEST["cat"];
$ppr_id = $_REQUEST["ppr_id"];

		$getSQL = "select * from prod_processed where ppr_id = '".$ppr_id."' and ppr_status = 0";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		 
		$ppr_id		 	 = $rowg["ppr_id"];
		$shop_id	 	 = $rowg["shop_id"];
		$ppr_date	 	 = $rowg["ppr_date"];
		$ppr_status	 	 = $rowg["ppr_status"];
?>
     
	<table class="table dt-table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Product
										</th>
										  <th>
											Qty <small>(stock)</small> 
										</th>
										<th>
											Weight <small>(stock)</small>
										</th>
										<th>
											Qty  
										</th>
										<th>
											Weight
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
											Qty <small>(stock)</small> 
										</th>
										<th>
											Weight <small>(stock)</small>
										</th>
										<th>
											Qty  
										</th>
										<th>
											Weight
										</th>
									</tr>
									</tfoot>
									<tbody>
									
<?php
	$query="select * from product where pcat_id = '$cat' and prod_status = 0 ";
	mysql_select_db($database_dbconfig, $dbconfig);
	$result = mysql_query($query, $dbconfig) or die(mysql_error());
	while($row=mysql_fetch_assoc($result))

	{
		$prod_id = $row["prod_id"];
		$prod_name = $row["prod_name"];
	 
	?>
	 <form class="form-horizontal" method="post" id="userForm<?php echo $prod_id; ?>">	
	<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>" />
	<input type="hidden" name="ppr_id" value="<?php echo $ppr_id; ?>" />
	 
	 
	<tr>
		<td>
			<?php echo $a = $a + 1; ?>
		</td>
		<td>
			<?php echo $prod_name; ?>
		</td>
		<td>
			<?php echo $avl_qty = get_stock(qty,get_title(shop_head,1,$dbconfig),$prod_id,$dbconfig); ?>
		</td>
		<td>
			<?php echo $avl_weight  = get_stock(weight,get_title(shop_head,1,$dbconfig),$prod_id,$dbconfig); ?>
		</td>
		<td>
			<input type="text" name="s_qty" id="s_qty<?php echo $prod_id; ?>" onchange="change_values<?php echo $prod_id; ?>();" value="<?php echo $s_qty; ?>" <?php if($s_qty<>""){ ?> style="background-color:#337ab7; color:white;width: 50%;" <?php } else { ?> style="width: 50%;" <?php } ?> class="decimal form-control" placeholder="0.00"  /> 
		</td>
		<td>
			<input type="text" name="s_weight" id="s_weight<?php echo $prod_id; ?>" onchange="change_values<?php echo $prod_id; ?>();" value="<?php echo $s_weight; ?>" <?php if($s_weight<>""){ ?> style="background-color:#337ab7; color:white;width: 50%;" <?php } else { ?> style="width: 50%;" <?php } ?> class="decimal form-control" placeholder="0.00"  /> 
		</td>
		 
		<td id="response<?php echo $prod_id; ?>" nowrap>
		 
		</td>
	</tr>
	</form>
	
	
	<script>							
	function change_values<?php echo $prod_id; ?>()
	{	
		var prod_id<?php echo $prod_id; ?>  	= <?php echo $prod_id; ?>;
		var ppr_id<?php echo $prod_id; ?>  		= <?php echo $ppr_id; ?>;
		var s_qty<?php echo $prod_id; ?> 		= document.getElementById("s_qty<?php echo $prod_id; ?>").value;
		var s_weight<?php echo $prod_id; ?> 	= document.getElementById("s_weight<?php echo $prod_id; ?>").value;
		
		//alert(s_qty<?php echo $prod_id; ?>);
		//alert(s_weight<?php echo $prod_id; ?>);
		
		if ((s_qty<?php echo $prod_id; ?> != "") && (s_weight<?php echo $prod_id; ?> != ""))
		{
			console.log("ok");
			document.getElementById("s_qty<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			document.getElementById("s_qty<?php echo $prod_id; ?>").style.color = "white";
			document.getElementById("s_weight<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			document.getElementById("s_weight<?php echo $prod_id; ?>").style.color = "white";
			
			//$('#userForm<?php echo $prod_id; ?>').submit();
			
			  $.ajax({
				  type: "POST",
				  url: "add_process_products.php",
				  data: "prod_id="+prod_id<?php echo $prod_id; ?>+"&ppr_id="+ppr_id<?php echo $prod_id; ?>+"&s_qty="+s_qty<?php echo $prod_id; ?>+"&s_weight="+s_weight<?php echo $prod_id; ?>,
				  //data: $("#userForm<?php echo $prod_id; ?>").serialize(),
				  success: function(data) {
					$("#response<?php echo $prod_id; ?>").html(data);
					//alert(ppr_id<?php echo $prod_id; ?>);
					$("#dttable").load("process_prod.php?ppr_id="+ppr_id<?php echo $prod_id; ?>);
				  }
				});
			
			   
		}
		else
		{
			console.log("not ok");
			document.getElementById("s_qty<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			document.getElementById("s_qty<?php echo $prod_id; ?>").style.color = "#555555";
			document.getElementById("s_weight<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			document.getElementById("s_weight<?php echo $prod_id; ?>").style.color = "#555555";
		}
		
		/*if ((s_qty<?php echo $prod_id; ?> !== null) && (s_weight<?php echo $prod_id; ?> !== null)
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
	
<?php } ?>

  </tbody>
  </table>