<?php
error_reporting(0);
date_default_timezone_set("Asia/Karachi");
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dbconfig = "localhost";
$database_dbconfig = "client_isbpos";
$username_dbconfig = "root";
$password_dbconfig = "";
$dbconfig = mysql_pconnect($hostname_dbconfig, $username_dbconfig, $password_dbconfig) or trigger_error(mysql_error(),E_USER_ERROR); 

?>
