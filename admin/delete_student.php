<?php
include('../db_con.php');
$id = $_REQUEST['id'];

$query = mysql_query("DELETE FROM students WHERE id = '$id'");

if($query){
?>
	<script type="text/javascript">
	alert("Student have been succesfully DELETED");
	window.location="view_students.php";
	</script>
<?php
}
else{
	echo mysql_error();
}
?>