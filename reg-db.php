<?php 
$login = strip_tags(trim($_POST['login'])); // Удаляет все лишнее и записываем значение в переменную
$name = strip_tags(trim($_POST['name']));
$pass = strip_tags(trim($_POST['pass'])); 

if(mb_strlen($login) == 0 || mb_strlen($name) == 0 || mb_strlen($pass) == 0){  //проверка на незаполненные поля
	echo "У вас есть незаполненные поля";
	exit();
}
if(mb_strlen($login) < 5 || mb_strlen($login) > 100){             //проверка на длину логина
	echo "Недопустимая длина логина";
	exit();
}




require "connect.php";
$result1 = mysqli_query($con,"SELECT * FROM `users` WHERE email = '$login'");
$user1 = mysqli_fetch_assoc($result1); 
if(!empty($user1)){
	echo "Данный логин уже используется!";         //проверка на существование данного логина
	exit();
}
$res = mysqli_query($con,"INSERT INTO users (email, password, username) VALUES('$login', '$pass', '$name')");

if ($res == 1) {     //отправка куки и перенос на страницу аккаунта
   session_start();
   $_SESSION['user']=mysqli_insert_id($con);
	// setcookie('user', , time() + 3600, "/");
	echo "<script>alert('Вы успешно зарегистрировались!');
	 location.href='account.php'</script>";}
// ввод данных в бд при успешной регистрации
?>