<?php
session_start();
require_once 'vendor/connect.php';
if (!$_SESSION['user']) {
	$_SESSION['message'] = 'Авторизируйтесь чтобы купить игру!';
    header('Location: login.php');
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Корзина</title>
<link rel="stylesheet" href="assets/css/stylemenu.css"/>
<link rel="stylesheet" href="assets/css/stylecart.css"/>
</head>
		<div id="fon1">
    <input type="checkbox" id="nav-toggle" hidden>
    <nav class="nav">

        <label for="nav-toggle" class="nav-toggle" onclick></label>
        <h2 class="logo"> 
            <a href="index.php">Копьютерные игры</a> 
        </h2>
        <ul>
            <li><a href="index.php">Главная</a>
			<hr>
            <li><a href="magazin.php">Магазин</a>
			<hr>
			<li><a href="cart.php">Корзина</a>
			<hr>
            <li><a href="blog/blog.php">Блог</a>
			<hr>
            <li><a href="kabinet.php">Личный кабинет</a>
			<hr>

        </ul>
    </nav>
	</div>
	<h3>Мой заказа</h3>
<section class="container">
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);// включаем сообщения об ошибках
$connect->set_charset("utf8mb4"); // задаем кодировку

$result = $connect->query("SELECT * FROM korzina where id_user= '".$_SESSION['user']['id']."'"); // запрос на выборку
while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
{
	
echo'<div class="banner">';
echo'<hr>';
echo'<div class="image">';
echo'<a class="image"><img src="assets/images/poster/'.$row['poster'].'" alt="" /></a>';
echo'<h1 ><a href="game.php? id='.$row['id_game'].'">'.$row['name'].'</a></h1>';
echo'<h1>Цена:'.$row['price'].' Платформа:'.$row['platform'].'</h1>';
echo'<h1></h1>';
echo'</div>';
echo'<hr>';
echo'<form method="POST" action="vendor/dell_cart.php? id='.$row['id'].'">
<input type="hidden" name="id" value="'.$row['id'].'"/>';
echo'<button  class="closeModal"></button>';
echo'</form>';
echo'</div>';
}
?>
</section>

<div class="banner1">
<hr>
<?php
  $res = mysqli_query($connect, "SELECT * FROM korzina WHERE id_user= '".$_SESSION['user']['id']."'");
  $num_rows = mysqli_num_rows($res);
  if($num_rows == 0){
  echo'<h2>Корзина пустая!</h2>';}
   else{
 ?>
<h2>Оплата заказ</h2>


<?php
 if(isset($_SESSION['user']['id']))
 {
$result = $connect->query("SELECT SUM(price) AS price FROM korzina WHERE id_user='".$_SESSION['user']['id']."'"); 
$row = $result->fetch_assoc(); 
$sum = $row['price'];
echo "<p>Итоговая цена - $sum</p>";
 }

$result = $connect->query("SELECT * FROM users WHERE id='".$_SESSION['user']['id']."'"); 
$row = $result->fetch_assoc(); 
$kosh = $row['checks'];
echo "<p>Ваш кошелек - $kosh</p>";
 if($sum <= $kosh)
 {
$result = $connect->query("SELECT * FROM korzina WHERE id_user='".$_SESSION['user']['id']."'"); 
$row = $result->fetch_assoc(); 
	echo'<td><form method="POST" action="vendor/buy.php? id='.$row['id'].'">
	<input type="submit" value ="Купить">
	</form></td>';
}
else{
	echo '<p>Не хватает средств</p>';
	echo'<td><form method="post" action="balanse.php" >
	<a><input name="submit" type="submit" value="Пополнить"></a>
	</form></td>';
}
 }
?>
<hr>
<form method="post" action="magazin.php">
<a><input name="submit" type="submit" value="Продолжить покупку"></a>
 </form>
</div>
</body>
</html>
