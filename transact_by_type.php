<?php
	session_start();	
	include('db.php');
	global $db;
	$id = $_SESSION['user']['id'];
	$type=$_POST['type'];
	$type_select = $db->query("SELECT * FROM transactions LEFT JOIN transactions_type on transactions.type=transactions_type.id WHERE type='$type' and user_id=$id ORDER BY date DESC");
	while ($row1 = $type_select->fetch_assoc()) {  
		if ($row1['st_income_category']!="") {
			$d = $db->query("SELECT * FROM standart_incomes_categories WHERE id=".$row1['st_income_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		} elseif ($row1['st_expence_category']!="") {
			$d = $db->query("SELECT * FROM standart_expences_categories WHERE id=".$row1['st_expence_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		} elseif ($row1['user_income_category']!="") {										
			$d = $db->query("SELECT * FROM user_incomes_categories WHERE id=".$row1['user_income_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		} elseif ($row1['user_expence_category']!="") {
			$d = $db->query("SELECT * FROM user_expences_categories WHERE id=".$row1['user_expence_category']);
			while ($data = $d->fetch_assoc()) {	
				$categ=$data['name'];
			}
		}
	  echo "<tr class='table'><td>".$row1['id']."</td><td>".$row1['date']."</td><td>".$row1['name']."</td><td>".$row1['amount']."</td><td>".$categ."</td><td>".$row1['comment']."</td></tr>";
	}
?>