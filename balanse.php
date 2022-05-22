<?php
session_start();
require_once 'vendor/connect.php';
?>
<html>
<head>
<meta charset="utf-8">
<title>Изменить аватарку</title>
<link rel="stylesheet" href="assets/css/stylemenu.css"/>
<link rel="stylesheet" href="assets/css/stylelog.css"/>
<link rel="stylesheet" href="assets/css/stylefon.css"/>
</head>
<body id="body">
        <ul class="body_slides">
            <li></li>
            <li></li>
            <li></li>
			<li></li>
			<li></li>
        </ul>
		<div id="fon1">
    <input type="checkbox" id="nav-toggle" hidden>
    <nav class="nav">

        <label for="nav-toggle" class="nav-toggle" onclick></label>
        <h2 class="logo"> 
            <a href="../index.php">Копьютерные игры</a> 
        </h2>
        <ul>
            <li><a href="../index.php">Главная</a>
			<hr>
            <li><a href="../magazin.php">Магазин</a>
			<hr>
			<li><a href="../cart.php">Корзина</a>
			<hr>
            <li><a href="../blog/blog.php">Блог</a>
			<hr>
            <li><a href="../kabinet.php">Личный кабинет</a>
			<hr>
        </ul>
    </nav>
	
<section class="container">
    <div class="login">
      <h5>Пополнение счета</h5>
      <form action="vendor/cheak.php" method="post" enctype="multipart/form-data">
	  <?php
$user = $_SESSION['user']['id'];

$result = $connect->query("SELECT * FROM users WHERE id='".$user."'"); 
$row = $result->fetch_assoc(); 
$kosh = $row['checks'];
echo "Ваш счет - $kosh";
?>

			<p><input name="balanse" type="number" min="1" required></p>
			<input name="submit" type="submit" value="Пополнить">
<hr>
          <a class="button" href="cart.php" >Корзина</a>
		  <a class="button" href="kabinet.php" >Личный кабинет</a>
		          <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
      </form>
    </div>
  </section>
  </div>
 </div>
</body>
</html>

