<?php
session_start() ; 
include("db/dbcon.php"); 
	 
    if(isset($_SESSION['s_id']) && $_SESSION['s_id'] != '')
        echo true;

    else 
        echo false;
?>