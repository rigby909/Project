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
		<script src="js/transact.js"></script>
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
								<li class="active"><a href="transactions.php" class="">Транзакции</a></li>
								<li><a href="analysis.php" class="">Анализ</a></li>
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
							<h1>Транзакции</h1>
							<h2>Ваш личный кошелек</h2>
						</div>
						<div class="block-content"><br>
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<form class="form" method="post">
									<div class="form-group">
										<h1>Добавить запись</h1><br>
										<h3>Тип платежа: </h3>
										<div class="radio" name="expence_type" id="expence_type">
											<label><input type="radio" name="type" value="2" onchange="check()">Расходы</label>
										</div>
										<div class="radio" name="income_type" id="income_type">
											<label><input type="radio" name="type" value="1" onchange="check()">Доходы</label>
										</div>
										<script>
											function check(){
											  var radio=document.getElementsByName("type");
											  if (radio[0].checked){
												$('#standart_incomes_categories').css('display', 'none');
												$('#user_incomes_categories').css('display', 'none');
												$('#standart_expences_categories').css('display', 'inline-block');
												$('#user_expences_categories').css('display', 'inline-block');
											  } else if (radio[1].checked){
												$('#standart_expences_categories').css('display', 'none');
												$('#user_expences_categories').css('display', 'none');
												$('#standart_incomes_categories').css('display', 'inline-block');
												$('#user_incomes_categories').css('display', 'inline-block');
											 }
											}
										</script>
									</div>
									<div class="form-group">
										<h3>Сумма: </h3>
										<input type="number" class="form-control" id="amount" name="amount" maxlength="25">
									</div>									
									<div class="form-group">
										<h3>Дата: </h3>
										<input type="date" name="date" id="date" class="form-control" value="<?php echo date("Y-m-d");?>" min="2017-01-01" max="<?php echo date("Y-m-d");?>">
									</div>
									<div class="form-group">
										<h3>Комментарий: </h3>
										<input type="text" class="form-control" id="comment" name="comment" maxlength="30">	
									</div>
									<div class="form-group" style="display:none;" id="standart_incomes_categories">
										<h3>Выбрать категорию дохода: </h3>
										<select class="form-control" name="standart_incomes_categories">
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
										<select class="form-control" name="user_incomes_categories">
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
										<select class="form-control" name="standart_expences_categories">
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
										<select class="form-control" name="user_expences_categories">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM user_expences_categories WHERE user_id=$id");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="u_expences_category" "value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div><br>									
									<input type="submit" name="transaction_save" id="transaction_save" class="btn btn-default" value="Сохранить"/>
									<input type="reset" class="btn btn-default"/>
								</form><hr>
								<form class="form" method="post">
								<div class="form-group">
									<h1>Удалить запись:</h1><br>
									<h3>Номер: </h3>
									<input type="number" class="form-control" id="tr_id" name="tr_id" maxlength="25">
								</div><br>
									<input type="submit" name="transaction_delete" id="transaction_delete" class="btn btn-default" value="Удалить"/>
								</form>
								<?php
									if (isset($_POST['transaction_save'])) {	
										$type=$_POST['type'];
										$amount = $_POST['amount'];
										$date = $_POST['date'];
										$comment = $_POST['comment'];
										$standart_incomes_categories = $_POST['standart_incomes_categories'];
										$user_incomes_categories = $_POST['user_incomes_categories'];
										$standart_expences_categories = $_POST['standart_expences_categories'];
										$user_expences_categories = $_POST['user_expences_categories'];
										if (($type!='') && ($amount!='') && ($date!='')) {
											if ($standart_incomes_categories!='') {
												$r = $db->query("SELECT id FROM standart_incomes_categories WHERE name='$standart_incomes_categories'");
												while ($data = $r->fetch_assoc()) {	
													$category=$data['id'];
												}
												$db->query("INSERT INTO transactions (user_id, type, date, amount, st_income_category, comment) VALUES ($id, 1, '$date', '$amount', $category, '$comment')");	
												$d = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
												if (mysqli_num_rows($d) > 0) {
													$db->query("UPDATE users_balance SET balance=balance+$amount WHERE user_id=$id");						
												} else {											
													$db->query("INSERT INTO users_balance (user_id, balance) VALUES ($id, 0)");	
													$db->query("UPDATE users_balance SET balance=balance+$amount WHERE user_id=$id");																			
												}				
												echo "<p>Сохранено.</p>\n";
												exit;
											}
											if ($user_incomes_categories!='') {
												$r = $db->query("SELECT id FROM user_incomes_categories WHERE name='$user_incomes_categories'");
												while ($data = $r->fetch_assoc()) {	
													$category=$data['id'];
												}
												$db->query("INSERT INTO transactions (user_id, type, date, amount, user_income_category, comment) VALUES ($id, 1, '$date', '$amount', $category, '$comment')");	
												$d = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
												if (mysqli_num_rows($d) > 0) {
												$db->query("UPDATE users_balance SET balance=balance+$amount WHERE user_id=$id");						
												} else {											
													$db->query("INSERT INTO users_balance (user_id, balance) VALUES ($id, 0)");	
													$db->query("UPDATE users_balance SET balance=balance+$amount WHERE user_id=$id");																			
												}				
												echo "<p>Сохранено.</p>\n";
												exit;
											}
											if ($standart_expences_categories!='') {
												$r = $db->query("SELECT id FROM standart_expences_categories WHERE name='$standart_expences_categories'");
												while ($data = $r->fetch_assoc()) {	
													$category=$data['id'];
												}
												$db->query("INSERT INTO transactions (user_id, type, date, amount, st_expence_category, comment) VALUES ($id, 2, '$date', '$amount', $category, '$comment')");	
												$d = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
												if (mysqli_num_rows($d) > 0) {
													$db->query("UPDATE users_balance SET balance=balance-$amount WHERE user_id=$id");						
												} else {											
													$db->query("INSERT INTO users_balance (user_id, balance) VALUES ($id, 0)");	
													$db->query("UPDATE users_balance SET balance=balance-$amount WHERE user_id=$id");																			
												}				
												echo "<p>Сохранено.</p>\n";
												exit;
											}
											if ($user_expences_categories!='') {
												$r = $db->query("SELECT id FROM user_expences_categories WHERE name='$user_expences_categories'");
												while ($data = $r->fetch_assoc()) {	
													$category=$data['id'];
												}
												$db->query("INSERT INTO transactions (user_id, type, date, amount, user_expence_category, comment) VALUES ($id, 2, '$date', '$amount', $category, '$comment')");	
												$d = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
												if (mysqli_num_rows($d) > 0) {
												$db->query("UPDATE users_balance SET balance=balance-$amount WHERE user_id=$id");						
												} else {											
													$db->query("INSERT INTO users_balance (user_id, balance) VALUES ($id, 0)");	
													$db->query("UPDATE users_balance SET balance=balance-$amount WHERE user_id=$id");																			
												}				
												echo "<p>Сохранено.</p>\n";
												exit;
											}
											
										} else {
											echo "<p>Выберите тип транзакции, одну из категорий, введите сумму и дату.</p>\n";
										}
									}
									if (isset($_POST['transaction_delete'])) {
										$tr_id = $_POST['tr_id'];
										$r = $db->query("SELECT * FROM transactions WHERE tr_id='$tr_id'");
										while ($data = $r->fetch_assoc()) {	
											$type = $data['type'];
											$amount = $data['amount'];
											$d = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
											if ((mysqli_num_rows($d) > 0) && ($type==1)) {
												$db->query("UPDATE users_balance SET balance=balance-$amount WHERE user_id=$id");
											} elseif ((mysqli_num_rows($d) > 0) && ($type==2)) {
												$db->query("UPDATE users_balance SET balance=balance+$amount WHERE user_id=$id");
											}
										}
										$r = $db->query("DELETE FROM transactions WHERE tr_id='$tr_id'");
										echo "<p>Запись удалена.</p>\n";
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
							<h1>Создайте новую запись или просмотрите актуальную информацию о Ваших доходах и расходах<h1><br>							
							<form class="form" id="settings" method="post">
							<div class="form-group">
								<h3>Текущий баланс: </h3>
								<?php 
								$c = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
									while ($data = $c->fetch_assoc()) {
										$balance = $data['balance'];
									}
								?>
								<input type="text" disabled class="form-control" id="balance" name="balance" placeholder="<?php echo $balance;?>">	
							</div><hr>
							<h1>Настроить отображение</h1><br>
								<div class="form-group">
									<input type="button" name="all_transactions" id="all_transactions" class="btn btn-default" value="Показать все записи"/>
								</div><hr>
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
							</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<hr>
					<div class="col-sm-3"></div>
					<div class="col-sm-9" id="place">
						<table class="table" id="transactions_table" name="transactions_table" style="display:none;">
							<tr>
								<td colspan=6 style="font-weight:bold; text-align:center; text-transform:uppercase;">Таблица доходов и расходов</td>
							</tr>
							<tr>
								<th>id</th>
								<th>дата</th>
								<th>тип</th>
								<th>сумма</th>
								<th>категория</th>
								<th>комментарий</th>
							</tr>
						</table>
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
