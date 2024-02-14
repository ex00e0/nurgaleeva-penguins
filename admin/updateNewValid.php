<?php
include "../connect.php";

$title = isset($_POST["newHeadline"])?($_POST["newHeadline"]):false;
$text = isset($_POST["newText"])?($_POST["newText"]):false;
$file = ($_FILES["newImage"]["size"]!=0)?($_FILES["newImage"]):false;
$category_id= isset($_POST["newCategory"])?($_POST["newCategory"]):false;
//получение данных из формы методом post
$id_new= isset($_POST["id"])?($_POST["id"]):false;
$new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM news WHERE news_id=$id_new"));
//выборка новости с нужным id
function check_error ($error, $id_new) {return "<script> alert('$error'); 
    location.href='../admin?new=$id_new'; </script>";}                              
$query_update = "UPDATE news SET ";
$check_update = false; 
//переменная для проверки актуальности данных (если false, то ничего не изменится, те же данные в бд не отправятся)
if ($new_info["title"] != $title) {$query_update .= "title = '$title', "; 
                                   $check_update = true;}
if ($new_info["content"] != $text) {$query_update .= "content = '$text', ";
    $check_update = true;}
if ($new_info["category_id"] != $category_id) {$query_update .= "category_id = $category_id, ";
    $check_update = true;}
if ($file) {$query_update .= "image =".$file['name'].", ";
    $check_update = true;
            move_uploaded_file($file["tmp_name"], "../images/news/$file[name]");}
//добавление заполненных полей к строке запроса, если они не пустые
if ($check_update) {$query_update = substr($query_update, 0, -2); 
    //убираются запятая и пробел в конце
                    $query_update .= " WHERE news_id = $id_new";
                    $result = mysqli_query($con, $query_update);
                     if ($result) {echo check_error("Данные обновлены!", $id_new);}
                     else echo check_error("Ошибка обновления!".mysqli_error($con), $id_new);}
else {echo check_error("Данные актуальны!", $id_new);}
//занесение данных в бд
?>