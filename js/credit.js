$(document).ready(function() {
	$('#calc_start').on("click", function(){
		$('#credit_table').remove();
		if ($('#credit_amount').val()!='' && $('#credit_percent').val()!='' && $('#credit_date').val()!='') {
			var creditAmount = $('#credit_amount').val();
			var percentDuringAYear = ($('#credit_percent').val())/100/12;
			var creditDate = ($('#credit_date').val());
			var m1 = creditAmount*percentDuringAYear;
			var m2 = 1-(1/(Math.pow(1+percentDuringAYear, creditDate)));
			var monthlyPayment = m1/m2;
			var totalAmount = creditDate*monthlyPayment;
			var overpayment = totalAmount-creditAmount;
			
			$('#result').css('display', 'inline-block');
			$('#monthly_payment').val(monthlyPayment.toFixed(2));
			$('#total_amount').val(totalAmount.toFixed(2));
			$('#overpayment').val(overpayment.toFixed(2));
			
			var month = 0;
			var amount = creditAmount;
			var allPayment = 0;
			var percent = amount*percentDuringAYear;
			var payment = 0;
			$('<table></table>').addClass('table').attr('id','credit_table').appendTo('#place');
			$('#credit_table').append("<tr><td colspan='5' style='font-weight:bold; text-align:center; text-transform:uppercase;'"+">График платежей по кредиту"+
				"</td></tr><tr><th>месяц</th><th>основной долг</th><th>сумма взноса</th><th>проценты</th><th>выплата основного долга<th></tr>");
			$('#credit_table').append("<tr><td>"+month+"</td><td>"+amount+"</td><td>"+allPayment+"</td><td>"+percent.toFixed(2)+
				"</td><td>"+payment+"</td></tr>");
			
			for (month=1; month<=creditDate;month++) {
				allPayment = monthlyPayment;
				percent = amount*percentDuringAYear;
				payment = allPayment-percent;
				amount = amount-payment;
				$('#credit_table').append("<tr><td>"+month+"</td><td>"+amount.toFixed(2)+"</td><td>"+allPayment.toFixed(2)+"</td><td>"
					+percent.toFixed(2)+"</td><td>"+payment.toFixed(2)+"</td></tr>");	
			}

		} else {
			alert("Вы заполнили не все поля. Попробуйте заново.");
		}
	});
	$('#calc_stop').on("click", function(){
		$('#result').css('display', 'none');
		$('#credit_table').remove();
	});
});