<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="/images/naruto.ico" type="image/x-icon">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Аниме-лист</title>
<link href="css/mtd.css" rel="stylesheet" type="text/css">
<link href="css/list.css" rel="stylesheet" type="text/css">
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
// данные для подключения к дб	
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'sait';
	// Check connection
$link = mysqli_connect($host, $user, $password, $db_name);
// Не обязательная строка, просто пока я не написал, чтобы всё отдельно вот тут ставило в ютф8 у меня вылетал хампп при попытке открыть файл
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT * FROM list";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
	//Заполнение массива данными из таблицы для последующего вывода
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
 mysqli_close($link);
?>
<div class="flex-container">
<table class='table table-striped' >
	<thead class="thead-dark" align="center">
	<tr>
		<th>№</th>
		<th>Название</th>
	</tr>
	</thead>
	<?php foreach ($data as $user) {?>
	
	<tbody>
	<tr>
		<td><?= $user['id']?></td>
		<td><?= $user['name']?></td>
	</tr>
	</tbody>
	

<?php } ?>
</table>
</div>
<form method="POST" action="">
<h3>Добавить анимку</h3>
<input type="text" name="name" placeholder="Введите название"/>
	<input type="submit" value="Запомнить" required>
	</form>
<form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
</form>
<?php
	if (isset($_POST['name'])){

// Переменные с формы
$name = $_POST['name'];

// данные для подключения к дб	
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'sait';
	// Check connection
$link = mysqli_connect($host, $user, $password, $db_name);
// Не обязательная строка, просто пока я не написал, чтобы всё отдельно вот тут ставило в ютф8 у меня вылетал хампп при попытке открыть файл
mysqli_query($link, "SET NAMES 'utf8'");
$result = $link->query("INSERT INTO list (name) VALUES ('$name')");
//Проверка результата для пользователя
if ($result == true){
echo "<p style='color:green; margin:auto; padding-left:600px;'>" ."Добавлено!". "</p>";
}else{
echo "<p style='color:red; margin:auto; padding-left:600px;'>" ."Не получилось". "</p>";
}
	}
	?>
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
	  <div class="copyright">&copy;2020 - <strong>Некогда Рой идиотов</strong></div>
  </footer>
</div>
</body>
</html>

	