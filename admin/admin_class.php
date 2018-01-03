<?php
include("../person_class.php");

class Admin extends Person{
	var $id_number;
	var $phone_number;
	var $address;
	
	function __construct($username){
		$query = "SELECT * FROM admin WHERE username = '$username'";
		$results = mysql_fetch_assoc(mysql_query($query));
		$this->id_number = $results['id_number'];
		$this->phone_number = $results['phone'];
		$this->address = $results['address'];
		
		//these are already present in the person class
		$this->name = $results['name'];
		$this->surname = $results['surname'];
		$this->password = $results['password'];
		$this->id = $results['id'];
	}
	
	function addStudent($reg,$name,$surname,$level,$faculty,$prog){
	//check if reg number exists 
	//add the student
		
		$query0 = mysql_query("SELECT * FROM students WHERE reg_number = '$reg'");
		$rows = mysql_num_rows($query0);
	
		if($rows > 0){
			return false;
		}
		else{
			$query = mysql_query("INSERT INTO students (name,surname,reg_number,level,faculty,programme) VALUES('$name','$surname','$reg','$level','$faculty','$prog')");
			
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
	}
}
?>
