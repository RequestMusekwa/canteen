<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="main.css" type="text/css" rel="stylesheet"/>
<style>
	#main{ 
		height:350px;
	}
	
	#footer{
		height:100px;
	}

	caption{
		font-size:30px;
	}
	
	table{
		width:80%;
		margin-left:10%;
		margin-right:10%;
		background-color:#CCCCCC;
		border-radius:3px;
		padding-bottom:20px;
		padding-top:20px;
	}
</style>
</head>

<body>

<?php
include('db_con.php');

if(isset($_POST['submit'])){
	$name = mysql_real_escape_string($_POST['name']);
	$surname = mysql_real_escape_string($_POST['surname']);
	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$password1 = mysql_real_escape_string($_POST['password']);
	$password2 = mysql_real_escape_string($_POST['re_password']);
	
	createAcc($name,$surname,$username,$email,$password1,$password2);
}
?>
<div id="container">
	<div id="header">
		<img src="header.png" id="header_pic"/>
	</div>
	<div id="main">
<form action="create_account.php" method="post">
	<table>
	  <caption>
		Create Account
	  </caption>
  <tr>
    <td>Name</td>
    <td><label>
      <input type="text" name="name" required/>
    </label></td>
  </tr>
  <tr>
    <td>Surname</td>
    <td><label>
      <input type="text" name="surname" required/>
    </label></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><label>
      <input type="text" name="username" required/>
    </label></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><label>
      <input type="email" name="email" required/>
    </label></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><label>
      <input type="password" name="password" required/>
    </label></td>
  </tr>
  <tr>
    <td>Re-Password</td>
    <td><label>
        <input type="password" name="re_password" required/>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td align="right"><a href="index.html">Goto Home Page</a></td>
    <td><label>
      <input type="reset" name="Submit" value="RESET" />
    </label>
      <label>
      <input type="submit" name="submit" value="Create Acc" />
      </label></td>
  </tr>
</table>
</form>
<?php
function createAcc($name,$surname,$username,$email,$password1,$password2){
	//check weather details are correct
	//then update
	
	$query = mysql_query("SELECT * FROM suppliers WHERE name='$name' AND surname ='$surname' AND username ='$username' AND email ='$email' AND password =''");
	$row = mysql_num_rows($query);
	
	if(!$query){echo mysql_error();}
	
	if($row == 0){
		//details donot exists
		?>
			<script language= 'javascript'>
			alert ('Invalid Details make sure to be Added by the admin first'); 
			window.location=('create_account.php')</script>;
		<?php
	}
	else{
		
		if($password1 ===$password2){
		//UPDATE
			$query1 = mysql_query("UPDATE suppliers SET password ='$password1' WHERE username ='$username'");
			?>
			<script language= 'javascript'>
			alert ('Congradulations!! Account succesful Created'); 
			window.location=('create_account.php')</script>;
			<?php
		}
		else{
			?>
			<script language= 'javascript'>
			alert ('New password and Re entered password does not Match'); 
			window.location=('create_account.php')</script>;
			<?php
		}
	}
}
?>
	</div>
	<div id="footer">
		<li>Brainman Investments (Pvt)</li>
	</div>
</div>	
</body>
</html>
