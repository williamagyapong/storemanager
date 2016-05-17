<?php
 //admin login function
function login($type)
{
	//initialize neccessary variables
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if(empty($username)||empty($password))
	{
		echo "<h2>All fields are required</h2>";
	}
	else{
		//hash the password
		$password = md5($password);
		//select existing credentials
		if($type=='admin')//handle adminstrator login
		{
			$prevData = select("SELECT * FROM admin WHERE username='$username' AND password = '$password'");

			if(!empty($prevData))
			{ 
				//create session variable to keep track of the admininstrator
				$_SESSION['ADMINID'] = $prevData[0]['id'];
				if(isset($_SESSION['ADMINID']))
				{
					header("Location: admindashboard.php");
				}
				else
				{
					echo "<h2>Unsuccessful login</h2>";
				}
				
			}
			else{
				echo "<h2>Credentials do not match</h2>";
			}
		}
		elseif($type=="personnel")//handle personnel login
		{
			$role     = $_POST['role'];
			$prevData = select("SELECT * FROM `personnels` WHERE username='$username' AND password = '$password' AND role='$role'");

			if(!empty($prevData))
			{   
					if($prevData[0]['role']=='sales-person')
					{
						$_SESSION['sales-person'] = $prevData[0]['id'];
						//redirect to sales.php
						header("Location: stock/sales.php");
					}
					elseif($prevData[0]['role']=='stock-manager')
					{
						$_SESSION['stock-manager'] = $prevData[0]['id'];
						//redirect to managestock.php
						header("Location: stock/manage-stock.php");
					}
			}
			else{
				echo "<h2>Credentials do not match</h2>";
			}
		}
		

		
	}
}

		
function authenticate($type)
{
	$url1 = "http://localhost/storemanager/public/index.php";
	$url2 = "http://localhost/storemanager/public/personnel-login.php";
	if($type=="admin")
	{
       if(!isset($_SESSION['ADMINID'])){

       	  header("Location:$url1");
       }
	}
	elseif($type=="sales-person")
	{
       if(!isset($_SESSION['sales-person'])){

       	  header("Location:$url2");
       }
       
	}
	elseif($type=="stock-manager")
	{
       if(!isset($_SESSION['stock-manager'])){

       	  header("Location:$url2");
       }
       
	}
}


?>