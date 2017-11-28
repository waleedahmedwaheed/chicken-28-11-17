<?php
include("db/dbcon.php"); 
include("functions.php"); 
error_reporting(0);

$cat = $_REQUEST["cat"];
$pro_id = $_REQUEST["pro_id"];
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
	<input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>" />
	 
	 
	<tr>
		<td>
			<?php echo $a = $a + 1; ?>
		</td>
		<td>
			<?php echo $prod_name; ?>
		</td>
		<td>
			<input type="text" name="p_qty" id="p_qty<?php echo $prod_id; ?>" onchange="change_values<?php echo $prod_id; ?>();" value="<?php echo $p_qty; ?>" <?php if($p_qty<>""){ ?> style="background-color:#337ab7; color:white;width: 50%;" <?php } else { ?> style="width: 50%;" <?php } ?> class="decimal form-control" placeholder="0.00"  /> 
		</td>
		<td>
			<input type="text" name="p_weight" id="p_weight<?php echo $prod_id; ?>" onchange="change_values<?php echo $prod_id; ?>();" value="<?php echo $p_weight; ?>" <?php if($p_weight<>""){ ?> style="background-color:#337ab7; color:white;width: 50%;" <?php } else { ?> style="width: 50%;" <?php } ?> class="decimal form-control" placeholder="0.00"  /> 
		</td>
		 
		<td id="response<?php echo $prod_id; ?>" nowrap>
		 
		</td>
	</tr>
	</form>
	
	
	<script>							
	function change_values<?php echo $prod_id; ?>()
	{	
		var prod_id<?php echo $prod_id; ?>  	= <?php echo $prod_id; ?>;
		var pro_id<?php echo $prod_id; ?>  		= <?php echo $pro_id; ?>;
		var p_qty<?php echo $prod_id; ?> 		= document.getElementById("p_qty<?php echo $prod_id; ?>").value;
		var p_weight<?php echo $prod_id; ?> 	= document.getElementById("p_weight<?php echo $prod_id; ?>").value;
		
		//alert(p_qty<?php echo $prod_id; ?>);
		//alert(p_weight<?php echo $prod_id; ?>);
		
		if ((p_qty<?php echo $prod_id; ?> != "") && (p_weight<?php echo $prod_id; ?> != ""))
		{
			console.log("ok");
			document.getElementById("p_qty<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			document.getElementById("p_qty<?php echo $prod_id; ?>").style.color = "white";
			document.getElementById("p_weight<?php echo $prod_id; ?>").style.backgroundColor = "#337ab7";
			document.getElementById("p_weight<?php echo $prod_id; ?>").style.color = "white";
			
			//$('#userForm<?php echo $prod_id; ?>').submit();
			
			  $.ajax({
				  type: "POST",
				  url: "add_pro_products.php",
				  data: "prod_id="+prod_id<?php echo $prod_id; ?>+"&pro_id="+pro_id<?php echo $prod_id; ?>+"&p_qty="+p_qty<?php echo $prod_id; ?>+"&p_weight="+p_weight<?php echo $prod_id; ?>,
				  //data: $("#userForm<?php echo $prod_id; ?>").serialize(),
				  success: function(data) {
					$("#response<?php echo $prod_id; ?>").html(data);
					//alert(pro_id<?php echo $prod_id; ?>);
					$("#dttable").load("pro_prod.php?pro_id="+pro_id<?php echo $prod_id; ?>);
				  }
				});
			
			   
		}
		else
		{
			console.log("not ok");
			document.getElementById("p_qty<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			document.getElementById("p_qty<?php echo $prod_id; ?>").style.color = "#555555";
			document.getElementById("p_weight<?php echo $prod_id; ?>").style.backgroundColor = "#ffffff";
			document.getElementById("p_weight<?php echo $prod_id; ?>").style.color = "#555555";
		}
		
		/*if ((p_qty<?php echo $prod_id; ?> !== null) && (p_weight<?php echo $prod_id; ?> !== null)
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