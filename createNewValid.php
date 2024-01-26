<?php 
include "connect.php"; 
?>
<?php
$newHeadline = $_POST["newHeadline"];
$newText = $_POST["newText"];
$newImage = $_FILES["newImage"];
$newCategory = $_POST["newCategory"];
function check ($con, $newImage, $newHeadline, $newText, $newCategory) {$result=0;
    if ($newHeadline == "" || $newText == "" || $newImage['size'] == 0 || $newCategory == "") {echo '<script> alert("Не все поля заполнены"); </script>';}
    else if (mb_strlen($newHeadline)>20) {echo '<script> alert("Слишком длинное название"); </script>';}

 else if (gettype($newHeadline) != "string") {echo '<script> alert("Ошибка в типах данных текста заголовка"); </script>';} 

else if (gettype($newText) != "string") {echo '<script> alert("Ошибка в типах данных текста новости"); </script>';} 

else if (substr($newImage["type"], 0, 5) != "image") {echo '<script> alert("Пришла не картинка"); </script>';} 

else {$insert = "INSERT INTO news (image, title, content, category_id) VALUES ('$newImage[name]', '$newHeadline', '$newText','$newCategory')";
    $result = mysqli_query($con, $insert);}  
return $result;   }
if (check($con, $newImage, $newHeadline, $newText, $newCategory)) {echo "Отправлено в БД";}
else {echo "Не отправлено в БД. Перепроверьте введенные данные.";}



//создание строки с запросом на вставку в таблицу news из 3 значений Image title description
?>
