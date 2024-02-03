<?php

$login = strip_tags(trim($_POST['login']));
$pass = strip_tags(trim($_POST['pass']));
require "connect.php";
$user = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE password='$pass' AND email='$login'"));
// var_dump($user);
if(count($user) == 0){
	echo "Такой пользователь не найден.";
	exit();
}
else if(count($user) == 1){
	echo "Логин или пароль введены неверно";
	exit();
}

setcookie('user', $user['user_id'], time() + 3600, "/");

header('Location: page.html');

?>