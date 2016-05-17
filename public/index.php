<?php
 session_start();//start session to be able to use session variables

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style type="text/css">
    body{
      background: white;
      min-height: 500px;
      /*background-image: url(images/background3.jpg);*/
      background-repeat: no-repeat;
      background-size: 100%;
    }
    #wrapper{
	    width: 80%;
		min-height: 300px;
		position: relative;
		left: 50%;
		margin-left: -40%;
		border: 1px solid #ccc;
		border-top-right-radius: 10px;
		padding-left: 10%;
		padding-top: 20%;
		background: white;
    }
    .side-menu{
 	width: 25%;
 	min-height: 400px;
 	background: #ccc;

 	position: relative;
 	left: 50%;
 	margin-left: -12.5%;
 	border: 1px solid grey;
 	border-radius: 10px;
 	display: none;
 }
 #show{
 	font-size: 22px;
 	font-weight: bold;
 	width: 100%;


 }
 button{
 	width: 70%;
 	border-radius: 6px;
 	font-weight: bold;
 	font-size: 22px;
 	cursor: pointer;

 }
  </style>
</head>
<body>
   <?php
     require'includes/header.php';
   ?>
    
     <button id="show">[ MENU ]</button>
   <div class="side-menu">
   	   <div id="wrapper">

       <?php if(isset($_SESSION['ADMINID'])):  ?>
    	<button><a href="logout.php?logout=admin">Logout</a></button>
       <? else :?>
        <button><a href="admin-login.php">Login</a></button>
       <?php endif;?>
      </div>
  </div> 



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" >
	
	$(document).ready(function(){
		$('#show').click(function(){
			$('.side-menu').toggle(2000);
		})
	})
</script>

</body>
</html>