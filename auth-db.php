<?php

$login = strip_tags(trim($_POST['login']));          //очищение от лишних символов
$pass = strip_tags(trim($_POST['pass']));
require "connect.php";
$userEmail = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE email='$login'"));        
//получение совпадений введенных данных с базой данных по логину
$userPass = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE password='$pass'"));
//получение совпадений введенных данных с базой данных по паролю


if(!isset($userEmail) && !isset($userPass)){     //если оба массива пустые
	echo "Такой пользователь не найден.";
	exit();
}
else if(!isset($userEmail) || !isset($userPass)){    //если только один из массивов пустой
	echo "Логин или пароль введены неверно";
	exit();
}



setcookie('user', $userEmail['user_id'], time() + 3600, "/");     //отправка куки и перенос на страницу аккаунта

setcookie('name', $userEmail['username'], time() + 3600, "/");

header('Location: account.php');

?>