
<?php
	
// declare(strict_types=1);
require_once 'inc/lib.inc.php';
require_once 'inc/data.inc.php';	

$hour = (int)date('G');
if ($hour >= 6 && $hour < 12) {
    $welcome = 'Доброе утро';
} elseif ($hour >= 12 && $hour < 18) {
    $welcome = 'Добрый день';
} elseif ($hour >= 18 && $hour < 23) {
    $welcome = 'Добрый вечер';
} else {
    $welcome = 'Доброй ночи';
}

// Инициализация заголовков страницы
$title = 'Сайт нашей школы';
$header = "$welcome, Гость!";
$id = strtolower(strip_tags(trim($_GET['id'] ?? '')));
switch ($id) {
    case 'about':
        $title = 'О сайте';
        $header = 'О нашем сайте';
        break;
    case 'contact':
        $title = 'Контакты';
        $header = 'Обратная связь';
        break;
     case 'table':
        $title = 'Таблица умножения';
        $header = 'Таблица умножения';
        break;
    case 'calc':
        $title = 'Он-лайн калькулятор';
        $header = 'Калькулятор';
        break;
}    

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<title>Сайт нашей школы</title>-->
  <title><?=$title?></title>
  <link rel="stylesheet" href="inc/style.css">
</head>
<body>
  <header>
    <?php include 'inc/top.inc.php'; ?>
    <!-- Верхняя часть страницы -->
    <!--<img src="logo.png" width="130" height="80" alt="Наш логотип" class="logo">-->
    <!--<span class="slogan">приходите к нам учиться</span>-->
    <!-- Верхняя часть страницы -->
  </header>

  <section>
      
    <!-- Заголовок -->
    <!--<h1>Добро пожаловать на наш сайт!</h1>-->
     <h1><?=$header?></h1>
    <!--?php include 'inc/index.inc.php'; ?>-->
    <!-- Заголовок -->
    <!-- Область основного контента -->
    <?php
switch($id){
	case 'about': 
		include 'inc/about.php';
		break;
	case 'contact':
		include 'inc/contact.php';
		break;
	case 'table':
		include 'inc/table.php';
		break;
	case 'calc':
		include 'inc/calculator.php';
		break;
	default:
		include 'inc/index.inc.php'; 
}
?>
   
    <!-- Область основного контента -->
  </section>
  <nav>
     <?php include 'inc/menu.inc.php'; ?>  
    <!-- Навигация -->
    <!--<h2>Навигация по сайту</h2>-->
    <!-- Меню -->
    <!--<ul>-->
    <!--  <li><a href='index.php'>Домой</a></li>-->
    <!--  <li><a href='about.php'>О нас</a></li>-->
    <!--  <li><a href='contact.php'>Контакты</a></li>-->
    <!--  <li><a href='table.php'>Таблица умножения</a></li>-->
    <!--  <li><a href='calc.php'>Калькулятор</a></li>-->
    <!--</ul>-->
    <!-- Меню -->
    <!-- Навигация -->
  </nav>
  <footer>
     <!--?php include 'inc/bottom.inc.php'; ?> -->
     
     <?php
    $currentYear = getdate()['year'];
    echo "&copy; Супер Мега Веб-мастер, 2000 &ndash; {$currentYear}";
    ?>
    <!-- Нижняя часть страницы -->
    <!--&copy; Супер Мега Веб-мастер, 2000 &ndash; 20xx-->
    <!-- Нижняя часть страницы -->
  </footer>
</body>
</html>
