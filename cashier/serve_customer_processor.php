<?php
include '../db_con.php';
session_start();

if(isset($_POST['submit'])){
	
	if(!empty($_POST['checked_food'])){
		//userhas selecte thing
		$username = mysql_real_escape_string($_POST['customer_username']);
		$isSaleMade = false;
		$total_price = 0;
		
		foreach($_POST['checked_food'] as $food) {
			//echo takeId($food).'<br/>';
			$isSaleMade = true;
			
			$food_name = $food;
			$price = getPrice($food);
			$quantity = $_POST[takeId($food)];
			$total = $price * $quantity;
			
			if(customerUsernameIsValid($username)){
				$total_price = $total_price + $total;
				sell($username,$food_name,$quantity,$total,$_SESSION['cashier']);
			}
			else{
				?>
				<script type="text/javascript">
				alert("Invalid Customer Username!!");
				window.location="serve_customer.php";
				</script>
				<?php
			}
		}
		
		//is sale made
		if($isSaleMade){
			?>
				<script type="text/javascript">
				alert("Sale succesfull Made!! \n Total Price is $ <?php echo $total_price; ?>");
				window.location="serve_customer.php";
				</script>
			<?php
		}
	}
	else{
		//user does not select anything
		echo 'no';
	}
}

function takeId($food_name){
	//error_reporting(0);
	$query = mysql_query("SELECT * FROM food WHERE name = '$food_name'");
	$det = mysql_fetch_assoc($query);

	return $det['id'];
}

function getPrice($food_name){
	//error_reporting(0);
	$query = mysql_query("SELECT * FROM food WHERE name = '$food_name'");
	$det = mysql_fetch_assoc($query);

	return $det['price'];
}

function customerUsernameIsValid($username){
	//error_reporting(0);
	$query = mysql_query("SELECT * FROM customer WHERE username = '$username'");
	$num = mysql_num_rows($query);
	
	if($num == 1){
		return true;
	}
	else{
		return false;
	}
}

function sell($customer_username,$food_name,$quantity,$total,$cashier_username){
	$sale_date = date("Y-m-d");
	$query = mysql_query("INSERT INTO sales (customer_username,food_name,quantity,total,sale_date,cashier_username) VALUES('$customer_username','$food_name','$quantity','$total','$sale_date','$cashier_username')");
	
	if(!$query){
		echo mysql_error();
	}
}
?>