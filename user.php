<?php include("db/dbcon.php"); 
 include("functions.php"); 
error_reporting(0);
session_start();

	if(isset($_GET["user_id"]))
	{
	
		$getSQL = "select * from user where user_id = '".$_GET["user_id"]."'";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultg = mysql_query($getSQL, $dbconfig) or die(mysql_error());	 
		$rowg = mysql_fetch_assoc($Resultg);
		$name		 = $rowg["name"];
		$username	 = $rowg["username"];
		$password	 = "Enter to Change Password";
		$shop_id	 = $rowg["shop_id"];
		$status		 = $rowg["status"];
	
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IC - POS</title>

<?php include("style.php"); ?>

<script src="js/jquery.min.js"></script>
<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "add_user.php", // Url to which the request is send
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
										<li class="active-page"> Users </li>
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
								<h4>Add User</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>User Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										<div class="form-group">
											<label class="col-md-2 control-label">Username *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Enter Username" maxlength="50" required <?php if(isset($_GET["user_id"])){ ?> readonly <?php } ?>>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Password *</label>
											<div class=" col-md-8">
												<input type="password" class="form-control" name="password" value="<?php //echo $password; ?>" placeholder="Enter Password" maxlength="50" <?php if(!isset($_GET["user_id"])){ ?> required <?php } ?>>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Full Name *</label>
											<div class=" col-md-8">
												<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter Name" maxlength="50" required>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Shop *</label>
											<div class=" col-md-8">
												<select class="form-control" name="shop_id" required>
													<option value="">--Select--</option>
													<?php
													$selectSQL = "select * from shop ORDER BY shop_id ASC";
													mysql_select_db($database_dbconfig, $dbconfig);
													$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
													while($row1 = mysql_fetch_assoc($Result1))
													{
													?>
		<option value="<?php echo $row1["shop_id"]; ?>" <?php if($row1["shop_id"]==$shop_id){ echo "selected"; } ?>><?php echo $row1["shop_name"]; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<?php if(isset($_GET["user_id"]))
										{ ?>
                                            <div class="form-group">
											<label class="col-md-2 control-label">Status *</label>
											<div class=" col-md-8">
												<select class="form-control" name="status" required>
													<option value="">--Select--</option>
													
													<option value="0" <?php if($status==0){ echo "selected"; } ?>>Active</option>
													<option value="1" <?php if($status==1){ echo "selected"; } ?>>Inactive</option>
													
												</select>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										<?php } ?>
										
										<?php if(isset($_GET["user_id"]))
										{ ?>
                                            <input type="hidden" name="opt" value="update">
                                            <input type="hidden" name="user_id" value="<?php echo $_GET["user_id"]; ?>">
										<?php } else { ?>
                                             <input type="hidden" name="opt" value="add">
										<?php } ?>	
										
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													
													<?php if(isset($_GET["user_id"]))
													{ ?>
													<input type="submit" class="btn btn-primary" value="Update changes" />
													<a href="shop.php" class="btn btn-default">  New  </a>
													<?php } else { ?>
													<input type="submit" class="btn btn-primary" value="Save changes" />
													<a href="shop.php" class="btn btn-default">  New  </a>
													<?php } ?>
													
												</div>
											</div>
										</div>
									</form>
											<span id="response"> </span>	
								</div>
							</div>
						</div>
						
						
						
					</div>
					
					</div>
					
					
					<div class="row">
					<div class="col-md-12">
						
						<div class="section-header">
							<h2>Users</h2>
						</div>
						<div class="box-widget widget-module">
							<div class="widget-head clearfix">
								<span class="h-icon"><i class="fa fa-th"></i></span>
								<h4>Shop Users</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<table class="table dt-table">
									<thead>
									<tr>
										<th>
											Full Name
										</th>
										<th>
											Shop
										</th>
										<th>
											Username
										</th>
										<th>
											Password
										</th>
										<th>
											Status
										</th>
										<th>
											Action
										</th>
										<th>
											User Rights
										</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<th>
											Full Name
										</th>
										<th>
											Shop
										</th>
										<th>
											Username
										</th>
										<th>
											Password
										</th>
										<th>
											Status
										</th>
										<th>
											Action
										</th>
										<th>
											User Rights
										</th>
									</tr>
									</tfoot>
									<tbody>
									<?php	
							$selectSQL = "select * from user where shop_id<>0 and username <> 'admin' ORDER BY user_id desc";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$id=$row1['user_id'];
								$status_ = $row1['status'];			
									?>
									<tr>
										<td>
											<?php echo $row1['name']; ?>
										</td>
										<td>
											<?php echo get_title(shop_name,$row1['shop_id'],$dbconfig); ?>
										</td>
										<td>
											<?php echo $row1['username']; ?>
										</td>
										<td>
											<?php echo "****"; ?>
										</td>
										<td>
											<?php switch($status_)
											{
												case 0:
												echo "<span style='color:green;'>Active</span>";
												break;
												case 1:
												echo "<span style='color:red;'>Inactive</span>";
												break;
											}
											?>
										</td>
										<td>
	<a href="user.php?user_id=<?php echo $id;?>" class="btn btn-success btn-xs" data-toggle = "modal" ><i class = "fa fa-pencil"></i> Edit</a>		
										</td>
										<td>
	<a href="user_rights.php?user_id=<?php echo $id; ?>" title="Assign Rights to <?php echo get_title(name,$id,$dbconfig); ?>" target="_blank"><image src="images/user_right.png" border="0" style="height: 25px;width: 40px;" /></a>		
										</td>
									</tr>
										<?php } ?>
									
									
								
									</tbody>
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