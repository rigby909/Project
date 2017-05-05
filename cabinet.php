<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <title>КОПИлка - Кабинет</title>
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
								<li class="active"><a href="cabinet.php" class="">Профиль</a></li>
							</ul>
							<ul class="nav navbar-nav pull-right">
								<li><a href="unsetlogin.php">Выход</a></li>
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
							<h1>Ваш личный кабинет</h1>
							<h2>Информация, настройки</h2>
						</div>
						<div class="block-content"><br>
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<form class="form" method="post">
									<div class="form-group">
										<h3>Имя: </h3>
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?php if (isset($_SESSION['user']))  {echo $_SESSION['user']['first_name'];}?>" maxlength="25">	
									</div>
									<div class="form-group">
										<h3>Фамилия: </h3>
										<input type="text" class="form-control" id="last_name" name="last_name" placeholder="<?php if (isset($_SESSION['user']))  {echo $_SESSION['user']['last_name'];}?>" maxlength="25">	
									</div>
									<?php
									if ($_SESSION[user]['identity']=='') {
									?>
									<div class="form-group">
										<h3>Email: </h3>
										<input type="email" class="form-control" id="email" name="email" placeholder="<?php if (isset($_SESSION['user']))  {echo $_SESSION['user']['email'];}?>" maxlength="25">
									</div>									
									<div class="form-group">
										<h3>Пароль: </h3>
										<input type="password" class="form-control" id="password" name="password" placeholder="" maxlength="25">	
									</div>
									<div class="form-group">
										<h3>Повторите пароль: </h3>
										<input type="password" class="form-control" id="password1" name="password1" placeholder="" maxlength="25">	
									</div>
									<?php
										} else {
									?>
									<p>Вы авторизованы через социальную сеть.</p>
									<?php 
										}
									?>
									<div class="form-group form-group-lg">
										<p class="help-block"> </p>
									</div>
									<input type="submit" name="new_submit" class="btn btn-default"/>
									<input type="reset" class="btn btn-default"/>
								</form>
								<?php
									if (isset($_POST['new_submit'])) {
										include('db.php');
										global $db;
										$email = $_POST['email'];
										$first_name = $_POST['first_name'];
										$last_name = $_POST['last_name'];
										$password = $_POST['password'];
										$password1 = $_POST['password1'];
										if (($email=='') && ($first_name=='') && ($last_name=='') && ($gender=='') && ($password=='')) {
											echo "<p>Изменений нет.</p>\n";
										}
										if (trim($email)!="") {
											$n = trim($email);
											$id = $_SESSION['user']['id'];
											$r = $db->query("SELECT email FROM users");
											while ($data = $r->fetch_assoc()) {  
												if ($data['email'] == $n) {
												echo "<p>Такая почта уже зарегистрирована</p>\n";
												exit;
												}
											}
											$db->query("UPDATE users SET email='$n' WHERE id=$id");
											echo "<p>Изменен email. Авторизуйтесь повторно, чтобы увидеть изменения. </p>\n";
										}
										if (trim($first_name)!="") {										
											$n = trim($first_name);
											$id = $_SESSION['user']['id'];
											$db->query("UPDATE users SET first_name='$n' WHERE id=$id");
											echo "<p>Изменено имя. Авторизуйтесь повторно, чтобы увидеть изменения.</p>\n";
										}
										if (trim($last_name)!="") {										
											$n = trim($last_name);
											$id = $_SESSION['user']['id'];
											$db->query("UPDATE users SET last_name='$n' WHERE id=$id");
											echo "<p>Изменена фамилия. Авторизуйтесь повторно, чтобы увидеть изменения.</p>\n";
										}
										if (trim($password)!="" && trim($password)==trim($password1)) {
											$n = trim($password);
											$id = $_SESSION['user']['id'];
											$db->query("UPDATE users SET password='$n' WHERE id=$id");
											echo "<p>Изменен пароль. Авторизуйтесь повторно, чтобы увидеть изменения.</p>\n";
										}
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
							<div class="block-content">
								<h1>		
									<?php 
										if (isset($_SESSION['user']))  {
											echo "Здравствуйте, ".$_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']."!";
										}
									?>
								</h1><br>
								<h1>Настроить шаблон...: </h1>
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
