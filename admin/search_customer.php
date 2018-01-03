<div id="panel">

<?php
include '../db_con.php';

$by = $_GET['by'];
$txt = $_GET['txt'];

$query_run = mysql_query("SELECT * FROM customer WHERE $by LIKE '%$txt%'");
	$row = mysql_num_rows($query_run);
		
		if($row == 0){
			echo 'No matches found ';
			exit;
		}
		
	while($std = mysql_fetch_assoc($query_run)){
		$username = $std['username'];
		echo '<h1>'.$std['name'].' '.$std['surname'].' </h1>';
		
		$query1 = "SELECT * FROM sales WHERE customer_username = '$username' ";
		$query_run1 = mysql_query($query1);
		$row1 = mysql_num_rows($query_run1);
		
		if($row1 == 0){
			echo 'No transactions for this client ';
			exit;
		}
		
		?> <div>
		
		<table id="wider" class="heading" border="1">
		<caption align="right">
			<a href="delete_customer.php?id=<?php echo $std['username']; ?>">DELETE</a>
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
		
		?> </table> </div>
		
	<?php
	
}

?>
</div>