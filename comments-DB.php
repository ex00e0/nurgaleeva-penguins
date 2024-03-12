<?php
include "./connect.php";
session_start();
$comment = isset($_POST['comment_text'])?$_POST['comment_text']:false;
$id_new = isset($_POST['id_new'])?$_POST['id_new']:false;
$user_id = $_SESSION['user'];
if ($comment && $id_new) {$query = "INSERT INTO comments (news_id, user_id, comment_text) VALUES ($id_new, $user_id, '$comment')";
                          if (mysqli_query($con, $query)) {header("Location: /oneNew.php?new=$id_new");}
                        else echo "Ошибка добавления новости!";}
?>