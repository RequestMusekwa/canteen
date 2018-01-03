<?php
include('../db_con.php');
$id = $_REQUEST['id'];

$query = mysql_query("DELETE FROM food WHERE id = '$id'");

if($query){
?>
	<script type="text/javascript">
	alert("Food have been succesfully DELETED");
	window.location="add_new_food.php";
	</script>
<?php
}
else{
	echo mysql_error();
}
?>