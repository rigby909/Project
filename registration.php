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
        <title>КОПИлка - Регистрация</title>
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
							<h1>Регистрация</h1>
							<h2>Введите информацию в форму:</h2>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
								<form class="form" action="" method="post">
									<div class="form-group">
										<h3>Имя:</h3>
										<input type="text" class="form-control" name="first_name" maxlength="25">
									</div>
									<div class="form-group">
										<h3>Фамилия:</h3>
										<input type="text" class="form-control" name="last_name" maxlength="25">
									</div>
									<div class="form-group">
										<h3>Email:</h3>
										<input class="form-control" type="email" name="email" maxlength="25">
									</div>
									<div class="form-group">
										<h3>Пароль:</h3>
										<input type="password" class="form-control" name="password" maxlength="25">
									</div>
									<div class="form-group form-group-lg">
										<p class="help-block">Все поля обязательны для заполнения</p>
									</div>
									<input type="submit" name="submit" class="btn btn-default"/>
									<input type="reset" class="btn btn-default"/>
								</form>
								<?php
									include("db.php");
									function test() {
										global $db;
										global $HTTP_POST_VARS;
										if (!isset($HTTP_POST_VARS['email'],$HTTP_POST_VARS['last_name'],$HTTP_POST_VARS['first_name'],$HTTP_POST_VARS['password'])) {
											echo "<p>Ошибка при передачи параметров к скрипту! Обратитесь к администратору сайта.</p>\n";
											return(false);
										}
										if (trim($HTTP_POST_VARS['first_name'])=="") {
											echo "<p>Вы не ввели своё имя. Повторите ввод.</p>\n";
											return(false);
										}
										if (trim($HTTP_POST_VARS['email'])=="") {
											echo "<p>Вы не ввели email. Повторите ввод.</p>\n";
											return(false);
										}
										if (trim($HTTP_POST_VARS['password'])=="") {
											echo "<p>Вы не ввели пароль. Повторите ввод.</p>\n";
											return(false);
										}
										$r = $db->query("SELECT email FROM users");
										while ($data = $r->fetch_assoc()) {  
											if ($data['email'] == $HTTP_POST_VARS['email']) {
												echo "<p>Такая почта уже зарегистрирована</p>\n";
												return(false);
											}
										}
										return(true);
									}
									function add() {
										global $db;
										global $HTTP_POST_VARS;
										$first_name = $HTTP_POST_VARS['first_name'];
										$last_name = $HTTP_POST_VARS['last_name'];
										$email = $HTTP_POST_VARS['email'];
										$password = $HTTP_POST_VARS['password'];
										$db->query("INSERT INTO users (first_name, last_name, email, password, auth_via) VALUES ('$first_name', '$last_name', '$email', '$password', 1)");						
									}
									if (isset($HTTP_POST_VARS['submit'])) { 
										if (test()) {
											add(); 
											echo "<p>Регистрация прошла успешно!</p>\n";
										}
									}
								?>
							</div>
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
