<?php
include "connect.php";

$name = isset($_POST["name"])?($_POST["name"]):false;
$login = isset($_POST["login"])?($_POST["login"]):false;
$password= isset($_POST["password"])?($_POST["password"]):false;
//получение данных из формы методом post
session_start();
$user_id = $_SESSION['user'];
$user_info = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE user_id=$user_id"));
//выборка пользователя с нужным id
function check_error ($error) {return "<script> alert('$error'); 
    location.href='../account.php'; </script>";}                              
$query_update = "UPDATE users SET ";
$check_update = false; 
//переменная для проверки актуальности данных (если false, то ничего не изменится, те же данные в бд не отправятся)
if ($user_info["username"] != $name) {$query_update .= "username = '$name', "; 
                                   $check_update = true;}
if ($user_info["password"] != $password) {$query_update .= "password = '$password', ";
    $check_update = true;}
if ($user_info["email"] != $login) {
    if (mb_strlen($login) < 5 || mb_strlen($login) > 100) {echo check_error("Перепроверьте логин. Остальные данные обновлены");}
    else {$query_update .= "login = $login, ";
    $check_update = true; } }
//добавление заполненных полей к строке запроса, если они не пустые
if ($check_update) {$query_update = substr($query_update, 0, -2); 
    //убираются запятая и пробел в конце
                    $query_update .= " WHERE user_id = $user_id";
                    $result = mysqli_query($con, $query_update);
                     if ($result) {echo check_error("Данные обновлены!");}
                     else echo check_error("Ошибка обновления!".mysqli_error($con));}
else {echo check_error("Данные актуальны!");}
//занесение данных в бд
?>