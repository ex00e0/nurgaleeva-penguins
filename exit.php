<?php 

setcookie('user', $user['user_id'], time() - 3600, "/");
header('Location: /');

 ?>
