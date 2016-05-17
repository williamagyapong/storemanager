<?php
 
function addProduct()
{
	$name        = $_POST['name'];
	$price       = $_POST['price'];
	$quantity    = $_POST['quantity'];
	$expiryDate  = $_POST['expiry-date'];

	if( !empty($name)&&
		!empty($price)&&
		!empty($quantity)&&
		!empty($expiryDate)
		){
		//insert data with insert functon(functions/db-helper)
		if(insert('products',[
			    'name'=>$name,
			    'price'=>$price,
			    'quantity'=>$quantity,
			    'expiry_date'=>$expiryDate

			])){
			echo "<h2>Product has been added</h2>";
		}
		else{
			echo "<h2 style='color:red'>Sorry, could not add product!</h2>";
		}

	}
	else{
		echo "<h2 style='color:red'>All fields are required</h2>";
	}
}

function displayProd($id="*")
{
	if($id=="*"){
		//select all products
      return select("SELECT * FROM `products` ORDER BY `name`");
	}
	else{
		//select a particular product
		return select("SELECT * FROM `products` WHERE `id`='$id'");
	}
}

function updateProduct()
{
	$name        = $_POST['name'];
	$price       = $_POST['price'];
	$prodId      = $_POST['prod-id'];
	$quantity    = $_POST['quantity'];
	$expiryDate  = $_POST['expiry-date'];

	// use update function(core/functions/db-helper.php)
	if(update('products', $prodId, [
		       'name'=>$name,
		       'price'=>$price,
		       'quantity'=>$quantity,
		       'expiry_date'=>$expiryDate
		])){
		echo "<h2 class='h2'>Changes saved</h2>";
	}
	else{
		echo "<h2 style='color:red'>Sorry, unable to  save changes</h2>";
	}
}

function allowSale($prodId, $qtyBought)
{
	$product = select("SELECT * FROM `products` WHERE `id`=$prodId");
	if($product[0]['quantity']>$qtyBought)
	{
		return TRUE;
	}

}

function makeSales()
{ 
   $name     = $_POST['name'];
   $price    = $_POST['price'];
   $qtyBought = $_POST['quantity'];
   if(isset($_SESSION['prod-id'])&&isset($_SESSION['quantity'])&&
   	  isset($_SESSION['qty-sold'])&&isset($_SESSION['sales-person'])
   	 ){
   	       $prodId   = $_SESSION['prod-id'];
		   $totalQty = $_SESSION['quantity'];
		   $qtySold  = $_SESSION['qty-sold'];
		   $sellerId  = $_SESSION['sales-person'];
		   

		   $cash     = $_POST['cash-in'];
		   //calculate the cost of the products being sold 
		   $cost  = $price * $qtyBought;
		   //calculate the balance if any
		   $bal = $cash -$cost;
		   //calculate quantity left of that product
		   $qtyLeft = $totalQty - $qtyBought;
		   
		   $qtySold += $qtyBought; 
		   if(allowSale($prodId, $qtyBought)&& ($cash>=$cost))
		   {
		       //update products table in the database
			   if(update('products',$prodId,[
			   	          'quantity'=>$qtyLeft,
			   	          'qty_sold'=>$qtySold
			   	])){
			   	 //store sales record in sales table
			   	 $date = date('Y-m-d');
			   	 $time = date('H:i:s');
			   	 insert('sales',[
			   	 	     'time'=>$time,
			   	 	     'cost'=>$cost,
			   	 	     'prod_id'=>$prodId,
			   	 	     'date_sold'=>$date,
			   	 	     'qty_bought'=>$qtyBought,
			   	 	     'seller_id'=>$sellerId
			   	 	]);
			   	 return  $salesInfo = array('product'=>array(
			   	 	                 'name'=>$name, 
			   	  	                 'price'=>$price,
			   	  	                 'quantity'=>$qtyBought, 
			   	  	                 'cost'=>$cost,
			   	  	                 'cash'=>$cash,
			   	  	                 'balance'=>$bal));
			   }else{
			   	   return $salesInfo = array();
			   }

		   }else{
		          return $salesInfo = array();
		   }
   	 }
		   
   
}

function searchProd($name)
{  
	return select("SELECT * FROM `products` WHERE `name`LIKE'$name%'");
}

function getSales($date="")
{ 
	
	$sellerId = $_SESSION['sales-person'];
	$today = date('Y-m-d');
	if(empty($date))
      $date = $today;
	//selecting from the products and sales tables
    return select("SELECT products.*, sales.* FROM products, sales WHERE products.id = sales.prod_id AND sales.date_sold='$date' AND sales.seller_id='$sellerId'");
}

function getTotalSales()
{
	return select("SELECT * FROM `products` WHERE `qty_sold` !=0 ORDER BY `name`");
}

function getSeller($id)
{   
	
	return select("SELECT * FROM `personnels` WHERE `id`='$id'");
}



