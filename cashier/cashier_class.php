<?php
include("../person_class.php");

class Cashier extends Person{
	var $username;
	var $type;
	
	function __construct($username){
		$query = mysql_query("SELECT * FROM admin WHERE username = '$username'");
		$details = mysql_fetch_assoc($query);
		$this->username = $details['username'];
		$this->type = $details['type'];
		
		$this->name = $details['name'];
		$this->surname = $details['surname'];
		$this->password = $details['password'];		
	}
}
?>