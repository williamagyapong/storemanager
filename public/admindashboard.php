<?php
 session_start();//start session to be able to use session variables
 require_once '../core/config.php';
 $id = $_SESSION['ADMINID'];
 $admin = select("SELECT * FROM `admin` WHERE `id`='$id'")[0];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
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
  span{
    color: red;
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
      <!-- the same if statement with ":" used in place of {}. Observe the structure carefully-->
       <?php if(isset($_SESSION['ADMINID'])):  ?>
    	<button class="button"><a href="logout.php?logout=admin">Logout</a></button><br><br>

    	<button class="button"><a href="personnel-register.php">Add Personnel</a></button><br><br>

    	<button class="button"><a href="personnel-login.php" target="_blank">Personnel login</a></button><br><br>
       <? else :?><!-- the else block -->
       
        <button class="button"><a href="admin-login.php">Login</a></button>
       <?php endif;?><!-- end of the if statement -->
    </div> 
  </div>
  <div class="logged">
      <h2>
         <span>Logged in as:</span> <?php echo $admin['username']; ?>
      </h2>
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