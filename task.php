<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset='utf-8'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Задания</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
</head>
<body>
<?php     //начало сессии       //получение значения task через массив $_GET
session_start();  
for ($i=0;$i<=4;$i++) {switch($_GET['task'])  
{case 0: $arrayTask1 = get2ss(mt_rand(2,5));  //функция с параметром в виде произвольной длины числа в 2СС
        $var1 = $arrayTask1[0];
        $_SESSION["session $i"] = $arrayTask1;    //занесение в массив сессии под нужным ключом массива с ответом и заданным числом
        if ($i==0) {echo "<form method='post' enctype='multipart/form-data' action='answers.php'> ";}    
        //вывод формы, самого задания с данными из переменных и скрытого input для получения значения таймера
        echo "<label for='task$i'>Необходимо перевести значение $var1 из 2СС в 10СС. </label>    
                         <input id='task$i' name='task$i'> <br>";
        if ($i==4) {echo "<input type='hidden' id='valueJs' name='valueJs'> <input type='submit' value='Отправить' id='buttonSubmit'>
                        </form>";}
        break;
case 1: $var2 = colors(mt_rand(1,8));
    $var20 = colors(mt_rand(1,8));
    $powerVar21 = mt_rand(1,8);
    $var21 = colors($powerVar21);
    $arrayTask1=[$powerVar21, answerForSecond($var2,$var20,$powerVar21)];
    $_SESSION["session $i"] = $arrayTask1;
    if ($i==0) {echo "<form method='post' enctype='multipart/form-data' action='answers.php'> ";}
                echo "<label for='task$i'>Какой минимальный объём памяти (в Кбайт) нужно зарезервировать, чтобы можно было сохранить любое растровое изображение размером $var2 x $var20 пикселей при условии, что в изображении могут использоваться $var21 различных цветов? В ответе запишите только целое число, единицу измерения писать не нужно.</label>
                    <input id='task$i' name='task$i'> <br><br>";
    if ($i==4) {echo "<input type='hidden' id='valueJs' name='valueJs'> <input type='submit' value='Отправить'>
                     </form> ";}
    break;
case 2: $var3 = letter();
    $arrayTask1=answerForThird($var3);
    $_SESSION["session $i"] = $arrayTask1;
    $text0 = $arrayTask1[0];
    if ($i==0) {echo "<form method='post' enctype='multipart/form-data' action='answers.php'> ";}
                echo "<label for='task$i'>Подсчитайте количество вхождений буквы $var3 в данном тексте: $text0</label>
                <input id='task$i' name='task$i'> <br><br>";
    if ($i==4) {echo "<input type='hidden' id='valueJs' name='valueJs'> <input type='submit' value='Отправить'>
                    </form> ";}
    break;} }

function get2ss($len){$str="";        //функция 1-го задания, получает длину числа в 2СС
        $answer = 0;
        for($i=0;$i<$len;$i++){
        if($i==0) $str.=1;
        else $str.= rand(0,1);                    
        $answer+=(2**($len-($i+1)))*$str[$i];}   //преобразование из 2СС в 10СС
        return [$str, $answer]; }          //возвращается массив: число в 2СС и ответ(число в 10СС)

function colors ($power) {$colors = 2 ** $power;    //получает случайную степень, возвращает число цветов по этой степени
                return $colors;}
function answerForSecond ($valueSize1, $valueSize2, $powerColor) {$answerBit = $valueSize1*$valueSize2*$powerColor;
                                                    $answer = $answerBit/(8*1024);
                                                    return $answer;}   //получает 2 значения размера изображения и значение степени для числа цветов
                                                    //функция просчитывает объем информации по формуле и преобразовывает в кб

function letter () {$arrayLetter = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я');
                                                        $index = mt_rand(0,32);
                                                        $letter = $arrayLetter[$index];
                                                        return $letter; }  //функция выбора произвольной буквы из массива русских букв
function answerForThird($var3) {$arrText = ['<br><br>я вас любил: любовь еще, быть может, <br>
                                            в душе моей угасла не совсем;<br>
                                            но пусть она вас больше не тревожит;<br>
                                            я не хочу печалить вас ничем.<br>
                                            я вас любил безмолвно, безнадежно,<br>
                                            то робостью, то ревностью томим;<br>
                                            я вас любил так искренно, так нежно,<br>
                                            как дай вам бог любимой быть другим.
                                            ', '<br><br>сижу за решеткой в темнице сырой.<br>
                                            вскормленный в неволе орел молодой,<br>
                                            мой грустный товарищ, махая крылом,<br>
                                            кровавую пищу клюет под окном.', '<br><br>клюет, и бросает, и смотрит в окно,<br>
                                            как будто со мною задумал одно.<br>
                                            зовет меня взглядом и криком своим<br>
                                            и вымолвить хочет: «давай улетим!»', '<br><br>мы вольные птицы; пора, брат, пора!<br>
                                            туда, где за тучей белеет гора,<br>
                                            туда, где синеют морские края,<br>
                                            туда, где гуляем лишь ветер… да я!..
                                            ', '<br><br>в тот год осенняя погода<br>
                                            стояла долго на дворе,<br>
                                            зимы ждала, ждала природа.
                                            '];
                                                                   
$text = $arrText[mt_rand(0,4)];   //выбор одного текста из массива
$text_arr = preg_split("//u", $text , -1, PREG_SPLIT_NO_EMPTY); 
 //разбиение строки на массив символов, учитывая кодировку utf-8 без ограничения на подстроки, без пустых подстрок
$count = 0;
for ($t=0;$t<mb_strlen($text); $t++) {if ($text_arr[$t]==$var3) {$count++;} } //подсчет соответствия символов с заданной буквой
                                    // echo $count;
return [$text, $count];     } //возвращение массива с выбранным текстом и количеством нужного символа

?>

<div>Осталось секунд:</div>
<div id="timer">20</div>
<br>
<div id="dateNow"></div>
<script>
document.addEventListener('DOMContentLoaded', function() {let startdate= new Date();
  let countdownInterval; 
  let month;
  switch (startdate.getMonth()){
  case 0:
  month= "января";
  break;
  case 1:
  month= "февраля";
  break;
  case 2:
  month= "марта";
  break;
  case 3:
  month= "апреля";
  break;
  case 4:
  month= "мая";
  break;
  case 5:
  month= "июня";
  break;
  case 6:
  month= "июля";
  break;
  case 7:
  month= "августа";
  break;
  case 8:
  month= "сентября";
  break;
  case 9:
  month= "октября";
  break;
  case 10:
  month= "ноября";
  break;
  case 11:
  month= "декабря";
  break;
  }
  let dateNow = document.getElementById("dateNow");          
  dateNow.textContent = `Сейчас ${startdate.getFullYear()} год, ${startdate.getDate()} ${month}, ${startdate.getHours()}:${startdate.getMinutes()}:${startdate.getSeconds()}`;
  function startCountdown() {
    countdownInterval = setInterval(function() { 
      startdate= new Date();
      switch (startdate.getMonth()){
  case 0:
  month= "января";
  break;
  case 1:
  month= "февраля";
  break;
  case 2:
  month= "марта";
  break;
  case 3:
  month= "апреля";
  break;
  case 4:
  month= "мая";
  break;
  case 5:
  month= "июня";
  break;
  case 6:
  month= "июля";
  break;
  case 7:
  month= "августа";
  break;
  case 8:
  month= "сентября";
  break;
  case 9:
  month= "октября";
  break;
  case 10:
  month= "ноября";
  break;
  case 11:
  month= "декабря";
  break;
  }
  dateNow.textContent = `Сейчас ${startdate.getFullYear()} год, ${startdate.getDate()} ${month}, ${startdate.getHours()}:${startdate.getMinutes()}:${startdate.getSeconds()}`;     
    }, 1000);
  }
  startCountdown();    });


document.addEventListener('DOMContentLoaded', function() {   //событие завершения загрузки контента документа
  const timerElement = document.getElementById('timer');
  let countdownInterval;
  let timeRemaining = 20; 
 
  function updateTimerDisplay() {            //функция изменения текста в элементе timer на оставшиеся секунды
    timerElement.textContent = timeRemaining;        
  }
  function startCountdown() {
    updateTimerDisplay(); 
    countdownInterval = setInterval(function() {   //установка интервала для функции в каждые 1000 мс(1с)
      timeRemaining--;
      
      if (timeRemaining < 1) {
        clearInterval(countdownInterval);         //отмена интервала
        showEnd();
      } else {
        updateTimerDisplay();
      }
      let valueJs = document.getElementById("valueJs");          
  valueJs.value = document.getElementById("timer").textContent;      //получение значения секунд из таймера при отправке формы в скрытый input
    }, 1000);
  }
  function showEnd() {
    timerElement.textContent = 'Время вышло. Ответы не будут зачтены.';
  }
  startCountdown();
  
});
</script>

</body>
</html>