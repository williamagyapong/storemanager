<?php
session_start();//start session to be able to use the session variable
  require'includes/header.php';
  echo "<hr>";
  require_once '../core/config.php';
  authenticate("admin");//prevents unauthorized visits to the page(core/functions/users.php)

  if(isset($_POST['login']))
  {
     //handle login with the login function(core/functions/users.php)
     login('personnel');
  }

  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Personnel login</title>
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
   <br><br>
   <form action="personnel-login.php" method="post">
  <fieldset>
    <legend>Personnel Login</legend>
          <br><br>
    <input type="text" name="username" placeholder="username" class="text_input" required><br><br>

    <input type="password" name="password" placeholder="password" class="text_input" required><br><br>

    <input type="text" name="role" placeholder="assigned role" class="text_input" required><br><br>

    <input type="submit" name="login" value="Login" class="text_input">


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