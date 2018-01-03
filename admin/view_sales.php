<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="jquery/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="jquery/jquery-ui.structure - Copy.css">
<link rel="stylesheet" type="text/css" href="jquery/jquery-ui.theme.css">
<style>
	fieldset{
		background-color: #999999;
	}
</style>
</head>

<body>
<?php
	include'../db_con.php';
	

function dist(){
	$query = mysql_query("SELECT * FROM sales ORDER BY id DESC");
?>

<table id="wider" class="heading">
  <caption>
    All Sales Made
  </caption>
  <tr>
    <td>No.</td>
	<td>Food</td>
	<td>Quantity</td>
	<td> Total </td>
	<td>Date</td>
    <td>Cashier Username</td>
  </tr>
  <?php 
  	$n = 0;
  	while($re1 = mysql_fetch_assoc($query)){
	$n++;
  ?>
  <tr>
    <td align="center"><?php echo '#'.$n; ?></td>
  	<td><?php echo $re1['food_name']; ?></td>
	<td><?php echo $re1['quantity']; ?></td>
	<td><?php echo $re1['total']; ?></td>
    <td><?php echo date("d-M-Y",strtotime($re1['sale_date'])); ?></td>
	 <td><?php echo $re1['cashier_username']; ?></td>
  </tr>
  <?php
  	}
  ?>
</table>
<?php
}


function betweenDates($date1, $date2){
	$date1 = date("Y-m-d",strtotime($date1));
	$date2 = date("Y-m-d",strtotime($date2));
	
	$query = mysql_query("SELECT * FROM sales WHERE sale_date BETWEEN '$date1' AND '$date2' ORDER BY id ASC");
	$num = mysql_num_rows($query);
	
	if($num == 0){
		echo "<h2>No issues made between $date1 and $date2</h2>";
		exit;
	}
?>

<table id="wider" class="heading">
  <caption>
    Issues Made Between  <?php echo date("d-M-Y",strtotime($date1)).' And '.date("d-M-Y",strtotime($date2));?>
  </caption>
  <tr>
    <td>No.</td>
	<td>Food</td>
	<td>Quantity</td>
	<td> Total </td>
	<td>Date</td>
    <td>Cashier Username</td>
  </tr>
  <?php 
  	$n = 0;
  	while($re1 = mysql_fetch_assoc($query)){
	$n++;
  ?>
  <tr>
    <td align="center"><?php echo '#'.$n; ?></td>
  	<td><?php echo $re1['food_name']; ?></td>
	<td><?php echo $re1['quantity']; ?></td>
	<td><?php echo $re1['total']; ?></td>
    <td><?php echo date("d-M-Y",strtotime($re1['sale_date'])); ?></td>
	 <td><?php echo $re1['cashier_username']; ?></td>
  </tr>
  <?php
  	}
  ?>
</table>
<?php
}
?>

<form action="view_sales.php" method="post">
	<fieldset>
	<legend>Sales Made Between</legend>
	<input id="d1" name="day1" type="text" /> &nbsp; And &nbsp;
	<input id="d2" name="day2" type="text" />
	<input name="submit" type="submit" value="Search" />
	</fieldset>
</form>
<br/>

<?php
if(isset($_POST['submit'])){
	$day1 = mysql_real_escape_string($_POST['day1']);
	$day2 = mysql_real_escape_string($_POST['day2']);
	
	if(empty($day1) || empty($day2)){
		?>
			<script type="text/javascript">
			alert("both dates are required");
			window.location="view_sales.php";
			</script>
		<?php
	}
	else{
		betweenDates($day1, $day2);
	}
}
else{
	dist();
}

?>

<script src='js/jquery-3.2.0.js'></script>

<script type="text/javascript" src="jquery/jquery-ui.min.js"></script>
<script>

$(document).ready(function(){
	$("#city").selectmenu({width:150});
});
	 $("#d1").click(function() {
            $( "#d1" ).datepicker({showButtonPanel:true, closeText:"close", changeMonth:true, changeYear:true, maxDate: new Date(2017,11,2)});
            $( "#d1" ).datepicker("show");
         });
	
	$("#d2").click(function() {
            $( "#d2" ).datepicker({changeMonth:true, changeYear:true, maxDate: new Date()});
            $( "#d2" ).datepicker("show")
         });
</script>
</body>
</html>
