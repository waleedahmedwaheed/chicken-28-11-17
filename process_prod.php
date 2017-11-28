<?php include("db/dbcon.php"); 
 include("functions.php"); 
error_reporting(0);

//$prod_id		 	= $_POST['prod_id'];

?>

<table class="table dt-table" >
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
										 <th>
											Action
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
										 <th>
											Action
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from ppr_products where pprp_status = 0 and ppr_id = '".$_GET["ppr_id"]."' ORDER BY pprp_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id				= $row1['pprp_id'];
								$s_qty_		  	= $row1['s_qty'];
								$s_weight_  	= $row1['s_weight'];
								$ppr_id_		= $row1['ppr_id'];
								$prod_id_		= $row1['prod_id'];
											
									?>
									<tr>
										<td>
											<?php echo $a = $a + 1; ?>
										</td>
										 <td>
											<?php echo get_title(prod_name,$prod_id_,$dbconfig); ?>
										</td>
										<td>
											<?php echo $s_qty_; ?>
										</td>
										<td>
											<?php echo $s_weight_; ?>
										</td>
										 
										<td>
								<?php if($pp_status_==0){ ?>		
	  
	<a href="#" class="delete_class<?php echo $id; ?> btn btn-danger btn-xs" id="confirm<?php echo $id; ?>" value="<?php echo $id; ?>"  title="Delete" ><i class = "fa fa-trash-o"></i> Delete</a>
								
								
								<script>
									 
				$(document).delegate('.delete_class<?php echo $id; ?>', 'click', function(){
					
 				var tr = $(this).closest('tr'),
                del_id = $(this).attr('value');							
  
										 Lobibox.confirm({
                    msg: "Are you sure you want to delete this record?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
                           
						               $.ajax({
                url: "delete.php?id=11&pprp_id="+ del_id,
                cache: false,
                success:function(result){
					//$("#response").html(result);
                    tr.fadeOut(1000, function(){
                        $(this).remove();
						
						window.location="process_products.php?ppr_id=<?php echo $ppr_id_; ?>";
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
								}
								else
								{
									echo "";
								}									
								?>
										</td>
									 
										
									</tr>
							
							 
							
							
										<?php } ?>
								
									</tbody>
									</table>
								