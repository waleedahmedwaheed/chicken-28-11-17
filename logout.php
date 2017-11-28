<?php  include_once('db/dbcon.php');

mysql_select_db($database_dbconfig, $dbconfig);

session_start();

unset($_SESSION['id']);
unset($_SESSION['s_id']);

session_write_close();
 
echo '<script> document.location = "login.php"; </script>'; 

?>

