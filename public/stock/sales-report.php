<?php
   session_start();//start session to be able to use session variables
   require_once'../../core/config.php';
   authenticate("sales-person");//prevents unautorized visitors
   
     $sales = getTotalSales();
     $total = 0;

   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sales Report</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
  <style type="text/css">
    
    table{
      margin-left: 25%;
      color: black;
      background: white;
    }
    table th, td{
      padding: 10px;
    }
  </style>
</head>
<body>
    <?php require'../includes/header.php';?>
   <br>
    <button><a href="http://localhost/storemanager/public/logout.php?logout=sales-person">Logout</a></button>
    <button><a href="view-sales.php">Back</a></button><br><br>
   
   	   <div class="updatestock">
              <h2 style="text-align: center; color: red">
                 Overall Sales Report</h2>
              
              <table border="1" cellspacing="0" cellpadding="5" class="table">
              <!-- the same if statement with : used in place of {}. Observe the structure carefully-->
              <?php if(empty($sales)):?>
                <h2 style="color:#ccc;text-align:center;">No sales available</h2>
              <?php else:?>
                     <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity Sold</th>
                        <th>Amount</th>
                     </tr>
   	   	    		<?php
                       foreach($sales as $salesProd){
                        //print_array($salesProd);die();
                ?>
                     
                <tr>
                  <td><?php echo $salesProd['name'];?></td>

                  <td><?php printf("%.2f",$salesProd['price']) ;?></td>

                  <td style="text-align:center"><?php echo $salesProd['qty_sold'];?></td>

                  <td><?php printf("%.2f",($salesProd['price']*$salesProd['qty_sold']));?></td>
                  
   	   	    		</tr>
                  <?php $total += ($salesProd['price']*$salesProd['qty_sold']);?>
   	   	    		<?php };?><!-- end of foreach loop -->
                <tr>
                  <td colspan="3"><b>Total Sales</b></td>
                  <td><b><?php printf("%.2f",$total);?></b></td>
                </tr>
   	   	    	</table>
              <hr>
              
            <?php endif;?><!-- end of if statment -->
            

   	   </div>
</body>
</html>