<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Личный Кабинет</title>
<link rel="stylesheet" href="assets/css/stylemenu.css"/>
<link rel="stylesheet" href="assets/css/stylekabinet.css"/>
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
            <a href="index.php">Копьютерные игры</a> 
        </h2>
        <ul>
            <li><a href="index.php">Главная</a>
			<hr>
            <li><a href="magazin.php">Магазин</a>
			<hr>
			<li><a href="cart.php">Корзина   <?php 
			 if(isset($_SESSION['login']))
 {
  $user = $_SESSION['login']; 
  $result = mysqli_query($connect, "SELECT * FROM korzina WHERE user_login='".$user."'");
  $num_rows = mysqli_num_rows($result);
  echo "$num_rows";
 }
  ?></a>
			<hr>
            <li><a href="blog/blog.php">Блог</a>
			<hr>
            <li><a href="kabinet.php">Личный кабинет</a>
			<hr>
<?php
 if(isset($_SESSION['login']))
 {
$mysqli= mysqli_connect("localhost", "root","", "18074");
$user = $_SESSION['login'];
$result = $mysqli->query("SELECT * FROM users WHERE user_login='".$user."'"); 
$row = $result->fetch_assoc(); 
$userrole = $row['user_role'];
$role = 2;
 if($role == $userrole)
 {
	 echo'<hr>';
	echo '<li><a href="admin/user.php">Пользователи</a>';
	echo'<hr>';
	echo '<li><a href="admin/key/key.php">Ключи</a>';
	echo'<hr>';
	echo '<li><a href="admin/game/game.php">Игры</a>';
	echo'<hr>';
}
else{
}
}
?>
        </ul>
    </nav>




<section class="container">

<div class="banner">

<div class="tabs">
  <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
  <label for="tab-btn-1">Логин</label>
  <input type="radio" name="tab-btn" id="tab-btn-2" value="">
  <label for="tab-btn-2">Электронная почта</label>
  <div id="content-1">
<form action="vendor/login_red.php" method="post" enctype="multipart/form-data">
<h2>Логин</h2>
        <input type="text" name="login" value="<?= $_SESSION['user']['login'] ?>"></h4>
<h2>Проверка пароля</h2>
<input type="password" name="password" placeholder="Введите пароль" required>
<h2>Подтверждение пароля</h2>
<input type="password" name="password_confirm" placeholder="Подтвердите пароль" required>
<hr>
	<button  class="btn_2">Изменить</button>
        <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
 </form>
  </div>
  <div id="content-2">
<form action="vendor/email_red.php" method="post" enctype="multipart/form-data">
<h2>Email</h2>
        <input type="text" name="email" value="<?= $_SESSION['user']['email'] ?>"></h4>
<h2>Проверка пароля</h2>
<input type="password" name="password" placeholder="Введите пароль" required>
<h2>Подтверждение пароля</h2>
<input type="password" name="password_confirm" placeholder="Подтвердите пароль" required>
<hr>
	<button  class="btn_2">Изменить</button>
        <?php
            if (isset($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
 </form>
  </div>
</div>

<hr>
<div class="navbar">
  <a href="kabinet.php">Профиль</a>
  <a href="data.php" class="active">Личные данные</a>
  <a href="history.php">История покупок</a>
</div>
<hr>
</div>
</div>
</section>
</body>
</html>

