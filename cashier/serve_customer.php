<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<?php
include '../db_con.php';

$query = mysql_query("SELECT * FROM food");
?>

<form action="serve_customer_processor.php" method="post">
	<fieldset>
	<legend>Make a Sale</legend>
	<p align="center">Enter Customer Username	<input name="customer_username" type="text" required/></p>
	
	<table border="0" class="heading">
  <caption>
    Select Food
  </caption>
  <tr>
    <td>Food Name </td>
	<td>Price</td>
    <td>Check</td>
    <td>Quantity</td>
  </tr>
  <?php
  while($details = mysql_fetch_assoc($query)){
  $check_id = $details['id'];
  ?>
  <tr>
    <td><?php echo $details['name']; ?></td>
    <td><?php echo '$ '.$details['price']; ?></td>
	<td><input name="checked_food[]" type="checkbox" value="<?php echo $details['name']; ?>" /></td>
    <td>X <input size="1" name="<?php echo $check_id; ?>" value="1" type="text" pattern="[0-9]+" /></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td><input name="RESET" type="reset" value="RESET" /></td>
    <td><input name="submit" type="submit" value="OK" /></td>
    <td>&nbsp;</td>
  </tr>
</table>

	</fieldset>
</form>
</body>
</html>
