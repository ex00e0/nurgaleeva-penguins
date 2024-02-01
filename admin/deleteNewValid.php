<?php
include "../connect.php";
function check_error ($error) {return "<script> alert('$error'); 
    location.href='../admin'; </script>";}
$id_new = isset($_GET["new"])?$_GET["new"]:false;
if ($id_new) {$new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM news WHERE news_id=$id_new")); }
if ($new_info) {$query_delete = mysqli_query($con,"DELETE FROM news WHERE news_id=$id_new");
                 if ($query_delete) {echo check_error("Новость удалена!"); }
                    else {echo check_error("Ошибка удаления новости: ". mysqli_error($con)); } }


?>