<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="main.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php
session_start();
include('cashier_class.php');
$username = $_SESSION['cashier'];

$stObj = new Cashier($username);
?>
<div id="container">

	<div id="header">
		<img src="../header.png" id="header_pic"/>
	</div>
	<div id="menu">
<a href="personal_details.php" target="myFrame">Personal Details</a>
<a href="add_new_customer.php" target="myFrame">Add New Customer</a>
<a href="serve_customer.php" target="myFrame">Serve Customer</a>
<a href="change_password.php" target="myFrame">Change Password</a>
<a href="../logout.php">Logout</a>
</div>
	
	<div id="main">
			<iframe frameborder="1" width="100%" height="400px" src="serve_customer.php" name="myFrame" id="myFrame">
			
			</iframe>
	</div>
	<div id="footer">
		<li>ZIMBABWE POWER COMPANY</li>
	</div>
</div>
</body>
</html>
