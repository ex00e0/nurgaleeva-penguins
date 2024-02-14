<?php 
include "connect.php"; 
?>
<?php
$newHeadline = isset($_POST["newHeadline"])?($_POST["newHeadline"]):false;
$newText = isset($_POST["newText"])?($_POST["newText"]):false;
$newImage = isset($_FILES["newImage"]["tmp_name"])?($_FILES["newImage"]):false;
$newCategory = isset($_POST["newCategory"])?($_POST["newCategory"]):false;
//получение данных из формы методом post

function check_error ($error) {return "<script> alert('$error'); 
    location.href='../admin'; </script>";}     
//функция вывода текста уведомления и перенос обратно на админ-панель

function check ($con, $newImage, $newHeadline, $newText, $newCategory) {$result=0;
    if ($newHeadline == false || $newText == false || $newImage['size'] == 0 || $newCategory == false) 
    {echo check_error('Все поля должны быть заполнены!'); }
    else if (mb_strlen($newHeadline)>20) {echo check_error('Название не должно превышать 20 символов!');}
//проверка на длину заголовка
 else if (gettype($newHeadline) != "string") {echo check_error('Ошибка в заголовке новости');} 

else if (gettype($newText) != "string") {echo check_error('Ошибка в тексте новости');} 

else if (substr($newImage["type"], 0, 5) != "image") {echo check_error('Пришла не картинка');} 
//проверки на типы данных в форме
else {$insert = "INSERT INTO news (image, title, content, category_id) VALUES ('$newImage[name]', '$newHeadline', '$newText','$newCategory')";        
//создание строки с запросом на вставку в таблицу news из 3 значений
    $result = mysqli_query($con, $insert);
    if ($result) {move_uploaded_file($newImage["tmp_name"], "images/news/$newImage[name]");
    //перенос загруженного в форму файла в отдельную папку для новостей 
        echo check_error("Новость успешно создана");}
    else echo check_error("Произошла ошибка:". mysqli_error($con)); }  
return $result;   }
check($con, $newImage, $newHeadline, $newText, $newCategory);

?>
