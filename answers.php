<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<title>Результаты</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
</head>
<body>
<?php
session_start();
$js = $_POST['valueJs'];   //получение значения скрытого input
if ($js == "Время вышло. Ответы не будут зачтены.") {echo "Вы не уложились в срок, поэтому ответы не были зачтены. Попробуйте снова.";}
else {
for ($u=0;$u<=4;$u++) {$no=$u+1;  $user = $_POST["task$u"];  
     //сравнение ответов пользователя, полученных через $_POST и ответов системы, полученных через $_SESSION
                        $res = $_SESSION["session $u"][1];
                        if($_POST["task$u"]==$_SESSION["session $u"][1]) {echo "$no ответ <font color='green'> верный. </font> Ваш ответ: $user <br>";} 
                        else {echo "$no ответ <font color='red'>не верный.</font> Правильный ответ: $res  Ваш ответ: $user <br>";} }
    }
?>
</body>
</html>