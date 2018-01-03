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
		$password = mysql_real_escape_string($_POST['password']);
		
		if(checkUsername($username)){
			insert($name,$surname,$username,$password);
		}
	}
?>
<form action="add_new_cashier.php" method="post">
<table>
  <caption>
    Enter Cashier Details
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
    <td>Password</td>
    <td><label>
      <input type="text" name="password" pattern="[A-Za-z0-9@]+" maxlength="15" minlength="8" required/>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input id="static" type="submit" name="submit" value="ADD Cashier" />
    </label></td>
  </tr>
</table>
</form>
<?php
function insert($name,$surname,$username,$password){
	$query = mysql_query("INSERT INTO admin (name, surname, username, password, type) VALUES('$name','$surname','$username','$password','cashier')");
	
	if($query){
		?>
		<script type="text/javascript">
		alert("Cashier succesfully Added");
		window.location="add_new_cashier.php";
		</script>
		<?php
	}
	else{
		echo mysql_error();
	}
}


function checkUsername($username){
	$query = mysql_query("SELECT * FROM admin WHERE username = '$username'");
	$row = mysql_num_rows($query);
	
	if($row > 0){
		?>
		<script type="text/javascript">
		alert("Username already in use");
		window.location="add_new_cashier.php";
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


<table class="heading">
<caption>Cashier List</caption>
<tr>
	<td>No.</td>
	<td>Name</td>
	<td>Surname</td>
	<td>Username</td>
	<td></td>
</tr>
<?php
$query1 = mysql_query("SELECT * FROM admin WHERE type ='cashier' ORDER BY name");
$num = 0;

while($res = mysql_fetch_assoc($query1)){
	$num++;
	$id = $res['id'];
	?>
	<tr>
		<td align="center"><?php echo '#'.$num; ?></td>
		<td><?php echo $res['name']; ?></td>
		<td><?php echo $res['surname']; ?></td>
		<td><?php echo $res['username']; ?></td>
				<?php
				echo '<td align ="left"><a href="delete_cashier.php?id='.$id.'"
		onclick="return confirm(\'Are you sure you want to delete this Cashier?\')">
		DELETE</a></td>';			
				?>
	</td>
<?php } ?>
</table>

</body>
</html>
