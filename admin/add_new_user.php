<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="tables.css" type="text/css" rel="stylesheet"/>
<style>
	input[type="text"]{
		width:187px;
	}
	
	input[type="reset"], input[type="submit"]{
		width:91px;
		color:red;
		float:none;
	}
	
	input[type="reset"]{
		margin-left:55px;
	}
</style>
</head>

<body>
<?php
include('admin_class.php');
session_start();
$username = $_SESSION['admin'];

$admin = new Admin($username);

if(isset($_POST['submit'])){
	
	if(strlen($_POST['name']) < 3 && strlen($_POST['surname']) < 3){
		?>
			<script type="text/javascript">
			alert("A name and surname should contain at least 3 characters");
			window.location="add_new_user.php";
			</script>
		<?php
	}
	elseif(!is_numeric($_POST['level']) || $_POST['level'] > 5.3 || $_POST['level'] < 1.1){
		?>
			<script type="text/javascript">
			alert("The Student level should be between 1.1 and 5.3");
			window.location="add_new_user.php";
			</script>
		<?php
	}
	elseif(strlen($_POST['programme'])<3){
		?>
			<script type="text/javascript">
			alert("A Programme name should contain at least 3 characters");
			window.location="add_new_user.php";
			</script>
		<?php
	}
	elseif(strlen($_POST['reg_number'])<7 || $_POST['reg_number'] > 9){
		?>
			<script type="text/javascript">
			alert("A REG # should contain characters between 7 and 9");
			window.location="add_new_user.php";
			</script>
		<?php
	}
	else{
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$level = $_POST['level'];
		$prog = $_POST['programme'];
		$faculty = $_POST['faculty'];
		$reg_number = $_POST['reg_number'];
		
		$is_add = $admin->addStudent($reg_number,$name,$surname,$level,$faculty,$prog);
		
		if($is_add){
		?>
			<script type="text/javascript">
			alert("Student successful added");
			window.location="add_new_user.php";
			</script>
		<?php
		}
		else{
		?>
			<script type="text/javascript">
			alert("REG # is already in use.");
			window.location="add_new_user.php";
			</script>
		<?php
		}
	}
}
?>
<form id="form1" name="form1" method="post" action="add_new_user.php">
  <table>
    <caption>
      Add New Student
    </caption>
    <tr>
      <td>Name</td>
      <td><label>
        <input type="text" name="name" maxlength="25" pattern="[A-Za-z']+" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" required/>
      </label></td>
    </tr>
    <tr>
      <td>Surname</td>
      <td><label>
		<input type="text" name="surname" maxlength="25" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];}?>" pattern="[A-Za-z']+" required/>
      </label></td>
    </tr>
    <tr>
      <td>REG # </td>
      <td><label>
        <input type="text" name="reg_number" pattern="[A-Za-z0-9]+" value="<?php if(isset($_POST['reg_number'])){echo $_POST['reg_number'];}?>" maxlength="10" required/>
      </label></td>
    </tr>
    <tr>
      <td>Faculty</td>
      <td><label>
        <select name="faculty">
			<option value="science and technology">Faculty of Sciences and Tech</option>
			<option value="social sciences">Faculty of Social Sciences</option>
			<option value="arts">Faculty of Arts</option>
			<option value="commerce">Faculty of Commerce</option>
			<option value="medicine">Faculty of Medicine</option>
			<option value="natural sciences">Faculty of Natural Sciences</option>
			<option value="law">Faculty of Law</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Programme</td>
      <td><label>
        <input type="text" name="programme" value="<?php if(isset($_POST['programme'])){echo $_POST['programme'];}?>" maxlength="30" pattern="[A-Z a-z]+" required/>
      </label></td>
    </tr>
    <tr>
      <td>Level</td>
      <td><label>
        <input type="text" name="level" value="<?php if(isset($_POST['level'])){echo $_POST['level'];}?>" maxlength="3" pattern="[0-9.]+" required/>
      </label></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td>
	  	<input type="reset" name="res" value="RESET"/>
        <input type="submit" name="submit" value="Submit"/>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
