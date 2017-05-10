<?php
	session_start();
	if (isset($_SESSION['user'])) {
		header("Location: cabinet.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <title>КОПИлка - О нас</title>
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
								<li><a href="index.php" class="">Главная</a></li>
								<li class="active"><a href="contacts.php">О нас</a></li>
								<li><a href="registration.php">Регистрация</a></li>
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
			<div class="featured-content">
				<div class="row">
					<div class="col-sm-6">
						<div class="block">
							<h1>Контакты</h1>
							<h2>Проект создан в Новосибирском государственном университете экономики и управления</h2>
							<h2><img src="img/logo.png"/></h2>
							<h2><img src="img/photo.jpg"/></h2>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="block-content">
							<h3>Телефон: 8 (383) 224-27-44</h3>
							<h3>Адрес: 630099, г. Новосибирск, ул. Каменская 52/1</h3>
							<h3>E-mail: priemc@nsuem.ru</h3>	
							<h1><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1143.2539181916363!2d82.92956633286893!3d55.03431727388149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1481452882627" width="500" height="440" frameborder="0" style="border:0" allowfullscreen></iframe></h1>

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
    </body>
</html>
