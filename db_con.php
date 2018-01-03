<?php

$conn = mysql_connect('localhost','root','');
$db = mysql_select_db('canteen',$conn);
if(!$db)
{
	$error_sms = 'Failed to connect to the database due to ';
	echo $error_sms.' '. mysql_error();
}
?>