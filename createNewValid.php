<?php 
include "connect.php"; 
?>
<?php
$newHeadline = isset($_POST["newHeadline"])?($_POST["newHeadline"]):false;
$newText = isset($_POST["newText"])?($_POST["newText"]):false;
$newImage = isset($_FILES["newImage"]["tmp_name"])?($_FILES["newImage"]):false;
$newCategory = isset($_POST["newCategory"])?($_POST["newCategory"]):false;

function check_error ($error) {return "<script> alert('$error'); 
    location.href='createNew.php'; </script>";}

function check ($con, $newImage, $newHeadline, $newText, $newCategory) {$result=0;
    if ($newHeadline == false || $newText == false || $newImage['size'] == 0 || $newCategory == false) {echo check_error('Все поля должны быть заполнены!'); }
    else if (mb_strlen($newHeadline)>20) {echo check_error('Название не должно превышать 20 символов!');}

 else if (gettype($newHeadline) != "string") {echo check_error('Ошибка в заголовке новости');} 

else if (gettype($newText) != "string") {echo '<script> alert("Ошибка в типах данных текста новости"); </script>';} 

else if (substr($newImage["type"], 0, 5) != "image") {echo '<script> alert("Пришла не картинка"); </script>';} 

else {$insert = "INSERT INTO news (image, title, content, category_id) VALUES ('$newImage[name]', '$newHeadline', '$newText','$newCategory')";
    $result = mysqli_query($con, $insert);
    if ($result) {move_uploaded_file($newImage["name"], "images/news/$newImage[name]");
        check_error("Новость успешно создана");}
    else check_error("Произошла ошибка:". mysqli_error($con)); }  
return $result;   }
if (check($con, $newImage, $newHeadline, $newText, $newCategory)) {echo "Отправлено в БД";}
else {echo "Не отправлено в БД. Перепроверьте введенные данные.";}



//создание строки с запросом на вставку в таблицу news из 3 значений Image title description
?>
