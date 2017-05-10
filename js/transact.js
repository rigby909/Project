$(document).ready(function() {
	$('#all_transactions').on("click", function(){
		$('#transactions_table').css('display', 'inline-block');
		$('tr.table').remove();
		$.ajax({
		  type: 'POST',
		  url: 'transact.php',
		  success: function(data) {
			$('#transactions_table').append(data);
		  },
		  
		});
	});
	$('#date_transactions').on("click", function(){
		var date1 = $('#date1').val();
		var date2 = $('#date2').val();
		$('tr.table').remove();
		$('#transactions_table').css('display', 'inline-block');
		$.ajax({
		  type: 'POST',
		  url: 'transact_by_date.php',
		  data: {'date1':date1, 'date2':date2},
		  success: function(data) {
			$('#transactions_table').append(data);
		  },
		});	
	});
	$('#type_transactions').on("click", function(){
		$('tr.table').remove();
		$('#transactions_table').css('display', 'inline-block');
		var type = $('#incomes_or_expences').val();
		$.ajax({
		  type: 'POST',
		  url: 'transact_by_type.php',
		  data: {'type':type},
		  success: function(data) {
			$('#transactions_table').append(data);
		  },
		});	
	});
});
