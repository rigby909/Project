<?php
	session_start();	
	include('db.php');
	global $db;
	$id = $_SESSION['user']['id'];
	$r = $db->query("SELECT * FROM templates WHERE user_id=$id");
	while ($row = $r->fetch_assoc()) {  
		echo strlen($row['day']);
		if (strlen($row['day'])==1) {$day='0'.$row['day'];} 
		else {$day=$row['day'];}
		$month = date("m");
		$year = date("Y");
		$today = date("Y-m-d");   
		$date = date($year."-".$month."-".$day); 
		$type = $row['type'];
		$amount = $row['amount'];
		$comment = $row['comment'];
		$st_expence_category = $row['st_expence_category'];
		if ($st_expence_category=='') $st_expence_category = 'NULL';
		$st_income_category = $row['st_income_category'];
		if ($st_income_category=='') $st_income_category = 'NULL';
		$user_income_category = $row['user_income_category'];
		if ($user_income_category=='') $user_income_category = 'NULL';
		$user_expence_category = $row['user_expence_category'];
		if ($user_expence_category=='') $user_expence_category = 'NULL';

		if ($today>=$date) {
			$d = $db->query("SELECT * FROM transactions WHERE comment='$comment' and user_id=$id and date='$date' and type=$type and amount=$amount");
			if (!(mysqli_num_rows($d) > 0)) {
				$db->query("INSERT INTO transactions (user_id, type, date, amount, st_income_category, st_expence_category, user_income_category, user_expence_category, comment) VALUES ($id, $type, '$date', '$amount', $st_income_category, $st_expence_category,$user_income_category, $user_expence_category, '$comment')");
				$u = $db->query("SELECT * FROM users_balance WHERE user_id=$id");
				if (mysqli_num_rows($u) > 0) {
					if ($type==1) {				
						$db->query("UPDATE users_balance SET balance=balance+$amount WHERE user_id=$id");
					} elseif ($type==2) {
						$db->query("UPDATE users_balance SET balance=balance-$amount WHERE user_id=$id");	
					}
				}	
			}  																									
		}
	}
?>