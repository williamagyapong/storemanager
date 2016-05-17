<?php
/**
*This page dynamically switches between four interfaces{search 
*form(default), search results, sales form & sales report} 
*based on either of four main actions activated by the user.
*
*Take time to understand the logic
*/
session_start();
require'../includes/header.php';
require_once'../../core/config.php';

authenticate("sales-person");//prevents unauthorized visitors

 $showSearchForm = TRUE;
 $makeSale = FALSE;//use to control the make sales form
 $showReport= FALSE;//use to control the sales report table
if(isset($_POST['search']))
{
     //searchProd(core/functions/products.php)
  	if(!empty(searchProd($_POST['name'])))
  	{
    		  $products = searchProd($_POST['name']);
      		$showSearchResult=TRUE;//use to control the product result table
          $showSearchForm =FALSE;
    	}
    	else{
    		echo "<h2 class='h2'>Product is not available</h2>";
    	}
}
elseif(isset($_POST['initiate-sale']))
{
  	$showSearchResult = FALSE;
    $showSearchForm =FALSE;
    //store session variables to be used later
  	$_SESSION['prod-id'] =  $_POST['prod-id'];
  	$_SESSION['quantity'] = $_POST['quantity'];
  	$_SESSION['qty-sold'] = $_POST['qty-sold'];
  	$makeSale = TRUE;
}
elseif(isset($_POST['accept-sale']))
{
     $showSearchForm =FALSE;
	//use makeSales function(core/functions/products.php)
      $salesInfo = makeSales();
      
  	 if(!empty($salesInfo))
  	 {
  	    $showReport = TRUE;
        //free some session variables after sales is done
        unset($_SESSION['quantity']);
        unset($_SESSION['qty-sold']);
  	 }else{
            $makeSale =TRUE;
            //sales is rejected if the quantity bought exceeds what is available or the payment made is less than the cost of the item or both in which case the makeSales() function returns an empty array
            echo "<h2 style='color:red;' class='h2'>Sales rejected!!</h2>";
       }
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>make sales</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/sales.css">
</head>
<body>
    
   <br>
    <button><a href="http://localhost/storemanager/public/logout.php?logout=sales-person">Logout</a></button>
    <button><a href="view-sales.php">View Sales</a></button>
    <?php if($showSearchForm==FALSE):?>
      <button><a href="sales.php">Search</a></button><br><br> 
    <?php endif;?>
   <div id="wrapper">
       <?php if($showSearchForm==TRUE):?>
       <div class="addstock" style="height: 230px;" id="search">
   	   	   <form action="sales.php" method="post">
   	   	   	<fieldset class="search-field">
   	   	   		<legend>Search From</legend>

   	   	   		<input type="text" name="name" required class="text_input" placeholder="Stock name" autocomplete="off"><br><br>

   	   	   		<input type="submit" name="search" value="Search" class="text_input">

   	   	   	</fieldset>
   	   	   </form>
   	   </div>
       <?php endif;?>

   	   <?php if(isset($products)&&($showSearchResult==TRUE)){ ?>
   	   <div class="search-result">
   	      <h2 style="text-align: center; color: red">Search Result(s)</h2>
   	   	  <table border="1" cellspacing="0" id="table">
                     <tr>
                        <th>Name</th>
                        <th>Price(&cent;)</th>
                        <th>Quantity</th>
                        <th>Expiry date</th>
                        <th>Action</th>
                     </tr>
   	   	    		<?php
                       foreach($products as $product){
   	   	    		?>
                     <form action="sales.php" method="post">
   	   	    		<tr>
   	   	    			<td><?php echo $product['name'];?></td>

   	   	    			<td><?php printf("%.2f",$product['price']);?></td>

   	   	    			<td style="text-align:center"><?php echo $product['quantity'];?></td>

   	   	    			<td><?php echo $product['expiry_date'];?></td>

   	   	    			<input type="hidden" name="prod-id" value="<?php echo $product['id'];?>">

   	   	    			<input type="hidden" name="quantity" value="<?php echo $product['quantity'];?>">

   	   	    			<input type="hidden" name="qty-sold" value="<?php echo $product['qty_sold'];?>">

   	   	    			<td style="padding:0"><input type="submit" name="initiate-sale" value="Initiate Sale" style="font-weight:bold; height:38px; font-size:20px;"></td>
   	   	    		</tr>
                  </form>
   	   	    		<?php };?><!-- end foreach loop-->
   	   	    	</table>
   	   </div>
   	   <?php };?><!-- end if statement-->

   	   <?php if(isset($makeSale)&& ($makeSale==TRUE)){ ?>
   	   <div class="addstock">
   	   	   <form action="sales.php" method="post">
   	   	   	<fieldset>
   	   	   		<legend>Sales Form</legend>
                <?php
   	   	   		$product = displayProd($_SESSION['prod-id']);
   	   	   		?>

   	   	   		<input type="text" name="name" required class="text_input" value="<?php echo $product[0]['name']; ?>"><br><br>

   	   	   		<input type="text" name="quantity" required class="text_input" placeholder="Quantity" autocomplete="off"><br><br>

   	   	   		<input type="text" name="cash-in" required class="text_input" placeholder="Cash in hand" autocomplete="off"><br><br>

   	   	   		<input type="hidden" name="price" value="<?php echo $product[0]['price'];?>" >

   	   	   		<input type="submit" name="accept-sale" value="Accept Sale" class="text_input">

   	   	   	</fieldset>
   	   	   </form>
   	   </div>
       <?php };?><!-- end  second if statement-->
       
       <?php if(isset($salesInfo)&&!empty($salesInfo)&&($showReport==TRUE)){ ?>
       <div class="search-result">
   	      <h2 style="text-align: center; color: red">Sales Report</h2>
   	   	  <table border="1" cellspacing="0" id="table" >
                     <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Payment</th>
                        <th>Balance</th>
                     </tr>
   	   	    		<?php
                       foreach($salesInfo as $salesProd){
                       	//print_array($salesProd);die();
   	   	    		?>
                     
   	   	    		<tr>
   	   	    			<td><?php echo $salesProd['name'];?></td>

   	   	    			<td><?php printf("%.2f",$salesProd['price']);?></td>

   	   	    			<td style="text-align:center"><?php echo $salesProd['quantity'];?></td>

   	   	    			<td><?php printf("%.2f",$salesProd['cost']);?></td>
   	   	    			<td><?php printf("%.2f",$salesProd['cash']);?></td>

   	   	    			<td><?php printf("%.2f",$salesProd['balance']);?></td>

   	   	    		</tr>
                  
   	   	    		<?php };?><!-- end foreach loop-->
   	   	    	</table>
   	   </div>
   	   <?php };?><!-- end if statement-->
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