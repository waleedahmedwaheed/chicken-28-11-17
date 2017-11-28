<?php /* include("db/dbcon.php"); 
 include("functions.php"); 
session_start();
 error_reporting(0); */

 $shop_ho = $_SESSION['shop_head'];
 
  if(isset($_SESSION['s_id']) && !empty($_SESSION['s_id'])) 
 {
	//echo  $_SESSION['s_id'];
	 //echo "<script>window.location='login.php'</script>"; 
 }
 else
 {
	 
	 echo "<script>window.location='login.php'</script>"; 
 }
 

$username = get_title(username,$_SESSION["id"],$dbconfig); 

if($username=='admin')
{
?>
<!--Leftbar Start Here -->
<div class="left-aside desktop-view">
    <div class="aside-branding" style="text-align: center; background-color: #fff365;">
		<div>
	   <p style="padding-top: 5px;"><b>IC<br>Point of Sale</b></p>
	    </div>
    </div>
    <div class="left-navigation" style="background-color: rgba(255, 0, 0, 0.89);">
        <ul class="list-accordion">
            <li><a href="index.php" class="waves-effect"><span class="nav-icon"><i class="fa fa-home"></i></span><span>Dashboard</span> </a></li>
            <?php if($shop_ho==1){ ?>
			
            <li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-lab"></i></span><span>Products</span> </a>
				<ul>
                    <li><a href="product.php">Products</a></li>
                    <li><a href="product_cat.php">Product Category</a></li>
				 </ul>	
			</li>
			
			<li><a href="purchase.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document"></i></span><span>Purchase</span> </a></li>
			<li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Rates</span> </a>
				<ul>
                    <li><a href="rates.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>Products Rate</span></a></li>
                    <li><a href="daily_rates.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>Live Chicken Rate</span></a></li>
				 </ul>
			</li>
			<li><a href="production.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Production</span> </a></li>
			<?php } ?>
			
            
            
            <?php if($shop_ho==1){ ?>
			 <li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Chiller Transfer</span> </a>
			<ul>
			<li><a href="prod_processed.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>Chiller Processed (Transfer)</span> </a></li>
            <li><a href="prod_dispatch.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Chiller Dispatch (Return & Loss)</span> </a></li>
			 </ul>
			 </li>
			<?php } ?>
			<?php if($shop_ho==0){ ?>
			<li><a href="prod_rcv.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Chiller Received</span> </a></li>
			<li><a href="live_rcv.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Live Received</span> </a></li>
            <?php } ?>
			<?php if($shop_ho==1){ ?>
			
            <li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span>Live Transfer</span> </a>
				<ul>
                    <li><a href="live_transfer.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>Transfer</span></a></li>
					<li><a href="live_mng.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>Manage (Return & Loss)</span></a></li>
				 </ul>	
			</li>	 
			
			
			<?php } ?>
			
			<?php if($shop_ho==0){ ?>
            <li><a href="sales.php?it_id=1" class="waves-effect"><span class="nav-icon"><i class="fa fa-shopping-cart"></i></span><span>Sale</span> </a></li>
			<ul class="hide">
			<?php
							$selectSQL = "select * from item_type where it_status = 0 ORDER BY it_id ASC";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
					 <li><a href="sales.php?it_id=<?php echo $row1["it_id"]; ?>"> <?php echo $row1["it_desc"]; ?></a></li>								
		 
													<?php } ?>
			</ul>
			
			<?php } ?>
           
            <li><a href="loss.php" class="waves-effect"><span class="nav-icon"><i class="ico-shop"></i></span><span>Loss</span> </a></li>
            <li><a href="stock.php" class="waves-effect"><span class="nav-icon"><i class="fa fa-shopping-cart"></i></span><span>Stock</span> </a></li>
           
			<?php if($shop_ho==1){ ?>
		   <li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-users2"></i></span><span>Customers</span> </a>
				<ul>
                    <li><a href="cust.php" class="waves-effect"><span class="nav-icon"><i class="ico-users2"></i></span>Customers Management</span></a></li>
                    <li><a href="cust_factor.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>Customer Factor</span></a></li>
					<li><a href="cust_order.php" class="waves-effect"><span class="nav-icon"><i class="fa fa-shopping-cart"></i></span><span>Customers Order</span> </a></li>	
					<li><a href="cust_payment.php" class="waves-effect"><span class="nav-icon"><i class="fa fa-shopping-cart"></i></span><span>Customers Payment</span> </a></li>	
				</ul>	
			</li>
			
			<?php } ?>
			
			<li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-users2"></i></span><span>Income/Expense</span> </a>
				<ul>
					<?php if($shop_ho==1){ ?>
                    <li><a href="ie_cat.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>I/E Category</span></a></li>
					 <li><a href="ie_cat_detail.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>I/E Detail</span></a></li>
					<?php }
					if($shop_ho==0){ ?>
                    <li><a href="ie_cat_detail.php" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span>I/E Detail</span></a></li>
					<?php } ?>
				 </ul>	
			</li>
			
			<?php if($shop_ho==1){ ?>
            <li><a href="user.php" class="waves-effect"><span class="nav-icon"><i class="fa fa-users"></i></span><span>Users</span> </a></li>
			<li><a href="prod_barcode.php" class="waves-effect"><span class="nav-icon"><i class="ico-hammer-wrench"></i></span><span>Barcode Generation</span> </a></li>
			<li><a href="shop.php" class="waves-effect"><span class="nav-icon"><i class="ico-shop"></i></span><span>Shops</span> </a></li>
			<li><a href="farm.php" class="waves-effect"><span class="nav-icon"><i class="ico-shop"></i></span><span>Farms</span> </a></li>
			<li class="hide"><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-hammer-wrench"></i></span><span>Maintenance</span> </a></li>	
				<ul>
                    <li><a href="#">Sales</a></li>
                    <li><a href="#">Purchase</a></li>
				 </ul>	
			</li>
			 <li class="hide"><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-shop"></i></span><span>Other Income</span> </a></li>
			
			<?php } ?>
            
             
        </ul>
    </div>
</div>
<?php } else { ?>	

<!--Leftbar Start Here -->
<div class="left-aside desktop-view">
    <div class="aside-branding" style="text-align: center; background-color: #fff365;">
		<div>
	   <p style="padding-top: 5px;"><b>IC<br>Point of Sale</b></p>
	    </div>
    </div>
    <div class="left-navigation" style="background-color: rgba(255, 0, 0, 0.89);">
        <ul class="list-accordion">
            <li><a href="index.php" class="waves-effect"><span class="nav-icon"><i class="fa fa-home"></i></span><span>Dashboard</span> </a></li>
            
			<?php 
	
	////////////////////////MAIN MENU//////////////////////////////////
	
		
		$get_menu ="select distinct(c.main_menu_id),c.main_menu_title,c.sub_menu_allow,c.main_page_name from main_menu c, menu_allow d where c.main_menu_id=d.main_menu_id and d.user_id='".$_SESSION['id']."' order by c.main_menu_id asc"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($get_menu, $dbconfig) or die(mysql_error());	 
		while($pro_get_menu = mysql_fetch_assoc($Resultgs))
		{
	
		$main_menu_id		= $pro_get_menu["main_menu_id"];
		$main_menu_title	= $pro_get_menu["main_menu_title"];
		$sub_menu_allow		= $pro_get_menu["sub_menu_allow"];
		$main_page_name		= $pro_get_menu["main_page_name"];
	
		
		?>
             <?php if($sub_menu_allow==0){ ?>
		 <li><a href="<?php echo $main_page_name; ?>" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span><?php echo $main_menu_title; ?></span> </a></li>	  
			  <?php } else { 
		?>
		<li><a href="#" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><span><?php echo $main_menu_title; ?></span> </a>
		<ul>
		<?php
	  	////////////////////////SUB MENU//////////////////////////////////
		
		  $get_sub_menu ="select * from sub_menu c where c.main_menu_id='$main_menu_id'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgsu = mysql_query($get_sub_menu, $dbconfig) or die(mysql_error());	 
		while($pro_get_sub_menu = mysql_fetch_assoc($Resultgsu))
		{
			$SUB_MENU_ID				= $pro_get_sub_menu["sub_menu_id"];
			$SUB_MENU_PAGE_TITLE		= $pro_get_sub_menu["sub_menu_page_title"];
			$SUB_MENU_PAGE_NAME			= $pro_get_sub_menu["sub_menu_page_name"];
			
			$get_subs_menu ="select * from sub_menu_allow c where c.sub_menu_id='$SUB_MENU_ID'"; 
			mysql_select_db($database_dbconfig, $dbconfig);
			$Resultgsub = mysql_query($get_subs_menu, $dbconfig) or die(mysql_error());
			$pro_get_sub_menus = mysql_fetch_assoc($Resultgsub);
			if($pro_get_sub_menus>0)
			{
	  ?>
	  
		 
		
		<li><a href="<?php echo $SUB_MENU_PAGE_NAME; ?>" class="waves-effect"><span class="nav-icon"><i class="ico-text-document-inverted"></i></span><?php echo $SUB_MENU_PAGE_TITLE; ?></span> </a></li>
		 
		
			 
		<?php }
		else
		{
		}
		}
		?>
		 </ul>	
		 </li>
		 
		<?php }
		} ?> 	
			
             
        </ul>
    </div>
</div>

<?php } ?>