<?php
	session_start();	
	include('db.php');
	global $db;
	$id = $_SESSION['user']['id'];
	$date_select = $db->query("SELECT * FROM transactions LEFT JOIN transactions_type on transactions.type=transactions_type.id WHERE user_id=$id ORDER BY date DESC");
	while ($row1 = $date_select->fetch_assoc()) {  
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
		$dates[] = $row1['date'];		
		$names[] = $row1['name'];
		$amounts[] = $row1['amount'];
		$categories[] = $categ;
		
	}
	$datesJS = json_encode($dates); 
	$namesJS = json_encode($names);
	$amountsJS = json_encode($amounts, JSON_NUMERIC_CHECK);
	$categoriesJS = json_encode($categories);
?>