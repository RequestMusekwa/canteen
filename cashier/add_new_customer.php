<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<?php
	include'../db_con.php';
	
	if(isset($_POST['submit'])){
		$name = mysql_real_escape_string($_POST['name']);
		$surname = mysql_real_escape_string($_POST['surname']);
		$username = mysql_real_escape_string($_POST['username']);
		
		if(checkUsername($username)){
			insert($name,$surname,$username);
		}
	}
?>
<form action="add_new_customer.php" method="post">
<table>
  <caption>
    Enter Customer Details
  </caption>
  <tr>
    <td>Name</td>
    <td><label>
      <input type="text" name="name" partten="[A-Za-z]+" maxlength="25" minlength="3" required/>
    </label></td>
  </tr>
  <tr>
    <td>Surname</td>
    <td><label>
      <input type="text" name="surname" pattern="[A-Za-z]+" maxlength="25" minlength="3" required/>
    </label></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><label>
      <input type="text" name="username" pattern="[A-Za-z0-9]+" maxlength="15" minlength="8" required/>
    </label></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input id="static" type="submit" name="submit" value="ADD Customer" />
    </label></td>
  </tr>
</table>
</form>
<?php
function insert($name,$surname,$username){
	$query = mysql_query("INSERT INTO customer (name, surname, username) VALUES('$name','$surname','$username')");
	
	if($query){
		?>
		<script type="text/javascript">
		alert("Customer succesfully Added");
		window.location="add_new_customer.php";
		</script>
		<?php
	}
	else{
		echo mysql_error();
	}
}


function checkUsername($username){
	$query = mysql_query("SELECT * FROM customer WHERE username = '$username'");
	$row = mysql_num_rows($query);
	
	if($row > 0){
		?>
		<script type="text/javascript">
		alert("Username already in use");
		window.location="add_new_customer.php";
		</script>
		<?php
		return false;
	}
	else{
		return true;
	}
}

function generateUsername(){
	$str = 'zimdefa0';
	$num = rand(0,100);
	$username = $str.''.$num;
	$unique = true;
	
	while($unique){
		$query = mysql_query("SELECT * FROM admin WHERE username = '$username'");
		$row = mysql_num_rows($query);
		
		if($row <= 0){
			$unique = false;
			$username = $str.''.$num;
			return $username;
			break;
		}
		else{
			$num = rand(0,100);
			$username = $str.''.$num;
		}
	}
}
?>

</body>
</html>
