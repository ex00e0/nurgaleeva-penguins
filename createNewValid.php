<?php 
include "connect.php"; 
?>
<?php
$newHeadline = $_POST["newHeadline"];
$newText = $_POST["newText"];
$newImage = $_FILES["newImage"];
$newCategory = $_POST["newCategory"];
// var_dump(gettype($newHeadline) == "string");
// if ($newHeadline == "" || $newText == "" || $newImage['size'] == 0 || $newCategory == "") {echo '<script> alert("Не все поля заполнены"); </script>';}
// if (mb_strlen($newHeadline)>20) {echo '<script> alert("Слишком длинное название"); </script>';}

//  if (gettype($newHeadline) == "string") {echo '<script> alert("тип данных заголовка верный"); </script>';} else {echo '<script> alert("Ошибка в типах данных текста заголовка"); </script>';}

// if (gettype($newText) == "string") {echo '<script> alert("тип данных текста новости верный"); </script>';} else {echo '<script> alert("Ошибка в типах данных текста новости"); </script>';}

// if ($newImage["type"] == "image/jpeg" ||  $newImage["type"] == "image/jpg" || $newImage["type"] == "image/png") {echo '<script> alert("Пришла картинка"); </script>';} else {echo '<script> alert("Пришла не картинка..."); </script>';}
$insert = "INSERT INTO news (image, title, content, category_id) VALUES ('$newImage[name]', '$newHeadline', '$newText','$newCategory')";
$result = mysqli_query($con, $insert);

//создание строки с запросом на вставку в таблицу news из 3 значений Image title description
?>
