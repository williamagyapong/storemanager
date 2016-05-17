<?php
   session_start();//start session to be able to use session variables
   require_once'../../core/config.php';
   require'../includes/header.php';
   
   authenticate("stock-manager");//prevents unautorized visitors
   if(isset($_POST['save']))
   {
      //use updateProduct function(core/functions/products.php)
      updateProduct();

      
   }
   
   
?>
<!DOCTYPE html>
<html>
<head>
	<title>update stock</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
  
</head>
<body>
    <br>
    <button><a href="http://localhost/storemanager/public/logout.php?logout=stock-manager">Logout</a></button>
    <button><a href="manage-stock.php">Back</a></button>
   
    
   	   <div class="updatestock">
              <h2 style="text-align: center; color: red">Update/Edit Product</h2>
              <?php if(empty(displayProd())):?>
                <h2 style="color:#ccc;text-align:center">There is no item in stock</h2>
              <?php else:?>
              <table border="0" cellspacing="0" class="stock-table" title="Click on an item to make changes">
                     <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty Left</th>
                        <th>Qty Sold</th>
                        <th>Expiry date</th>
                        <th>Action</th>
                     </tr>
   	   	    		<?php
                       foreach(displayProd() as $product){
   	   	    		?>
                     <form action="update-stock.php" method="post">
   	   	    		<tr>
   	   	    			<td><input type="text" name ="name" style="text-align:left;padding-left:20px;" value="<?php echo $product['name'];?>"></td>

   	   	    			<td><input type="text" name="price" size="6" value="<?php printf('%.2f',$product['price']);?>" ></td>

   	   	    			<td><input type="text" name="quantity" size="6" value="<?php echo $product['quantity'];?>" ></td>

                  <td><input type="text" name="qty-sold"size="6" readonly="readonly" value="<?php echo $product['qty_sold'];?>" ></td>

   	   	    			<td><input type="text" name="expiry-date" size="9" value="<?php echo $product['expiry_date'];?>" ></td>

                         <input type="hidden" name="prod-id" value="<?php echo $product['id'];?>">

   	   	    			<td><input type="submit" name="save" value="Save changes"></td>
   	   	    		</tr>
                  </form>
   	   	    		<?php };?>
   	   	    	</table>
            <?php endif;?>
   	   </div>

       <!-- javascript/jquery -->
   <script type="text/javascript" src="../js/jquery.js"></script>
   <script type="text/javascript">
      $(document).ready(function(){
          //hides all vissible h2 elements after 4 seconds with a hiding speed of 2.5 seconds
          setTimeout(function(){
             $('.h2').fadeOut(2500)
           },4000)
      })
   </script>
</body>
</html>