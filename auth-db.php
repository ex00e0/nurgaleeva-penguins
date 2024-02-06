<?php

$login = strip_tags(trim($_POST['login']));
$pass = strip_tags(trim($_POST['pass']));
require "connect.php";
$userEmail = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE email='$login'"));
$userPass = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE password='$pass'"));
if(!isset($userEmail) && !isset($userPass)){
	echo "Такой пользователь не найден.";
	exit();
}
else if(!isset($userEmail) || !isset($userPass)){
	echo "Логин или пароль введены неверно";
	exit();
}

setcookie('user', $userEmail['user_id'], time() + 3600, "/");

setcookie('name', $userEmail['username'], time() + 3600, "/");

header('Location: account.php');

?>