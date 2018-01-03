<?php
include('../db_con.php');
$id = $_REQUEST['id'];

$query = mysql_query("DELETE FROM customer WHERE username = '$id'");
if(!$query){echo mysql_error();}
if($query){
?>
	<script type="text/javascript">
	alert("Customer have been succesfully DELETED");
	window.location="view_customers.php";
	</script>
<?php
}
else{
	echo mysql_error();
}
?>