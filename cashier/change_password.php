<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tables.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<?php
	include '../db_con.php';
	session_start();
	$username = $_SESSION['cashier'];
	
	if(isset($_POST['change'])){
		$old = mysql_real_escape_string($_POST['old']);
		$new = mysql_real_escape_string($_POST['new']);
		$renew = mysql_real_escape_string($_POST['renew']);
		
		$query = mysql_query("SELECT * FROM admin WHERE username = '$username' AND password = '$old'");
		$row = mysql_num_rows($query);
		
		if($row != 1){
			?>
			<script language= 'javascript'>
			alert ('Incorrect Password'); 
			window.location=('change_password.php')</script>;
			<?php
		}
		else if($new != $renew){
			?>
			<script language= 'javascript'>
			alert ('New password and Re entered password must Match'); 
			window.location=('change_password.php')</script>;
			<?php
		}
		else if(strlen(trim($new)) < 7){
			?>
			<script language= 'javascript'>
			alert ('Password should contain at least 8 Characters'); 
			window.location=('change_password.php')</script>;
			<?php
		}
		else{
			// change
			
			$queryy = mysql_query("UPDATE admin SET password = '$new' WHERE username = '$username'");
			
			if(!$queryy){
				echo mysql_error();
			}
			else{
				?>
				<script language= 'javascript'>
				alert ('Password succsefully changed'); 
				window.location=('change_password.php')</script>;
				<?php
			}
		}
		
	}
?>
<form action="change_password.php" method="post">
	<table cellpadding="1" cellspacing="1" width="100%">
		<caption>Change Password</caption>
		<tr>
			<td>Enter Old Password</td>
			<td><input type="text" name="old" pattern="[A-Za-z']+" maxlength="20" required></td>
		</tr>
		<tr>
			<td>Enter New Password</td>
			<td><input type="password" name="new" pattern="[A-Za-z']+" maxlength="20" minlength="8" required></td>
		</tr>
		<tr>
			<td>Re-Enter New Password</td>
			<td><input type="password" name="renew" pattern="[A-Za-z']+" maxlength="20" minlength="8" required></td>
		</tr>
		<tr>
			<td></td>
			<td><input style="width:148px" id="static" type="submit" name="change" value="Change"></td>			
		</tr>
	</table>
</form>
</body>
</html>
