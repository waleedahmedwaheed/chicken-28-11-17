<?php session_start();
error_reporting(0);
include('db/dbcon.php');

unset($_SESSION['id']);
unset($_SESSION['s_id']); 

if(isset($_POST['login']))
{

$username   	=	$_POST['username'];
$shop_id  		=	$_POST['shop_id'];
$pass_unsafe	=	$_POST['password'];

//$user = mysql_real_escape_string($user_unsafe);
$pass1 = mysql_real_escape_string($pass_unsafe);
$pass=md5($pass1);
$salt="a1Bz20ydqelm8m1wql";
$pass=$salt.$pass;

	 $query="select * from user where username='$username' and password='$pass' and status = '0' and shop_id='$shop_id'";
	//exit;
	mysql_select_db($database_dbconfig, $dbconfig);
	$Result1 = mysql_query($query, $dbconfig) or die(mysql_error());
	$row=mysql_fetch_assoc($Result1);
           $id		=	$row['user_id'];
           $s_id	=	$row['shop_id'];
          
		   $counter=mysql_num_rows($Result1);
			//exit;
		  	if ($counter == 0) 
			  {	
				echo "<script type='text/javascript'>alert('Invalid Username or Password!');
				  document.location='login.php'</script>";
			  } 
			  else
			  {
				  
				  $querys="select * from shop where shop_id='$shop_id'";
					//exit;
					mysql_select_db($database_dbconfig, $dbconfig);
					$Result1s = mysql_query($querys, $dbconfig) or die(mysql_error());
					$rows=mysql_fetch_assoc($Result1s);
					$shophead = $rows["shop_head"];
					
				   $_SESSION['shop_head']	=	$shophead;	
				   $_SESSION['id']	=	$id;	
				  $_SESSION['s_id']	=	$s_id;	
				echo "<script type='text/javascript'>document.location='index.php'</script>";   
				
			  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>IC - POS</title>
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/animate.css" type="text/css">
<link rel="stylesheet" href="css/waves.css" type="text/css">
<link rel="stylesheet" href="css/layout.css" type="text/css">
<link rel="stylesheet" href="css/components.css" type="text/css">
<link rel="stylesheet" href="css/plugins.css" type="text/css">
<link rel="stylesheet" href="css/common-styles.css" type="text/css">
<link rel="stylesheet" href="css/pages.css" type="text/css">
<link rel="stylesheet" href="css/responsive.css" type="text/css">
<link rel="stylesheet" href="css/matmix-iconfont.css" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" type="text/css">
</head>
<body class="login-page">
    <div class="page-container">
        <div class="login-branding">
            <a href="login.php"><img src="images/logo-large.png" alt="logo" style="height: 100px;"></a>
        </div>
        <div class="login-container">
            <img class="login-img-card" src="images/avatar/user.jpg" alt="login thumb" />
            <form class="form-signin" method="post">
		<input type="text" id="inputEmail" name="username" class="form-control floatlabel " placeholder="Username" required autofocus>
		<input type="password" id="inputPassword" name="password" class="form-control floatlabel " placeholder="Password" required>
			<select class="form-control select2-allow-clear" name="shop_id" required>
													<option value="0">--Select--</option>
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
				<div id="remember" class="checkbox hide">
                    <label>
                        <input type="checkbox" class="switch-mini" /> Remember Me
                    </label>
                </div>
                <button class="btn btn-danger btn-block btn-signin" name="login" type="submit">Sign In</button>
            </form>


        </div>
        <div class="create-account hide">
            <a href="#">
                Create Account
            </a>
        </div>

        <div class="login-footer">
            Copyright 2017
        </div>

    </div>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/jRespond.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nav-accordion.js"></script>
    <script src="js/hoverintent.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/switchery.js"></script>
    <script src="js/jquery.loadmask.js"></script>
    <script src="js/icheck.js"></script>
    <script src="js/bootbox.js"></script>
    <script src="js/animation.js"></script>
    <script src="js/colorpicker.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/floatlabels.js"></script>

    <script src="js/smart-resize.js"></script>
    <script src="js/layout.init.js"></script>
    <script src="js/matmix.init.js"></script>
    <script src="js/retina.min.js"></script>
</body>
</html>