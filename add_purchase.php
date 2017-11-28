<?php 
include 'db/dbcon.php';
error_reporting(0);
	
	$shop_id		 	= $_POST['shop_id'];
	
	$pur_date 			= $_POST['pur_date'];		
	
	$pur_from		 	= $_POST['pur_from'];
	$party_name		 	= $_POST['party_name'];
	$party_rate			= $_POST['party_rate'];
	$mandi_rate 		= $_POST['mandi_rate'];
	$prod_id	 		= $_POST['prod_id'];
	
	$pur_id			 	= $_POST['pur_id'];
	$qty			 	= $_POST['qty'];
	$weight			 	= $_POST['weight'];
	$driver			 	= $_POST['driver'];
	$vehicle		 	= $_POST['vehicle'];
	$location		 	= $_POST['location'];
	$weight_loss	 	= $_POST['weight_loss']; if($weight_loss==""){	$weight_loss = 0; }
	$qty_loss		 	= $_POST['qty_loss']; if($qty_loss==""){	$qty_loss = 0; }
	$bird_wgt_loss	 	= $_POST['bird_wgt_loss']; if($bird_wgt_loss==""){	$bird_wgt_loss = 0; }
	//$pur_date		 	= $_POST['pur_date'];
	$opt 				= $_POST['opt'];
	
	

if($opt=="update")
{
	$insertSQL = "Update purchase set pur_from = '$pur_from', party_name = '$party_name',party_rate = '$party_rate',mandi_rate = '$mandi_rate',shop_id='$shop_id',
	pur_date='$pur_date',qty='$qty',weight='$weight', driver = '$driver', vehicle = '$vehicle', location = '$location', weight_loss = '$weight_loss',
	qty_loss = '$qty_loss', bird_wgt_loss = '$bird_wgt_loss',prod_id = '$prod_id'	
	where pur_id = '$pur_id' and p_status = 0";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());
	
	echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
	echo "<script>window.location='purchase.php'</script>";
		
	//echo "<script type='text/javascript'> window.location='view_hall.php' </script>";
}
else
{	

	/*$getSQL = "select * from purchase where pur_date = '".$pur_date."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		if($rowg>0)
		{
			echo "<script type='text/javascript'>alert('Purchase of this date already added!');</script>";
		echo "<script>window.location='purchase.php'</script>";
		}
		else
		{*/
	 $insertSQL = "INSERT INTO purchase
	 (pur_from,party_name,party_rate,mandi_rate,pur_date,shop_id,qty,weight,driver,vehicle,location,weight_loss,qty_loss,bird_wgt_loss,prod_id) 
			VALUES('$pur_from','$party_name','$party_rate','$mandi_rate','$pur_date','$shop_id','$qty','$weight','$driver','$vehicle','$location','$weight_loss','$qty_loss','$bird_wgt_loss','$prod_id')";
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
		
		echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
		echo "<script>window.location='purchase.php'</script>";   
		//}
}		
?>