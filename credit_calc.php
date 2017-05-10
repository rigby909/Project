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
		<script src="js/jquery-1.9.1.js"></script> 		
		<script src="js/bootstrap.js"></script>	
		<script src="js/credit.js"></script> 
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
								<li><a href="forecast.php" class="">Прогноз</a></li>
								<li class="active"><a href="credit_calc.php" class="">Кредитный калькулятор</a></li>
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
							<h1>Кредитный калькулятор</h1>
							<h2>Рассчитайте условия кредита</h2>
						</div>
						<div class="block-content"><br>
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<form class="form" id="calc">
									<div class="form-group">
										<h3>Вид платежа: </h3>
										<input type="number" class="form-control" disabled placeholder="Аннуитетный">
									</div>
									<div class="form-group">
										<h3>Сумма кредита: </h3>
										<input type="number" class="form-control" id="credit_amount" maxlength="8" placeholder="руб.">
									</div>
									<div class="form-group">
										<h3>Процентная ставка: </h3>
										<input type="number" class="form-control" id="credit_percent" maxlength="2" placeholder="%">
									</div>
									<div class="form-group">
										<h3>Срок кредита: </h3>
										<input type="number" class="form-control" id="credit_date" maxlength="3" placeholder="месяцев">
									</div>
									<div class="form-group form-group-lg">
										<p class="help-block"> </p>
									</div>
									<input type="button" name="calc_start" id="calc_start" class="btn btn-default" value="Рассчитать"/>
									<input type="reset" id="calc_stop" class="btn btn-default"/>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
							<h1>Онлайн расчет ежемесячного платежа и переплаты по потребительскому кредиту</h1><br>
								<form class="form" id="result" style="display:none;">
								<h3>Результат расчета</h3>
								<div class="form-group">
									<h3>Ежемесячный платеж: </h3>
									<input type="number" class="form-control" id="monthly_payment" maxlength="8" disabled>
								</div>
								<div class="form-group">
									<h3>Итого к оплате: </h3>
									<input type="number" class="form-control" id="total_amount" maxlength="8" disabled>
								</div>
								<div class="form-group">
									<h3>Переплата: </h3>
									<input type="number" class="form-control" id="overpayment" maxlength="8" disabled>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
				<hr>
				<div class="col-sm-1"></div>
				<div class="col-sm-9" id="place">
				</div>
				<div class="col-sm-1"></div>
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
