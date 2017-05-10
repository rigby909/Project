<?php
	session_start();	
	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
	include('db.php');
	global $db;
	$id = $_SESSION['user']['id'];

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
		<script src="js/jquery-1.9.1.js"></script> 
		<script src="js/bootstrap.js"></script>	
		<script src="js/analysis.js"></script>
    </head>
    <body>
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
								<li><a href="cabinet.php" class="">Профиль</a></li>
								<li><a href="transactions.php" class="">Транзакции</a></li>
								<li><a class="active"href="analysis.php" class="">Анализ</a></li>								
								<li><a href="forecast.php" class="">Прогноз</a></li>
								<li><a href="credit_calc.php" class="">Кредитный калькулятор</a></li>
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
							<h1>Анализ</h1>
							<h2>Обзор в виде диаграм</h2>
						</div>
						<div class="block-content"><br>
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<form class="form" method="post">
									<h1>Настроить отображение</h1><br>
									<div class="form-group" id="by_date">
										<h3>По дате:</h3>
										<p>С 
											<input type="date" name="date1" id="date1" class="form-control" value="<?php echo date("Y-m-d");?>" min="2017-01-01" max="<?php echo date("Y-m-d");?>">
										</p>
										<p>По 
											<input type="date" name="date2" id="date2"class="form-control" value="<?php echo date("Y-m-d");?>" min="2017-01-01" max="<?php echo date("Y-m-d");?>">
										</p>
										<input type="button" name="date_transactions" id="date_transactions" class="btn btn-default" value="Показать"/>
									</div>
									<div class="form-group" id="by_type"><hr>
										<h3>По типу: </h3>
										<select class="form-control" id="incomes_or_expences">
											<option name="incomes" value="1">Доходы</option>
											<option name="expences" value="2">Расходы</option>									
										</select><br>									
										<input type="button" name="type_transactions" id="type_transactions" class="btn btn-default" value="Показать"/>
									</div>									
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
								<h1>Настройте обзор по фильтрам и получайте информацию в режиме онлайн<h1><br>							
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<hr>
				
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
