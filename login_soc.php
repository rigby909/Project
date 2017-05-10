<?php 
	session_start();
	$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
	$user = json_decode($s, true);
	//$user['network'] - соц. сеть, через которую авторизовался пользователь
	//$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
	//$user['first_name'] - имя пользователя
	//$user['last_name'] - фамилия пользователя   
	
	if (isset ($user)) {
		$first_name = $user['first_name'];
		$last_name = $user['last_name'];
		$identity = $user['identity'];
		include("db.php");
		$r = $db->query("SELECT * FROM users WHERE identity='$identity'");
		if (mysqli_num_rows($r) > 0) {
			while ($data = $r->fetch_assoc()) {	
				$_SESSION['user'] = $data;
			}
		} else {
			$db->query("INSERT INTO users (first_name, last_name, auth_via, identity) VALUES ('$first_name', '$last_name', 2, '$identity')");
			$r = $db->query("SELECT * FROM users WHERE identity='$identity'");
			while ($data = $r->fetch_assoc()) {	
				$_SESSION['user'] = $data;
			}
		}
		header("Location: cabinet.php");
			exit;
	}
?>