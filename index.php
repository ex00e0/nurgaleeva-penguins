<?php 
include "connect.php";                 //выражение include включает и выполняет указанный файл
$query_get_category = "SELECT * FROM categories ";
$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category));       //получаем результат запроса из переменной query_get_category
//и преобразуем его в двумерный массив, где каждый элемент - это массив с построчным получением кортежей из таблицы результата запроса
$news = mysqli_query($con, "select * from news");


$category_get = isset($_GET['category'])?$_GET['category']:false;      
    //получение значения category из url-строки с помощью массива $_GET

?>
<?php include ( "date.php"); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<link href="css/style.css" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>index</title>
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
    <div id="search">Поиск</div>
    <div id="subscribeBlock"></div>
    <svg id="iconSignIn" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M16 15.6316C14.3675 17.2105 11.7008 18 8 18C4.29917 18 1.63251 17.2105 0 15.6316C0 12.3481 1.90591 9.98316 4.70588 9C5.60059 9.41686 6.59455 10 8 10C9.40545 10 10.3311 9.39256 11.2941 9C14.0575 9.99655 16 12.3748 16 15.6316ZM8 8C5.79086 8 4 6.20914 4 4C4 1.79086 5.79086 0 8 0C10.2091 0 12 1.79086 12 4C12 6.20914 10.2091 8 8 8Z" fill="#BCBFC2"/>
    </svg>
    <div id="signIn"><a href='/auth.php'>Войти</a></div>
  </div>
  <div id="secondLine">
     <div id="nameCompany"><a href='/'>Пингвины</a></div>        <!--сброс фильтра по нажатию на ссылку-->
     <div id="date"><?php echo date("$week, $month d, 20y"); ?></div>
     <svg id="tempIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M9 15.4763C9.4151 15.4763 9.74939 15.8106 9.74939 16.2257V17.2506C9.74939 17.6657 9.4151 18 9 18C8.5849 18 8.25061 17.6657 8.25061 17.2506V16.2257C8.25061 15.8106 8.5849 15.4763 9 15.4763ZM9 2.52367C8.5849 2.52367 8.25061 2.18939 8.25061 1.77429V0.749388C8.25061 0.334286 8.5849 0 9 0C9.4151 0 9.74939 0.334286 9.74939 0.749388V1.77429C9.74939 2.18939 9.4151 2.52367 9 2.52367ZM17.2506 8.25061C17.6657 8.25061 18 8.5849 18 9C18 9.4151 17.6657 9.74939 17.2506 9.74939H16.2257C15.8106 9.74939 15.4763 9.4151 15.4763 9C15.4763 8.5849 15.8106 8.25061 16.2257 8.25061H17.2506ZM1.77429 8.25061C2.18939 8.25061 2.52367 8.5849 2.52367 9C2.52367 9.4151 2.18939 9.74939 1.77429 9.74939H0.749388C0.334286 9.74939 0 9.4151 0 9C0 8.5849 0.334286 8.25061 0.749388 8.25061H1.77429ZM14.6388 4.42286C14.3449 4.71306 13.871 4.71673 13.5771 4.42286C13.2833 4.12898 13.2833 3.6551 13.5771 3.36122L14.3008 2.63755C14.5947 2.34367 15.0686 2.34367 15.3624 2.63755C15.6563 2.93143 15.6563 3.40531 15.3624 3.69918L14.6388 4.42286ZM3.36122 13.5771C3.6551 13.2869 4.12898 13.2833 4.42286 13.5771C4.71673 13.871 4.71673 14.3449 4.42286 14.6388L3.69918 15.3624C3.40531 15.6563 2.93143 15.6563 2.63755 15.3624C2.34367 15.0686 2.34367 14.5947 2.63755 14.3008L3.36122 13.5771ZM14.6388 13.5771L15.3624 14.3008C15.6563 14.5947 15.6563 15.0686 15.3624 15.3624C15.0686 15.6563 14.5947 15.6563 14.3008 15.3624L13.5771 14.6388C13.2833 14.3449 13.2833 13.871 13.5771 13.5771C13.871 13.2833 14.3449 13.2833 14.6388 13.5771ZM3.36122 4.42286L2.63755 3.69918C2.34367 3.40531 2.34367 2.93143 2.63755 2.63755C2.93143 2.34367 3.40531 2.34367 3.69918 2.63755L4.42286 3.36122C4.71673 3.6551 4.71673 4.12898 4.42286 4.42286C4.12898 4.71673 3.6551 4.71673 3.36122 4.42286ZM9 3.36122C12.1078 3.36122 14.6388 5.89224 14.6388 9C14.6388 12.1114 12.1078 14.6388 9 14.6388C5.88857 14.6388 3.36122 12.1078 3.36122 9C3.36122 5.88857 5.89224 3.36122 9 3.36122ZM9 13.1363C11.2812 13.1363 13.1363 11.2812 13.1363 9C13.1363 6.71878 11.2812 4.86367 9 4.86367C6.71878 4.86367 4.86367 6.71878 4.86367 9C4.86367 11.2812 6.71878 13.1363 9 13.1363Z" fill="#BCBFC2"/>
    </svg>      
     <div id="temp">-20 °C</div>
  </div>
  <div id="thirdLine">
    <div id="catBlock">
    <?php foreach ($categories as $category) {echo"<div><a href='?category=$category[0]'>$category[1]</a></div>";} ?>  
      <!--отправка ссылочным методом get id категории-->


      
       <!--<div>НОВОСТИ</div>
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
<main>
   <div class='void'></div>
    <section class="last-news">
        <div class="container">
        <?php
        $catCount = 0;
        foreach($news as $new){if ($category_get) {if ($category_get==$new['category_id']) {
          //проверка на существование значения ключа category и совпадения категории новости с этим значением
          $new_id = $new['news_id'];
          echo  "<br>";
                    echo "<div id='headlineGrid'>
                    <div id='headlineForm'><a href='oneNew.php?new=$new_id'>$new[title]</a></div>
                     </div> <br>";
                    echo "<img src='images/news/$new[image]' style='margin-left:150px; width:500px'>";
                    $catCount++;} 
              //вывод названия и изображения новости
               }
        else {
          $new_id = $new['news_id'];
          echo  "<br>";
                    echo "<div id='headlineGrid'>
                    <div id='headlineForm'><a href='oneNew.php?new=$new_id'>$new[title]</a></div>
                     </div> <br>";
                    echo "<img src='images/news/$new[image]' style='margin-left:150px; width:500px'>";
                $catCount++;}
          }
          if ($catCount==0) {echo "<div id='headlineForm'>Новостей нет</div>";}
        ?>
         
        
        </div>
    </section>
</main>
<!--<nav>
<li><a href="/task.php?task=0">1</a></li>
<li><a href="/task.php?task=1">2</a></li>
<li><a href="/task.php?task=2">3</a></li>
</nav>-->
</body>
</html>