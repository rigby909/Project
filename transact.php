<?php
	session_start();	
	include('db.php');
	global $db;
	$id = $_SESSION['user']['id'];
	$r = $db->query("SELECT * FROM transactions LEFT JOIN transactions_type on transactions.type=transactions_type.id WHERE user_id=$id ORDER BY date DESC");
	while ($row = $r->fetch_assoc()) {  
		if ($row['st_income_category']!="") {
			$d = $db->query("SELECT * FROM standart_incomes_categories WHERE id=".$row['st_income_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		} elseif ($row['st_expence_category']!="") {
			$d = $db->query("SELECT * FROM standart_expences_categories WHERE id=".$row['st_expence_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		} elseif ($row['user_income_category']!="") {										
			$d = $db->query("SELECT * FROM user_incomes_categories WHERE id=".$row['user_income_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		} elseif ($row['user_expence_category']!="") {
			$d = $db->query("SELECT * FROM user_expences_categories WHERE id=".$row['user_expence_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		}
	  echo "<tr class='table'><td>".$row['tr_id']."</td><td>".$row['date']."</td><td>".$row['name']."</td><td>".$row['amount']."</td><td>".$categ."</td><td>".$row['comment']."</td></tr>";
	}
?>