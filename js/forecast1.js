$(function() {
	$('#forecast_start').on("click", function() {
		var amount = parseInt($('#income').val());
		if (amount=='') {
			alert ('Поле "Доход" не заполнено.');
		} else {
			var income = [];
			for (var i=1;i<=16; i++) {
				income[i] = parseInt($('#income'+i).val());
				if (isNaN(income[i])==false) {
					amount = amount-income[i];
				}
			}
			$('#forecast').css('display', 'inline-block');
			$('#free_money').val(amount);
			
			google.charts.load("current", {packages:["corechart"]});
			  google.charts.setOnLoadCallback(drawChart);
			  function drawChart() {
				var x2= [
					['Еда и напитки', income[1]],
					['Покупки',income[2]],
					['Счета', income[3]],
					['Кредит', income[4]],
					['Авто', income[5]],
					['Путешествия', income[6]],
					['Семья', income[7]],
					['Дом', income[8]],
					['Развлечения', income[9]],
					['Мобильная связь', income[10]],
					['Одежда', income[11]],
					['Домашние животные', income[12]],
					['Транспорт', income[13]],
					['Хобби', income[14]],
					['Здоровье', income[15]],
					['Аренда', income[16]],
					['Лишняя сумма', amount]
				];
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Категория');
				data.addColumn('number', 'Сумма');
				data.addRows(x2);
				var options = {
				  pieHole: 0.4,
				  backgroundColor: '#fafafa',
				  chartArea:{width:'100%',height:'100%'}
				};
				var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
				chart.draw(data, options);
			  }
		}
	});
});