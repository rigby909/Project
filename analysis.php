<?php
	session_start();	
	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
	include('db.php');
	include('analysis_by_date.php');
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
		<script> 
			var dates = <?php echo $datesJS; ?>;
			var names = <?php echo $namesJS; ?>;
			var amounts = <?php echo $amountsJS; ?>;
			var categories = <?php echo $categoriesJS; ?>;
		</script>
    </head>
    <body>
	<script src="js/analysis.js"></script>
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
									</div>
									<div class="form-group" id="by_type">
										<h3>Тип платежа: </h3>
										<div class="radio" name="expence_type" id="expence_type">
											<label><input type="radio" name="type" value="0" onchange="check()" checked>Любой</label>
										</div>
										<div class="radio" name="expence_type" id="expence_type">
											<label><input type="radio" name="type" value="2" onchange="check()">Расходы</label>
										</div>
										<div class="radio" name="income_type" id="income_type">
											<label><input type="radio" name="type" value="1" onchange="check()">Доходы</label>
										</div>
										<script>
											function check(){
											  var radio=document.getElementsByName("type");
											  if (radio[0].checked) {
												$('#standart_incomes_categories').css('display', 'none');
												$('#user_incomes_categories').css('display', 'none');
												$('#standart_expences_categories').css('display', 'none');
												$('#user_expences_categories').css('display', 'none');
											  } else if (radio[1].checked){
												$('#standart_incomes_categories').css('display', 'none');
												$('#user_incomes_categories').css('display', 'none');
												$('#standart_expences_categories').css('display', 'inline-block');
												$('#user_expences_categories').css('display', 'inline-block');
											  } else if (radio[2].checked){
												$('#standart_expences_categories').css('display', 'none');
												$('#user_expences_categories').css('display', 'none');
												$('#standart_incomes_categories').css('display', 'inline-block');
												$('#user_incomes_categories').css('display', 'inline-block');
											 }
											}
										</script>
									</div>	
									<div class="form-group" style="display:none;" id="standart_incomes_categories">
										<h3>Выбрать категорию дохода: </h3>
										<select class="form-control" id="standart_incomes">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM standart_incomes_categories");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="st_incomes_category" value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div>
									<div class="form-group" style="display:none;" id="user_incomes_categories">
										<h3>Ваши категории доходов: </h3>
										<select class="form-control" id="user_incomes">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM user_incomes_categories WHERE user_id=$id");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="u_incomes_category" value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div>										
									<div class="form-group" style="display:none;" id="standart_expences_categories">
										<h3>Выбрать категорию расходов: </h3>
										<select class="form-control" id="standart_expences">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM standart_expences_categories");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="st_expences_category" value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div>								
									<div class="form-group" style="display:none;" id="user_expences_categories">
										<h3>Ваши категории расходов: </h3>
										<select class="form-control" id="user_expences">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM user_expences_categories WHERE user_id=$id");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="u_expences_category" "value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div><br>
									<input type="button" name="date_analysis" id="date_analysis" class="btn btn-default" value="Показать"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
								<h1>Настройте обзор по фильтрам и получайте информацию в режиме онлайн<h1><br>
								<div id="chart_div"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<hr>
					<div class="col-sm-3"></div>
					<div class="col-sm-9" id="place">
					</div>					
					<div class="col-sm-3"></div>
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
