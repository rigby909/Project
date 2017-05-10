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
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>		
		<script src="js/jquery-1.9.1.js"></script> 		
		<script src="js/bootstrap.js"></script>	
		<script src="js/forecast1.js"></script> 
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
								<li><a href="analysis.php" class="">Анализ</a></li>								
								<li><a class="active"href="forecast.php" class="">Прогноз</a></li>
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
							<h1>Прогнозирование бюджета</h1>
							<h2>на будущий период времени</h2>
						</div>
						<div class="block-content"><br>
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<form class="form" id="calc">
									<div class="form-group">
										<h3>Доход: </h3>
										<input type="number" class="form-control" id="income" maxlength="8" placeholder="руб.">
									</div>
										<h3>Выбрать категорию расхода: </h3>
										<div class="form-group col-sm-6">
											<input type="number" class="form-control" id="income1" maxlength="8" placeholder="Еда и напитки"/>
											<input type="number" class="form-control" id="income2" maxlength="8" placeholder="Покупки"/>
											<input type="number" class="form-control" id="income3" maxlength="8" placeholder="Счета"/>
											<input type="number" class="form-control" id="income4" maxlength="8" placeholder="Кредит"/>
											<input type="number" class="form-control" id="income5" maxlength="8" placeholder="Авто"/>
											<input type="number" class="form-control" id="income6" maxlength="8" placeholder="Путешествия"/>
											<input type="number" class="form-control" id="income7" maxlength="8" placeholder="Семья"/>
											<input type="number" class="form-control" id="income8" maxlength="8" placeholder="Дом"/>
										</div>
										<div class="form-group col-sm-6">
											<input type="number" class="form-control" id="income9" maxlength="8" placeholder="Развлечения"/>
											<input type="number" class="form-control" id="income10" maxlength="8" placeholder="Мобильная связь"/>
											<input type="number" class="form-control" id="income11" maxlength="8" placeholder="Одежда"/>
											<input type="number" class="form-control" id="income12" maxlength="8" placeholder="Домашние животные"/>
											<input type="number" class="form-control" id="income13" maxlength="8" placeholder="Транспорт"/>
											<input type="number" class="form-control" id="income14" maxlength="8" placeholder="Хобби"/>
											<input type="number" class="form-control" id="income15" maxlength="8" placeholder="Здоровье"/>
											<input type="number" class="form-control" id="income16" maxlength="8" placeholder="Аренда"/>
										</div><br><hr><br>
									<div class="form-group form-group-lg">
										<p class="help-block"> </p>
									</div>
									<input type="button" id="forecast_start" class="btn btn-default" value="Рассчитать"/>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
							<h1>Вычислите сумму из доходов, которую можете отложить к накоплениям</h1><br>
								<form class="form" id="forecast" style="display:none;">
								<div class="form-group">
									<h3>Лишняя сумма: </h3>
									<input type="number" class="form-control" id="free_money" maxlength="8" disabled><hr>
								</div>
								</form>	
								<div id="donutchart"></div>
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
