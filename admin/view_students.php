<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
<style>
	input[type="text"]{
		width:300px;
	}
	input{
		color:red;
	}
</style>
</head>
<?php
include('../db_con.php');

$query = mysql_query("SELECT * FROM students ORDER BY reg_number");
$num = 1;

?>
<table>
<caption>Student List</caption>
<tr>
	<td>NO.#</td>
	<td>Name</td>
	<td>Surname</td>
	<td>Reg #</td>
	<td>Current Bal</td>
	<td>Del</td>
	<td>Block</td>
	<td>View Transactions</td>
</tr>
<?php

while($res=mysql_fetch_assoc($query)){
	$id=$res['id'];
	$reg = $res['reg_number'];
	$blocked_status = $res['blocked_status'];
	?>
		<tr>
			<td><?php echo $num; ?></td>
			<td><?php echo $res['name']; ?></td>
			<td><?php echo $res['surname']; ?></td>
			<td><?php echo $res['reg_number']; ?></td>
			<td><?php echo $res['current_balance']; ?></td>
			<?php
			echo '<td align ="left"><a href="delete_student.php?id='.$id.'"
	onclick="return confirm(\'Are you sure you want to delete this record?\')">
	[Click to delete]</a></td>';			
			?>
			<td>
				<?php echo '<a href="block_student.php?id='.$id.'">';
					if($res['blocked_status']== 'no'){echo 'Block';}else{echo 'UnBlock';}
				echo '</a>'; ?>
			</td>
			<td><?php echo '<a href="view_student_transactions.php?reg='.$reg.'">View Transactions</a>'; ?></td>
		</tr>
	<?php
	$num = $num +1;
}
?>
</table>
<body>
</body>
</html>
