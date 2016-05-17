<?php
 require'includes/header.php';
 echo "<hr>";
 require_once'../core/config.php';
  if(isset($_POST['register']))
  {
  	$fname    = trim($_POST['fname']);//trim clears white spaces
  	$lname    = trim($_POST['lname']);
  	$username = trim($_POST['username']);
  	$password = md5(trim($_POST['password']));
  	if(!empty($fname)&&
  	   !empty($lname)&&
  	   !empty($username)&&
  	   !empty($password))
  	{
      if(insert('admin',[
             'fname'=>$fname,
             'lname'=>$lname,
             'username'=>$username,
             'password'=>$password
       	]))
      {
      	echo "<h2>Registration successful</h2>";
      }
      else{
      	echo "Sorry, unsuccessful registration";
      }
  	}
  	else{
  		echo "<h2>All fields are required</h2>";
  	}
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>admin registration</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
  <style type="text/css">
    body{
      background: blue;
    }
    .text_input{
      min-height: 40px;
  width: 55%;
  /*width: 300px;*/
  text-align: center;
  font-weight: bold;
  font-size:24px;
  border-radius: 7px;
    }
  </style>
</head>
<body>
   <button class="back"><a href="admindashboard.php">Back</a></button>
   <button><a href="admin-login.php">Login</a></button>
 <form action="adminregister.php" method="post">
 	<fieldset>
 		<legend>Registration Form</legend>

 		<input type="text" name="fname" placeholder="first name" required class="text_input" autocomplete="off"><br><br>

 		<input type="text" name="lname" placeholder="last name" required class="text_input" autocomplete="off"><br><br>

 		<input type="text" name="username" placeholder="username" required class="text_input" autocomplete="off"><br><br>

 		<input type="password" name="password" placeholder="password" required class="text_input"><br><br>

 		<input type="submit" name="register" value="Register" class="text_input">


 	</fieldset>
 </form>

 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" >
  
  $(document).ready(function(){
    //hides all vissible h2 elements after 4 seconds with a hiding speed of 2.5 seconds
    setTimeout(function(){
      $('h2').fadeOut(2500)
    },4000)
    
  })
</script>
</body>
</html>

