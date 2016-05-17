<?php
 session_start();
 if($_GET['logout']=='admin')//handle admin logout
 {
 	unset($_SESSION['ADMINID']);
 	//redirect to the home page
 	header("Location: index.php");
 }
 elseif($_GET['logout']=='sales-person')//handle personnel logout
 {
 	unset($_SESSION['sales-person']);
 	//redirect to the login page
 	header("Location: personnel-login.php");
 }
 elseif($_GET['logout']=='stock-manager')//handle personnel logout
 {
 	unset($_SESSION['stock-manager']);
 	//redirect to the login page
 	header("Location: personnel-login.php");
 }
 
?>