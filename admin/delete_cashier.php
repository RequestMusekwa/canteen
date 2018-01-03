<?php
include('../db_con.php');
$id = $_REQUEST['id'];

$query = mysql_query("DELETE FROM admin WHERE id = '$id'");

if($query){
?>
	<script type="text/javascript">
	alert("Cashier have been succesfully DELETED");
	window.location="add_new_cashier.php";
	</script>
<?php
}
else{
	echo mysql_error();
}
?>