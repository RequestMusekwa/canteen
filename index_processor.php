<?php
session_start();
include("db_con.php");

if(isset($_POST['admin_submit'])){
	$admin_username = mysql_real_escape_string($_POST['admin_username']);
	$admin_password = mysql_real_escape_string($_POST['admin_password']);
	
	$admin_query = mysql_query("SELECT * FROM admin WHERE username = '$admin_username' AND password = '$admin_password' AND type ='admin'");
	$admin_row = mysql_num_rows($admin_query);
	
	if($admin_row == 1){
		$_SESSION['admin'] = $admin_username;
		header('location:admin/admin_page.php');
	}
	else{
		?>
		<script type="text/javascript">
		alert("Invalid Username or Password !!!");
		window.location="index.html";
		</script>
		<?php
	}
}
else if(isset($_POST['student_submit'])){
	$student_reg_number = mysql_real_escape_string($_POST['student_reg_number']);
	$student_password = mysql_real_escape_string($_POST['student_password']);
	
	$student_query = mysql_query("SELECT * FROM admin WHERE username = '$student_reg_number' AND password = '$student_password' AND type ='cashier'");
	$student_row = mysql_num_rows($student_query);
	
	if($student_row == 1){
		$_SESSION['cashier'] = $student_reg_number;
		header('location:cashier/cashier.php');
	}
	else{
		?>
		<script type="text/javascript">
		alert("Invalid Username or Password !!!");
		window.location="index.html";
		</script>
		<?php
	}
}
else{

}
?>