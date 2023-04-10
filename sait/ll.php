<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="/images/naruto.ico" type="image/x-icon">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Главная страница</title>
<link href="css/mtd.css" rel="stylesheet" type="text/css">
<link href=""
</head>
<body>
	
<div class="container">
  <header>
	  <nav class="secondary_header" id="menu">
      <ul>
        <li><a href="main.html">ГЛАВНАЯ СТРАНИЦА</a></li>
        <li><a href="genres.html">ЖАНРЫ АНИМЕ</a></li>
        <li><a href="gao.html">ГАО ЛИЦА</a></li>
		 <li><a href="test.html">АНИМЕ ГАМЕСЫ</a></li>
      </ul>
    </nav>
    <div class="primary_header">
      <h1 class="title">Конбанва!</h1>
    </div>
  </header>
<?php
// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Соединямся с БД
$link=mysqli_connect("localhost", "root", "", "kurwasach");

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!empty($_POST['not_attach_ip']))
        {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>	
  <h1>Авторизация</h1>
<div id="wrapper">
	<form id="signin" method="post" action="" autocomplete="off">
		<input type="text" id="user" name="login" placeholder="Username" />
		<input type="password" id="pass" name="password" placeholder="Password" />
	<!--	<input type="checkbox" id="c1" name="not_attach_ip" />
		<label for="c1"><span></span>Не прикреплять к IP(не безопасно)</label> -->
		<button name="submit" type="submit">&#xf0da;</button>
	</form>
</div>
  
  
  <div class="row blockDisplay">
    <div class="column_hal left_half">
      <h2 class="column_title">ГЛАВНЫЕ ИДИОТЫ</h2>
    </div>
    <div class="column_hal right_half">
      <h2 class="column_title">ПРИНИМАВШИЕ УЧАСТИЕ</h2>
    </div>
  </div>
  <div class="social">
	<a class="social_icon" href="https://vk.com/iamnotyourwaifu" target="_blank"><img src="images/bkg5.jpg" width="100" alt="" class="thumbnail"/></a> 
    <a class="social_icon"href="https://vk.com/satanic_mother_fucker" target="_blank"><img src="images/bkg322.jpg" width="100" alt="" class="thumbnail"/></a>
    <a class="social_icon" href="https://vk.com/id492758400" target="_blank"><img src="images/bkg4.jpg" width="100" alt="" class="thumbnail"/></a>
  </div>
	
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2020 - <strong>некогда Рой идиотов</strong></div>
  </footer>
</div>
</body>
</html>