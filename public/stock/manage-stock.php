<?php
   session_start();//start session to be able to use session variables
   require'../includes/header.php';
   require_once'../../core/config.php';
   authenticate("stock-manager");//prevents unautorized visitors
   if(isset($_POST['add-stock']))
   {
   	  //make a call to addProduct function(functions/product.php)
      addproduct();
   }
   
?>
<!DOCTYPE html>
<html>
<head>
	<title>stock management</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
   <br>
   <button><a href="http://localhost/storemanager/public/logout.php?logout=stock-manager">Logout</a></button>
   <button><a href="update-stock.php">Update Stock</a></button>
   <div id="wrapper">
   	   <div class="addstock">
   	   	   <form action="manage-stock.php" method="post">
   	   	   	<fieldset>
   	   	   		<legend>Add Stock</legend>

   	   	   		<input type="text" name="name" required class="text_input" placeholder="Stock name"><br><br>

   	   	   		<input type="text" name="price" required class="text_input" placeholder="Price"><br><br>

   	   	   		<input type="text" name="quantity" required class="text_input" placeholder="Quantity"><br><br>

   	   	   		<input type="date" name="expiry-date" required class="text_input" placeholder="Expiry date" onfocus="myAlert()" onblur="myHide()"><br>
                     <span id="alert" style="color:red"></span>
                     <br><br>

   	   	   		<input type="submit" name="add-stock" value="Add" class="text_input">

   	   	   	</fieldset>
   	   	   </form>
   	   </div>
   	</div>

      <!-- javascript code  -->
      <script type="text/javascript">
       function myAlert(){
         var span
         span = document.getElementById('alert');
         span.innerHTML = "Enter the expiry date";
       }

       function myHide(){
         var span
         span = document.getElementById('alert');
         span.innerHTML = "";
       }
      </script>
</body>
</html>