<?php include("db/dbcon.php"); 
 include("functions.php"); 
error_reporting(0);
session_start();

$user_id = $_GET["user_id"];

 
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IC - POS</title>

<?php include("style.php"); ?>


<link rel="stylesheet" type="text/css" href="css/simpletree.css" />

<script type="text/javascript" src="js/simpletreemenu.js"></script>
<script language="javascript">
<!--

function expandAll(){
	ddtreemenu.flatten('treemenu2', 'expand');
	}
//-->
</script>


<script src="js/jquery.min.js"></script>
<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "user_rights_save.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#loader").hide();
//$('#userForm')[0].reset();
$("#response").html(data);
}
});

}));
});


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
				<div class="page-breadcrumb">
					<div class="row">
						<div class="col-md-7">
							<div class="page-breadcrumb-wrap">

								<div class="page-breadcrumb-info">
									<h2 class="breadcrumb-titles">Islamabad Chicken </small></h2>
									<ul class="list-page-breadcrumb">
										<li><a href="#">Home</a>
										</li>
										<li class="active-page"> User Rights </li>
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
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-bars"></i></span>
								<h4>User Rights of <?php echo get_title(name,$user_id,$dbconfig); ?></h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									 
									 
<table class="table table-striped table-bordered table-hover">
  <tr valign="top">
    <td bgcolor="#FFFFFF">
	 
      <ul class="treeview style18 style19" id="treemenu2">
   <span class="style18"><a href="javascript:ddtreemenu.flatten('treemenu2', 'expand')"> Expand All</a> | 
   <a href="javascript:ddtreemenu.flatten('treemenu2', 'contact')">Contract All</a>
      </span>
   <table class="table table-striped table-bordered table-hover">
   
   <form id="userForm" method="post" >
   <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"   />
	<?php 
	
	////////////////////////MAIN MENU//////////////////////////////////
	
		  $get_menu ="select * from MAIN_MENU order by MAIN_MENU_ID asc"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgs = mysql_query($get_menu, $dbconfig) or die(mysql_error());	 
		while($pro_get_menu = mysql_fetch_assoc($Resultgs))
		{
	
	$MAIN_MENU_ID		= $pro_get_menu["main_menu_id"];
	$MAIN_MENU_TITLE	= $pro_get_menu["main_menu_title"];
		
		$get_menu_ch ="select * from MAIN_MENU c, MENU_ALLOW d where c.MAIN_MENU_ID='$MAIN_MENU_ID' and c.MAIN_MENU_ID=d.MAIN_MENU_ID and USER_ID='".$user_id."'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultme = mysql_query($get_menu_ch, $dbconfig) or die(mysql_error());
		$rows_menu_ch=mysql_fetch_assoc($Resultme);
		if($rows_menu_ch>0)
		{
			$bool = 1;
		}
		else
		{
			$bool = 0;
		}
	?>
	 <li> 
	 <input type="checkbox" value="<?php echo $MAIN_MENU_ID ?>" name="main_menu_id[]" id="checkAll<?php echo $MAIN_MENU_ID; ?>" 
	<?php if($bool==1){ echo 'checked="checked"'; }  ?>	 />
	  <a id="toggle"><?php echo $MAIN_MENU_TITLE; ?></a>
	 <ul>
	
	
	 <?php
	  
	  	////////////////////////SUB MENU//////////////////////////////////
		
	    $get_sub_menu ="select * from sub_menu where main_menu_id='$MAIN_MENU_ID'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultgp = mysql_query($get_sub_menu, $dbconfig) or die(mysql_error());	 
		while($pro_get_sub_menu = mysql_fetch_assoc($Resultgp))
		{
			
			$SUB_MENU_ID				= $pro_get_sub_menu["sub_menu_id"];
			$SUB_MENU_PAGE_TITLE		= $pro_get_sub_menu["sub_menu_page_title"];
			$SUB_MENU_ALLOW				= $pro_get_sub_menu["sub_menu_allow"];
			$SUB_MENU_PAGE_NAME			= $pro_get_sub_menu["sub_menu_page_name"];
			
		$get_menu_sb ="select * from SUB_MENU_ALLOW c, MENU_ALLOW d where c.MAIN_MENU_ID='$MAIN_MENU_ID' and c.SUB_MENU_ID='$SUB_MENU_ID' and c.USER_ID='".$user_id."'"; 
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultmes = mysql_query($get_menu_sb, $dbconfig) or die(mysql_error());
		$rows_menu_sb=mysql_fetch_assoc($Resultmes);
		if($rows_menu_sb>0)
		{
			$bool_sb = 1;
		}
		else
		{
			$bool_sb = 0;
		} 
	  ?>
	  

	   <li><input type="checkbox" value="<?php echo $SUB_MENU_ID ?>" name="sub_menu_id[]" id="checkto<?php echo $SUB_MENU_ID; ?>" 
		<?php if($bool_sb==1){ echo 'checked="checked"'; }  ?>	   />
	   <font color="#000099"> <?php echo $SUB_MENU_PAGE_TITLE; ?></font> </li>
		 
		 
		  <script>
		   $("#checkAll<?php echo $MAIN_MENU_ID; ?>").change(function () {
	
	var test2 = $('input:checkbox[id=checkAll<?php echo $MAIN_MENU_ID; ?>]').is(':checked');
	
	if(test2 == true)
	{
		//alert("TRUE");
		$("#checkAll<?php echo $MAIN_MENU_ID; ?>" ).prop( "checked", true  );
		$("#checkto<?php echo $SUB_MENU_ID; ?>" ).prop( "checked", true  );
		
	}
	
	else 
	{
		//alert("FALSE");
		$("#checkAll<?php echo $MAIN_MENU_ID; ?>" ).prop( "checked", false ) ;
		$("#checkto<?php echo $SUB_MENU_ID; ?>" ).prop( "checked", false ) ;
		
	}
});
		 
</script>	
	

		   
	  
	 
		
				  <script>
		   $("#checkAll<?php echo $MAIN_MENU_ID; ?>").change(function () {
	
	var test2 = $('input:checkbox[id=checkAll<?php echo $MAIN_MENU_ID; ?>]').is(':checked');
	
	if(test2 == true)
	{
		//alert("TRUE");
		$("#checkAll<?php echo $MAIN_MENU_ID; ?>" ).prop( "checked", true  );
		$("#checkto<?php echo $SUB_MENU_ID; ?>" ).prop( "checked", true  );
		//$("#checksub<?php echo $S_SUB_MENU_ID; ?>" ).prop( "checked", true  );
	}
	
	else 
	{
		//alert("FALSE");
		$("#checkAll<?php echo $MAIN_MENU_ID; ?>" ).prop( "checked", false ) ;
		$("#checkto<?php echo $SUB_MENU_ID; ?>" ).prop( "checked", false ) ;
		//$("#checksub<?php echo $S_SUB_MENU_ID; ?>" ).prop( "checked", false ) ;
	}
});
		 
</script>	
		
		 <script>
		   $("#checkto<?php echo $SUB_MENU_ID; ?>").change(function () {
	
	var test3 = $('input:checkbox[id=checkto<?php echo $SUB_MENU_ID; ?>]').is(':checked');
	
	if(test3 == true)
	{
		//alert("TRUE2");
		$("#checkto<?php echo $SUB_MENU_ID; ?>" ).prop( "checked", true  );
		//$("#checksub<?php echo $S_SUB_MENU_ID; ?>" ).prop( "checked", true  );
	}
	
	else 
	{
		//alert("FALSE2");
		$("#checkto<?php echo $SUB_MENU_ID; ?>" ).prop( "checked", false ) ;
		//$("#checksub<?php echo $S_SUB_MENU_ID; ?>" ).prop( "checked", false ) ;
	}
});
		 
</script>
		
		

	<?php //} ?>			
	
		 
	  <?php } ?>	
	 </ul>
	  </li>
	 
		<?php } ?>	
		<tr>
		<td align="center"><input class="btn btn-success" type="submit" name="submit" value="Assign Rights"></td>
		</tr>
		
		
		</form>
    </table>
  
        </ul>      <span class="style20">
      <script type="text/javascript">
ddtreemenu.createTree("treemenu2", false)
      </script>
      </span><span class="style18" id="response">     </span></td>
  </tr>
</table>


									 
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




</body>
</html>