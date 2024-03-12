<?php 
session_start();
session_destroy();
// setcookie('user', $user['user_id'], time() - 3600, "/");  
// setcookie('name', $userEmail['username'], time() - 3600, "/");
//удаление куки и возвращение на index.php
header('Location: /');

 ?>
