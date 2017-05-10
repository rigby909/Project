<?php
	session_start();	
	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
	include('db.php');
	include('template.php');
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
								<li><a href="transactions.php" class="">Транзакции</a></li>
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
									<br>
									<input type="submit" name="new_submit" class="btn btn-default"/>
									<input type="reset" class="btn btn-default"/>
								</form>
								<?php
									if (isset($_POST['new_submit'])) {											
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
											$db->query("UPDATE users SET first_name='$n' WHERE id=$id");
											echo "<p>Изменено имя. Авторизуйтесь повторно, чтобы увидеть изменения.</p>\n";
										}
										if (trim($last_name)!="") {										
											$n = trim($last_name);
											$db->query("UPDATE users SET last_name='$n' WHERE id=$id");
											echo "<p>Изменена фамилия. Авторизуйтесь повторно, чтобы увидеть изменения.</p>\n";
										}
										if (trim($password)!="" && trim($password)==trim($password1)) {
											$n = trim($password);
											$db->query("UPDATE users SET password='$n' WHERE id=$id");
											echo "<p>Изменен пароль. Авторизуйтесь повторно, чтобы увидеть изменения.</p>\n";
										}
									}
								?>
								<hr>								
								<h1>Создайте шаблон для автоматических транзакций</h1><br>
								<form class="form" method="post">
									<div class="form-group">
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
										<h3>День месяца: </h3>
										<input type="number" name="day" id="day" class="form-control" placeholder="число от 1 до 30">
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
									<input type="submit" name="template_save" id="template_save" class="btn btn-default" value="Создать шаблон"/>
									<input type="reset" class="btn btn-default"/>
								</form>
								<?php
									if (isset($_POST['template_save'])) {											
										$day = $_POST['day'];
										$pattern = '/^([1-9]|[1][0-9]|[2][0-9]|[3][0])$/';
										if (!preg_match($pattern, $day)) {
											echo '<p>Поле "День месяца" заполнено неправильно.</p>';
											exit;
										} else {
											$type=$_POST['type'];
											$amount = $_POST['amount'];
											$comment = "template";
											$standart_incomes_categories = $_POST['standart_incomes_categories'];
											$user_incomes_categories = $_POST['user_incomes_categories'];
											$standart_expences_categories = $_POST['standart_expences_categories'];
											$user_expences_categories = $_POST['user_expences_categories'];
											if (($type!='') && ($amount!='') && ($day!='')) {
												if ($standart_incomes_categories!='') {
													$r = $db->query("SELECT id FROM standart_incomes_categories WHERE name='$standart_incomes_categories'");
													while ($data = $r->fetch_assoc()) {	
														$category=$data['id'];
													}
													$db->query("INSERT INTO templates (user_id, type, day, amount, st_income_category, comment) VALUES ($id, 1, '$day', '$amount', $category, '$comment')");		
													echo "<p>Сохранено.</p>\n";
													exit;
												}
												if ($user_incomes_categories!='') {
													$r = $db->query("SELECT id FROM user_incomes_categories WHERE name='$user_incomes_categories'");
													while ($data = $r->fetch_assoc()) {	
														$category=$data['id'];
													}
													$db->query("INSERT INTO templates (user_id, type, day, amount, user_income_category, comment) VALUES ($id, 1, '$day', '$amount', $category, '$comment')");		
													echo "<p>Сохранено.</p>\n";
													exit;
												}
												if ($standart_expences_categories!='') {
													$r = $db->query("SELECT id FROM standart_expences_categories WHERE name='$standart_expences_categories'");
													while ($data = $r->fetch_assoc()) {	
														$category=$data['id'];
													}
													$db->query("INSERT INTO templates (user_id, type, day, amount, st_expence_category, comment) VALUES ($id, 2, '$day', '$amount', $category, '$comment')");		
													echo "<p>Сохранено.</p>\n";
													exit;
												}
												if ($user_expences_categories!='') {
													$r = $db->query("SELECT id FROM user_expences_categories WHERE name='$user_expences_categories'");
													while ($data = $r->fetch_assoc()) {	
														$category=$data['id'];
													}
													$db->query("INSERT INTO templates (user_id, type, day, amount, user_expence_category, comment) VALUES ($id, 2, '$day', '$amount', $category, '$comment')");	
													echo "<p>Сохранено.</p>\n";
													exit;
												}		
											} else {
												echo "<p>Выберите тип транзакции, одну из категорий, введите сумму и день.</p>\n";
											}
										}
									}
								?>		
								<hr>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-10">
							<div class="block-content">
								<h1>		
									<?php 
										if (isset($_SESSION['user']))  {
											echo "Здравствуйте, ".$_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']."!";
										}
									?>
								</h1><br>
								<h1>Создайте свои категории доходов и расходов для будущих транзакций или используйте стандартные </h1><br>
								<form class="form" method="post">
									<br>
									<div class="form-group">
										<h3>Новая категория доходов: </h3>
										<input type="text" class="form-control" id="new_income_category" name="new_income_category" maxlength="25">	
									</div>
									<div class="form-group">
										<h3>Новая категория расходов: </h3>
										<input type="text" class="form-control" id="new_expence_category" name="new_expence_category" maxlength="25">	
									</div>
									<div class="form-group">
										<h3>Удалить собственную категорию доходов: </h3>
										<select class="form-control" name="user_incomes_categories">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM user_incomes_categories WHERE user_id=$id");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="delete_incomes_category" value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<h3>Удалить собственную категорию расходов: </h3>
										<select class="form-control" name="user_expences_categories">
											<option></option>
											<?php
												$c = $db->query("SELECT name FROM user_expences_categories WHERE user_id=$id");
												while ($data = $c->fetch_assoc()) {
													echo '<option name="delete_expences_category" "value="'.$data['name'].'">'.$data['name'].'</option>';
												}
											?>
										</select>
									</div><br><br>
									<input type="submit" name="categories_submit" class="btn btn-default" value="Сохранить"/>
								</form>
								<?php
									if (isset($_POST['categories_submit'])) {
										$new_income_category = $_POST['new_income_category'];
										$new_expence_category = $_POST['new_expence_category'];
										$delete_incomes_category = $_POST['user_incomes_categories'];
										$delete_expences_category = $_POST['user_expences_categories'];
										if (trim($new_income_category)!="") {
											$n = trim($new_income_category);
											$r = $db->query("SELECT name FROM user_incomes_categories WHERE user_id=$id");
											while ($data = $r->fetch_assoc()) {  
												if ($data['name'] == $n) {
												echo "<p>Вы уже создали такую категорию.</p>\n";
												exit;
												}
											}
											$db->query("INSERT INTO user_incomes_categories (user_id, name) VALUES ($id, '$n')");						
											echo "<p>Категория создана.</p>\n";
										}
										if (trim($new_expence_category)!="") {
											$n = trim($new_expence_category);
											$d = $db->query("SELECT name FROM user_expences_categories WHERE user_id=$id");
											while ($data = $d->fetch_assoc()) {  
												if ($data['name'] == $n) {
												echo "<p>Вы уже создали такую категорию.</p>\n";
												exit;
												}
											}
											$db->query("INSERT INTO user_expences_categories (user_id, name) VALUES ($id, '$n')");						
											echo "<p>Категория создана.</p>\n";
										}
										if (trim($delete_incomes_category!="")) {
											$db->query("DELETE FROM user_incomes_categories WHERE user_id=$id AND name='$delete_incomes_category'");
											echo "<p>Категория удалена.</p>\n";
										}
										if ($delete_expences_category!="") {
											$db->query("DELETE FROM user_expences_categories WHERE user_id=$id AND name='$delete_expences_category'");
											echo "<p>Категория удалена.</p>\n";
										}
									}
								?>
								<hr>
								<h1>Ваши шаблоны</h1><br>
								<?php
									$d = $db->query("SELECT * FROM templates LEFT JOIN transactions_type on templates.type=transactions_type.id WHERE user_id=$id");
									if (mysqli_num_rows($d) > 0) {
										echo "<table class='table'><tr><td colspan=6 style='font-weight:bold; text-align:center; text-transform:uppercase;'>Шаблоны транзакций</td></tr>";
										echo "<tr><th>id</th><th>день месяца</th><th>тип</th><th>сумма</th><th>категория</th><th>комментарий</th></tr>";
										while ($row = $d->fetch_assoc()) {	
											if ($row['st_income_category']!="") {
												$c = $db->query("SELECT * FROM standart_incomes_categories WHERE id=".$row['st_income_category']);
												while ($data = $c->fetch_assoc()) {	
													$categ=$data['name'];
												}
											} elseif ($row['st_expence_category']!="") {
												$c = $db->query("SELECT * FROM standart_expences_categories WHERE id=".$row['st_expence_category']);
												while ($data = $c->fetch_assoc()) {	
													$categ=$data['name'];
												}
											} elseif ($row['user_income_category']!="") {										
												$c = $db->query("SELECT * FROM user_incomes_categories WHERE id=".$row['user_income_category']);
												while ($data = $c->fetch_assoc()) {	
													$categ=$data['name'];
												}
											} elseif ($row['user_expence_category']!="") {
												$c = $db->query("SELECT * FROM user_expences_categories WHERE id=".$row['user_expence_category']);
												while ($data = $c->fetch_assoc()) {	
													$categ=$data['name'];
												}
											}
											echo "<tr class='table'><td>".$row['temp_id']."</td><td>".$row['day']."</td><td>".$row['name']."</td><td>".$row['amount']."</td><td>".$categ."</td><td>".$row['comment']."</td></tr>";
										}
										echo "</table>";
									} else {
										echo "<h3>Вы не создали ни одного шаблона.</h3>";
									}
								?><br>
								<form class="form" method="post">
								<div class="form-group">
									<h3>Удалить шаблон</h3>
									<h3>Номер: </h3>
									<input type="number" class="form-control" id="temp_id" name="temp_id" maxlength="25"/><br>
									<input type="submit" name="temp_delete" id="temp_delete" class="btn btn-default" value="Удалить"/>
								</div>
								</form>
								<?php
									if (isset($_POST['temp_delete'])) {
										$temp_id = $_POST['temp_id'];
										$r = $db->query("DELETE FROM templates WHERE temp_id='$temp_id'");
										echo "<p>Запись удалена.</p>\n";
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
