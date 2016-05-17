<?php
   session_start();//start session to be able to use session variables
   require_once'../../core/config.php';
   authenticate("sales-person");//prevents unautorized visitors
   if(isset($_POST['view'])){
     $sales = getSales($_POST['date']);
   }else{
     $sales = getSales();
   }
   //get day for display
   if(empty($sales)){
     $day = date('Y-m-d');
   }else{
     $day = $sales[0]['date_sold'];
   }


   
   $total = 0;

   $seller = getSeller($_SESSION['sales-person'])[0];
   $name   = $seller['fname']." ".$seller['lname'];
   
   
   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Sales</title>
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
    <button><a href="sales-report.php">Sales Report</a></button>
    <button><a href="sales.php">Back</a></button><br><br>
   
   	   <div class="updatestock">
              <h2 style="text-align: center; color: red">
                 Daily Sales: <?php echo $day;?><br>By:
                 <span style="color:blue"> <?php echo $name;?> </span>
              </h2>
              
              <table border="1" cellspacing="0" cellpadding="5" class="table">
              <!-- the same if statement with : used in place of {}. Observe the structure carefully-->
              <?php if(empty($sales)):?>
                <h2 style="color:#ccc;text-align:center;">No sales available for the day specified</h2>
              <?php else:?>
                     <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity Sold</th>
                        <th>Amount</th>
                        <th>Time of Sale</th>
                     </tr>
   	   	    		<?php
                       foreach($sales as $salesProd){
                        //print_array($salesProd);die();
                ?>
                     
                <tr>
                  <td><?php echo $salesProd['name'];?></td>

                  <td><?php printf("%.2f",$salesProd['price']) ;?></td>

                  <td style="text-align:center"><?php echo $salesProd['qty_bought'];?></td>

                  <td><?php printf("%.2f",$salesProd['cost']);?></td>

                  <td><?php echo $salesProd['time'];?></td>
                  
   	   	    		</tr>
                  <?php $total += $salesProd['cost'];?>
   	   	    		<?php };?><!-- end of foreach loop -->
                <tr>
                  <td colspan="3"><b>Total Sales</b></td>
                  <td><b><?php printf("%.2f",$total);?></b></td>
                  <td></td>
                </tr>
   	   	    	</table>
              <hr>
              
            <?php endif;?><!-- end of if statment -->
            <div class="view">
                  <form action="view-sales.php" method="post">
                  <input type="text" name="date" style = "text-align:center"  value="<?php echo $day;?>">
                  <input type="submit" value="View" name="view">
                  </form>
              </div><br>

   	   </div>
</body>
</html>