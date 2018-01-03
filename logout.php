<?php
session_start();

if(isset($_SESSION['student'])){
	unset($_SESSION['student']);
	header('location:index.html');
}
elseif(isset($_SESSION['admin'])){
	unset($_SESSION['admin']);
	header('location:index.html');
}
else{
	header('location:index.html');
}
?>