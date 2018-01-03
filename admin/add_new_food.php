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
		$price = mysql_real_escape_string($_POST['price']);
		
		if(checkUsername($name)){
			insert($name,$price);
		}
	}
?>
<form action="add_new_food.php" method="post">
<table>
  <caption>
    Enter Food Details
  </caption>
  <tr>
    <td>Name</td>
    <td><label>
      <input type="text" name="name" partten="[A-Za-z]+" maxlength="25" minlength="3" required/>
    </label></td>
  </tr>
  <tr>
    <td>Price</td>
    <td><label>
      <input type="text" name="price" pattern="[0-9.]+" maxlength="2" required/>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input id="static" type="submit" name="submit" value="ADD Food" />
    </label></td>
  </tr>
</table>
</form>
<?php
function insert($name,$price){
	$query = mysql_query("INSERT INTO food (name, price) VALUES('$name','$price')");
	
	if($query){
		?>
		<script type="text/javascript">
		alert("Food succesfully Added");
		window.location="add_new_food.php";
		</script>
		<?php
	}
	else{
		echo mysql_error();
	}
}


function checkUsername($food){
	$query = mysql_query("SELECT * FROM food WHERE name = '$food'");
	$row = mysql_num_rows($query);
	
	if($row > 0){
		?>
		<script type="text/javascript">
		alert("Food name already in use");
		window.location="add_new_food.php";
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
<caption>Food List</caption>
<tr>
	<td>No.</td>
	<td>Name</td>
	<td>Price</td>
	<td></td>
</tr>
<?php
$query1 = mysql_query("SELECT * FROM food ORDER BY name");
$num = 0;

while($res = mysql_fetch_assoc($query1)){
	$num++;
	$id = $res['id'];
	?>
	<tr>
		<td align="center"><?php echo '#'.$num; ?></td>
		<td><?php echo $res['name']; ?></td>
		<td><?php echo '$ '.$res['price']; ?></td>
				<?php
				echo '<td align ="left"><a href="delete_food.php?id='.$id.'"
		onclick="return confirm(\'Are you sure you want to delete this Cashier?\')">
		DELETE</a></td>';			
				?>
	</td>
<?php } ?>
</table>

</body>
</html>
