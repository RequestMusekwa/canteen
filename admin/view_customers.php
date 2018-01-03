<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
<link href="jquery/jquery-ui.css" type="text/css" rel="stylesheet" />
<link href="jquery/jquery-ui.structure.css" type="text/css" rel="stylesheet" />
<link href="jquery/jquery-ui.theme.css" type="text/css" rel="stylesheet" />
</head>

<body>

<?php
include '../db_con.php';
session_start();
$admin = $_SESSION['admin'];
?>
<fieldset>
	<legend><b>Search Assets</b></legend>
	<label>Search BY:
	<select name="by" id="by">
		<option value="name">Name</option>
		<option value="surname">Surname</option>
	</select>
	</label>
	
	<input type="text" id="txt" onkeyup="pushSearch(this.value)"/>
</fieldset>
<div id="results">
<div id="panel">
<?php
allCategory($admin);

function allCategory($admin){	
	
	$query = "SELECT * FROM customer ORDER BY id ASC";
	$query_run = mysql_query($query);
	
	while($std = mysql_fetch_assoc($query_run)){
		$username = $std['username'];
		echo '<h1>'.$std['name'].' '.$std['surname'].' </h1>';
		
		$query1 = "SELECT * FROM sales WHERE customer_username = '$username' ";
		$query_run1 = mysql_query($query1);
		$row1 = mysql_num_rows($query_run1);
		
		?> <div>
		
		<table id="wider" class="heading" border="1">
		<caption align="bottom">
			<a href="delete_customer.php?id=<?php echo $std['username']; ?>">DELETE Customer</a>
		</caption>
		  <tr>
			<td>No. </td>
			<td>Food Name</td>
			<td>Quantity </td>
			<td>Total</td>
			<td>Sale Date </td>
		  </tr>
  
   <?php
   		$n = 0;
		while($res1 = mysql_fetch_assoc($query_run1)){
			$n++;
			 ?>
		  <tr>
			<td><?php echo '#'.$n; ?></td>
			<td><?php echo $res1['food_name']; ?></td>
			<td><?php echo $res1['quantity']; ?></td>
			<td align="center"><?php echo '$ '.$res1['total']; ?></td>	
			<td><?php echo date("d-M-Y",strtotime($res1['sale_date'])); ?></td>
		  </tr>
		  <?php
			
		}
		
		?> </table> </div><?php
	}
}

?>
</div>
</div>

<script type="text/javascript" src="js/jquery-3.2.0.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>
	$(document).ready(function(){
		$("#panel").accordion({collapsible:true},{event:"click"},{animate:1000});
	});
	
	function pushSearch(str){
		 
		var by = document.getElementById("by");
		var txt = document.getElementById("txt");
		var results = document.getElementById("results");
		
		var xhr = new XMLHttpRequest();
		xhr.open('GET','search_customer.php?by='+by.value+'&txt='+txt.value,true);
		
		xhr.onreadystatechange = function (){
			if(xhr.readyState == 2){
				results.innerHTML = 'Loading......';
			}
			console.log(xhr.readyState);
			if(xhr.readyState == 4 && xhr.status == 200){
				results.innerHTML = xhr.responseText;
			}
		}
		
		xhr.send();
		
	}
</script>
</body>
</html>
