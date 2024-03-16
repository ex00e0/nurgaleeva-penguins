<?php 
require "connect.php";
$news = mysqli_query($con, "select * from news");
?>
<?php include ( "date.php"); ?>
<?php 
include "connect.php";                 //выражение include включает и выполняет указанный файл
$query_get_category = "SELECT * FROM categories ";
$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category));       //получаем результат запроса из переменной query_get_category
//и преобразуем его в двумерный массив, где каждый элемент - это массив с построчным получением кортежей из таблицы результата запроса
$news = mysqli_query($con, "select * from news");
$new_id = isset($_GET['new'])?$_GET['new']:false;
if ($new_id) {
$queryNewId = "SELECT * FROM news WHERE news_id='$new_id'";
$queryNewId = mysqli_fetch_all(mysqli_query($con, $queryNewId));
//получение id выбранной новости, выборка данной новости и преобразование в массив


$comments_result = mysqli_query($con, 
"SELECT comment_text, comment_date, username from comments inner join 
users on users.user_id=comments.user_id WHERE news_id=$new_id");   
$comments = mysqli_fetch_all($comments_result); }
//получение комментариев из бд
else {header("Location: /");}
$monthC = ["01" => "Января", "02" => "Февраля", "03" => "Марта", "04" => "Апреля", "05" => "Мая",
"06" => "Июня", "07" => "Июля", "08" => "Августа", "09" => "Сентября", "10" => "Октября", "11" => "Ноября", "12" => "Декабря"];
//массив месяцев
function date_new($date_old) {global $monthC;  
  //получение массива месяцев внутри функции
                              $date = date("d.m.Y H:i:s", strtotime($date_old));
    //преобразование даты из mysql в php
                              return substr($date, 0, 2)." ".$monthC[substr($date, 3,2)]." ".substr($date, 6);}
    //возврат даты в нужном формате

session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
   <link href="css/style.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новость</title>
</head>
<body>

<header>
  <div id="firstLine">
    <div id="menuBlock">
        <svg id="menu" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 14H0V12H18V14ZM12 8H0V6H12V8ZM0 2V0H18V2H0Z" fill="#BCBFC2"/>
        </svg>
        <div id="sections">Секции</div>
    </div>
    <svg id="iconSearch" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4354 16.3951L13.146 11.9395C14.2489 10.6301 14.8532 8.98262 14.8532 7.26749C14.8532 3.26026 11.5888 0 7.57659 0C3.56433 0 0.299988 3.26026 0.299988 7.26749C0.299988 11.2747 3.56433 14.535 7.57659 14.535C9.08284 14.535 10.5182 14.0812 11.7454 13.2199L16.0674 17.7093C16.2481 17.8967 16.4911 18 16.7514 18C16.9979 18 17.2317 17.9062 17.4092 17.7355C17.7863 17.3731 17.7983 16.7721 17.4354 16.3951ZM7.57659 1.89587C10.5423 1.89587 12.9549 4.30552 12.9549 7.26749C12.9549 10.2295 10.5423 12.6391 7.57659 12.6391C4.6109 12.6391 2.19823 10.2295 2.19823 7.26749C2.19823 4.30552 4.6109 1.89587 7.57659 1.89587Z" fill="#BCBFC2"/>
    </svg>
    <div id="search" style='align-self:center;'>Поиск</div>
    <div id="subscribeBlock"></div>
    <a href="<?=($_SESSION['user'])?'/account.php':'';?>" id="iconSignIn">
    <svg viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M16 15.6316C14.3675 17.2105 11.7008 18 8 18C4.29917 18 1.63251 17.2105 0 15.6316C0 12.3481 1.90591 9.98316 4.70588 9C5.60059 9.41686 6.59455 10 8 10C9.40545 10 10.3311 9.39256 11.2941 9C14.0575 9.99655 16 12.3748 16 15.6316ZM8 8C5.79086 8 4 6.20914 4 4C4 1.79086 5.79086 0 8 0C10.2091 0 12 1.79086 12 4C12 6.20914 10.2091 8 8 8Z" fill="#BCBFC2"/>
    </svg>
    </a>
    <div id="signIn"><a href="<?=($_SESSION['user'])?'/exit.php':'/auth.php';?>"><?=($_SESSION['user'])?'Выйти':'Войти';?></a></div>
  </div>
  <div id="secondLine">
     <div id="nameCompany"><a href='/'>Пингвины</a></div>
     <div id="date"><?php echo date("$week, $month d, 20y"); ?></div>
     <svg id="tempIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M9 15.4763C9.4151 15.4763 9.74939 15.8106 9.74939 16.2257V17.2506C9.74939 17.6657 9.4151 18 9 18C8.5849 18 8.25061 17.6657 8.25061 17.2506V16.2257C8.25061 15.8106 8.5849 15.4763 9 15.4763ZM9 2.52367C8.5849 2.52367 8.25061 2.18939 8.25061 1.77429V0.749388C8.25061 0.334286 8.5849 0 9 0C9.4151 0 9.74939 0.334286 9.74939 0.749388V1.77429C9.74939 2.18939 9.4151 2.52367 9 2.52367ZM17.2506 8.25061C17.6657 8.25061 18 8.5849 18 9C18 9.4151 17.6657 9.74939 17.2506 9.74939H16.2257C15.8106 9.74939 15.4763 9.4151 15.4763 9C15.4763 8.5849 15.8106 8.25061 16.2257 8.25061H17.2506ZM1.77429 8.25061C2.18939 8.25061 2.52367 8.5849 2.52367 9C2.52367 9.4151 2.18939 9.74939 1.77429 9.74939H0.749388C0.334286 9.74939 0 9.4151 0 9C0 8.5849 0.334286 8.25061 0.749388 8.25061H1.77429ZM14.6388 4.42286C14.3449 4.71306 13.871 4.71673 13.5771 4.42286C13.2833 4.12898 13.2833 3.6551 13.5771 3.36122L14.3008 2.63755C14.5947 2.34367 15.0686 2.34367 15.3624 2.63755C15.6563 2.93143 15.6563 3.40531 15.3624 3.69918L14.6388 4.42286ZM3.36122 13.5771C3.6551 13.2869 4.12898 13.2833 4.42286 13.5771C4.71673 13.871 4.71673 14.3449 4.42286 14.6388L3.69918 15.3624C3.40531 15.6563 2.93143 15.6563 2.63755 15.3624C2.34367 15.0686 2.34367 14.5947 2.63755 14.3008L3.36122 13.5771ZM14.6388 13.5771L15.3624 14.3008C15.6563 14.5947 15.6563 15.0686 15.3624 15.3624C15.0686 15.6563 14.5947 15.6563 14.3008 15.3624L13.5771 14.6388C13.2833 14.3449 13.2833 13.871 13.5771 13.5771C13.871 13.2833 14.3449 13.2833 14.6388 13.5771ZM3.36122 4.42286L2.63755 3.69918C2.34367 3.40531 2.34367 2.93143 2.63755 2.63755C2.93143 2.34367 3.40531 2.34367 3.69918 2.63755L4.42286 3.36122C4.71673 3.6551 4.71673 4.12898 4.42286 4.42286C4.12898 4.71673 3.6551 4.71673 3.36122 4.42286ZM9 3.36122C12.1078 3.36122 14.6388 5.89224 14.6388 9C14.6388 12.1114 12.1078 14.6388 9 14.6388C5.88857 14.6388 3.36122 12.1078 3.36122 9C3.36122 5.88857 5.89224 3.36122 9 3.36122ZM9 13.1363C11.2812 13.1363 13.1363 11.2812 13.1363 9C13.1363 6.71878 11.2812 4.86367 9 4.86367C6.71878 4.86367 4.86367 6.71878 4.86367 9C4.86367 11.2812 6.71878 13.1363 9 13.1363Z" fill="#BCBFC2"/>
    </svg>      
     <div id="temp">-20 °C</div>
  </div>
  <div id="thirdLine">
    <div id="catBlock">
    <?php foreach ($categories as $category) {echo"<div><a href='index.php?category=$category[0]'>$category[1]</a></div>";} ?>
       <!-- <div>НОВОСТИ</div>
       <div>МНЕНИЯ</div>
       <div>НАУКА</div>
       <div>ЖИЗНЬ</div>
       <div>ПУТЕШЕСТВИЯ</div>
       <div>ДЕНЬГИ</div>
       <div>ИСКУСCТВО</div>
       <div>СПОРТ</div>
       <div>ЛЮДИ</div>
       <div>ЗДОРОВЬЕ</div>
       <div>ОБРАЗОВАНИЕ</div> -->
    </div>
  </div>
</header>
<div class="void"></div>
<div class="void2"></div>
<main>
    <section class="last-news">
        <div class="cont">
        <?php
        function dateRev ($pub_date) {$phpdate = strtotime ( $pub_date ); //преобразование даты из базы данных в формат даты php
                                      $month = date('m');
                                      $monthArr = ["01"=>'Января', "02"=>'Февраля', "03"=>'Марта', "04"=>'Апреля', 
      "05"=>'Мая', "06"=>'Июня', "07"=>'Июля', "08"=>'Августа', "09"=>'Сентября', "10"=>'Октября', "11"=>'Ноября', "12"=>'Декабря',];
                                      foreach ($monthArr as $keys => $names) {if ($keys==$month) {$month=$names;
                                                                                                  break;} }
                              //изменение цифры месяца на русское название
                                      return date ( "d"." $month "."Y H:i:s" , $phpdate );}
              //возврат даты в необходимом формате
                foreach($queryNewId as $new){
                    echo "<div id='headlineGrid'>
                    <div id='headlineForm'>$new[2]</div>
                     </div> <br>";
                    echo "<img src='images/news/$new[1]' style='margin-left:150px; width:500px'>";
                    echo "<p style='margin-left:150px; color:#4B5157;'>$new[3]</p>";
                    $pub_date = $new[5];
                    $pub_date = dateRev($pub_date);
                    echo "<p style='margin-left:150px; color:#4B5157;'><i>$pub_date</i></p>";
                    $cat_id = $new[4]-1;
                    echo "<p style='margin-left:150px; color:#4B5157;'>Категория:<b>". $categories[$cat_id][1]."</b></p>";
                }
              //вывод подробной информации о новости с обращением к элементам массива
            ?>
            <div class="void"></div>
            <div class="void2"></div>
            <div id='headlineGrid'>
                    <div id='headlineForm'>Комментарии</div>
                     </div> <br> <img src='images/free-icon-comment-4074994.png' id='commImg'>
                     <?php $numberComm = mysqli_num_rows($comments_result);
                      echo "<p class='disinblock'><i> $numberComm </i></p>"; 
                      //вывод количества комментариев
                      ?><br><br> 
                     <?php if ($_SESSION['user']) {
                      //ограничение возможности добавления комментариев только для зарегистрированных пользователей ?>
                    <form class='w-100' action='comments-DB.php' method='post'>
                      <input type='hidden' name='id_new' value=<?=$new_id?>>
                      <!--передача id новости в скрытом input-->
                      <div class='mb-3 d-flex w-50'>
                        <label for='comment-text' class='form-label' id='lablab'>Напишите комментарий</label>
                        <br><input type='text' class='form-control' id='comment-text' name='comment_text'>
                       <div class='emptyNothing'></div>
                        <button type='submit' class='btn mb-3 btn-primary mt-3'>Отправить</button>
                      </div>
                    </form>
                  <?php  } ?>



              <?php if (mysqli_num_rows($comments_result)) { 
                //проверка на наличие комментариев в бд
                foreach ($comments as $comment) {?> <div class='card'>
                  <div class='card-body'> 
                    <div class='card-header'><?=date_new($comment[1]);?></div><br>
                    <h6 class='card-subtitle mb-2 text-body-secondary'><?=$comment[2]?></h6>
                    <p class='card-text'><?=$comment[0]?></p></div>
                </div>  <br> <?php }
                ?> 
                <?php } else echo "<p class='marginLEFT'><i>Комментариев пока нет!</i></p>"?>
        </div>
    </section>
</main>
</body>
</html>