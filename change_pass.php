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
url: "ch_pass_save.php", // Url to which the request is send
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

<script type="text/javascript">
window.onload = function () {
	document.getElementById("password1").onchange = validatePassword;
	document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password1").value;
if(pass1!=pass2)
	document.getElementById("password2").setCustomValidity("Passwords Don't Match");
else
	document.getElementById("password2").setCustomValidity('');	 
//empty string means no validation error
}
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
										<li class="active-page"> Change Password </li>
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
								<h4>Change Password</h4>
							</div>
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2>Enter Detail</h2>
									</div>
									<form class="form-horizontal" method="post" id="userForm">
										
										<input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>" />
										
										<div class="form-group">
											<label class="col-md-2 control-label">Old Password *</label>
											<div class=" col-md-8">
												<input type="password" class="form-control" name="old_password" onKeyPress="return AvoidSpace(event)" value="<?php //echo $password; ?>" placeholder="Enter Password" maxlength="50" <?php if(!isset($_GET["user_id"])){ ?> required <?php } ?>>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">New Password *</label>
											<div class=" col-md-8">
												<input type="password" class="form-control" name="new_password" id="password1" onKeyPress="return AvoidSpace(event)" value="<?php //echo $password; ?>" placeholder="Enter Password" maxlength="50" <?php if(!isset($_GET["user_id"])){ ?> required <?php } ?>>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
									 
										<div class="form-group">
											<label class="col-md-2 control-label">Confirm Password *</label>
											<div class=" col-md-8">
												<input type="password" class="form-control" name="password" id="password2" onKeyPress="return AvoidSpace(event)" value="<?php //echo $password; ?>" placeholder="Enter Password" maxlength="50" <?php if(!isset($_GET["user_id"])){ ?> required <?php } ?>>
											</div>
											<div class=" col-md-2">
											</div>
										</div>
									 
										 
										 
                                       
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
											<input type="submit" class="btn btn-primary" value="Save changes" />
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