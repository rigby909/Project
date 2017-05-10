<?php
	session_start();
	if (isset($_SESSION['user'])) {
		header("Location: cabinet.php");
		exit;
	}
	include("db.php");
	if (isset($_POST['submit'])) {
		$email = $_POST['auto_email'];
		$password = $_POST['auto_password'];
		$r = $db->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
		while ($data = $r->fetch_assoc()) {	
				$_SESSION['user'] = $data;
				header("Location: cabinet.php");
				exit;
		}
		if (!isset($_SESSION['user'])) {
			echo "<script>alert(\"Некорректный логин или пароль. Повторите ввод.\");</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <title>КОПИлка - Главная</title>
        <meta name="description" content="">
		<link rel="shortcut icon" href="img/money2.png">
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/custom-styles.css">
    </head>
    <body>
		<script src="js/jquery-1.9.1.js"></script> 
		<script src="js/bootstrap.js"></script>	
		<div class="navbar-wrapper">
			<div class="container-fluid">
				<nav class="navbar navbar-fixed-top">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="index.php"><img src="img/money2.png"/></a>
						</div>
						<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php" class="">Главная</a></li>
								<li><a href="contacts.php">О нас</a></li>
								<li><a href="registration.php">Регистрация</a></li>

							</ul>
							<ul class="nav navbar-nav pull-right">
								<li><form method="post" action="" class="navbar-form">
									<div class="form-group">
										<input type="email" class="form-control" placeholder="E-mail" value="" name="auto_email">
									</div>
									<div class="form-group">
										<input type="password" class="form-control" placeholder="Пароль" value="" name="auto_password">
									</div>
									<button type="submit" class="btn btn-primary" name="submit">
										Войти
									</button>
								</form></li>
								<li><a>
									<script src="//ulogin.ru/js/ulogin.js"></script>
									<div id="uLogin" data-ulogin="display=small;theme=classic;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=twitter,google,yandex,instagram;redirect_uri=http%3A%2F%2Flocalhost%2Fsample1%2Flogin_soc.php;mobilebuttons=0;"></div>
								</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
		
		<div class="container">
			<div class="site-header">
				<div class="logo">
					<h1><img src="img/m.png"/></h1>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="banner">
				<div class="carousel slide" id="myCarousel">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="item active">
							<img src="img/banner-image.jpg" alt="">
							<div class="carousel-caption">
							  <h1>Cистема ведения семейного бюджета</h1>
							  <h2>Ведите учет расходов и доходов по различным категориям в режиме реального времени</h2>
							</div>
						</div>
						<div class="item">
							<img src="img/maxresdefault.jpg" alt="">
							<div class="carousel-caption">
							  <h1>Контролируйте бюджет онлайн</h1>
							  <h2>Анализ представлен в виде графиков за любой период</h2>
							</div>
						</div>
						<div class="item">
							<img src="img/banner.jpg" alt="">
							<div class="carousel-caption">
							  <h1>Прогнозируйте бюджет (NEW!)</h1>
							  <h2>Рассчитайте свои расходы на следующий месяц</h2>
							</div>
						</div>
					</div>
					<a data-slide="prev" href="#myCarousel" class="carousel-control left"><span class="glyphicon glyphicon-chevron-left"></span></a>
					<a data-slide="next" href="#myCarousel" class="carousel-control right"><span class="glyphicon glyphicon-chevron-right"></span></a>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="featured-content">
				<div class="row">
					<div class="col-sm-6">
						<div class="block">
							<h1>Добро пожаловать</h1>
							<h2>Зарегистрируйтесь и откройте новые возможности!</h2>
							<a href="registration.php" class="btn">Присоединиться</a>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="block-content">
							<h3>В нашей системе вы можете вести, контролировать, прогнозировать доходы и расходы как личные, <br>так и всей семьи</h3>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="copy-rights">
				Copyright(c) website name. Owner:<a href="mailto:rigby909@gmail.com">Rigby909@gmail.com</a>
			</div>
		</div>
		<script>
			$('#myCarousel').carousel({
			interval: 3600
			});
		</script>
    </body>
</html>
