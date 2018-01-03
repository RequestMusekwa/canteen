<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="main.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<div id="container">

	<div id="header">
		<img src="../header.png" id="header_pic"/>
	</div>
	<div id="main">
		<div id="menu">
			<a href="add_new_cashier.php" target="myFrame">Add new Cashier</a>
			<a href="add_new_food.php" target="myFrame">Add New Food</a>
			<a href="view_sales.php" target="myFrame">View Sales</a>
			<a href="view_customers.php" target="myFrame">View Customers</a>
			<a href="change_password.php" target="myFrame">Change Password</a>
			<a href="../logout.php">Logout</a>
		</div>
		
		<div id="content">
				<iframe frameborder="1" width="100%" height="400px" src="view_sales.php" name="myFrame" id="myFrame">
				
				</iframe>
		</div>
	</div>
	
	<div id="footer">
		<li>ZIMBABWE POWER COMPANY</li>
	</div>
</div>
</body>
</html>
