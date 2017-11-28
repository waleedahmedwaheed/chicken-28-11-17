<?php
include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 
 $sales_no = $_GET["sales_no"];
 ?>

<table class="table">
									<thead>
									<tr>
										<th>
											#
										</th>
										<th>
											Product Name
										</th>
										<th>
											Price
										</th>
										<th>
											Quantity
										</th>
										<th>
											Weight
										</th>
										<th>
											Total
										</th>
										<th>
											Action
										</th>
									</tr>
									</thead>
									
									<tbody>
							<?php
							$selectsSQL = "select * from sales_detail where sales_no = '$sales_no' and sd_status = 0 ORDER BY sd_id DESC";
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
									$live 		= get_mandirate(sale_rate,$_SESSION["s_id"],$sdate_,$dbconfig);
									}
									else
									{
										$price__ = get_price(sale_price,$prod_id_,$_SESSION["s_id"],$sdate_,$dbconfig);
									}
									
									
									switch($item_type_)
									{
										case 1:
										$mode = "sale_price";
										break;
										case 2:
										$mode = "ws_price";
										break;
										case 3:
										$mode = "sup_price";
										break;
									}
									//echo $mode;
								?>		
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999") { echo "Live Chicken"; } else { echo get_title(prod_name,$prod_id_,$dbconfig); }; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999"){ echo $live; } else { echo $price__ ; } ?>
										</td>
										<td>
											<?php echo $qty_; ?>
										</td>
										<td>
											<?php echo $weight_; ?>
										</td>
										<td>
											<?php if($prod_id_=="9999"){ echo $live * $weight_; } else { echo $price__ * $weight_; } ?>
										</td>
										<td>
			<a href="sales.php?it_id=<?php echo $item_type_; ?>&sd_id=<?php echo $id; ?>" ><i class="fa fa-edit"></i></a>
				&nbsp;
	<a href="#" class="delete_class<?php echo $id; ?>" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Delete" ><i class = "fa fa-trash"></i></a>			
 

										</td>
									</tr>
				<script>
									 
				$(document).delegate('.delete_class<?php echo $id; ?>', 'click', function(){
				
				var it_id = <?php echo $item_type_; ?>;
				//alert(it_id);
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=8&sd_id="+ del_id,
                cache: false,
                success:function(result){
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						window.location="sales.php?it_id="+it_id;
                    });
                }
            });
			
                        } else if (type === 'no') {
                            /* Lobibox.notify('info', {
                                msg: 'You have clicked "No" button.'
                            }); */
                        }
                    }
                });
 		});
		
									</script>
									
								<?php 
								$price_ = 0;
								$weight_ = 0;
								$live = 0;
								$qty_ = 0;
								} ?>		
									
									</tbody>
									
									</table>
									