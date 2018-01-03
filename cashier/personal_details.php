<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<?php
session_start();
include('cashier_class.php');
$username = $_SESSION['cashier'];

$stObj = new Cashier($username);
?>
<table>
<caption>Personal Details</caption>
<tr>
	<td>Name </td>
	<td><?php echo $stObj->name; ?></td>
</tr>
<tr>
	<td>Surname </td>
	<td><?php echo $stObj->surname; ?></td>
</tr>
<tr>
	<td>Username </td>
	<td><?php echo $stObj->username; ?></td>
</tr>
<tr>
	<td>Title </td>
	<td><?php echo $stObj->type; ?></td>
</tr>

</table>

</body>
</html>
