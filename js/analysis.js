$(document).ready(function() {
	$('#date_analysis').on("click", function(){
		$('chart_div').empty();
		var date1 = $('#date1').val();
		var date2 = $('#date2').val();
		var inc1 = $('#standart_incomes').val();
		var inc2 = $('#user_incomes').val();
		var exp1 = $('#standart_expences').val();
		var exp2 = $('#user_expences').val();
		
		$.ajax({
		  type: 'POST',
		  url: 'analysis_by_date.php',
		  data: {'date1':date1, 'date2':date2},
		  success: function(data) {
		  },
		});	
		var datesNew = [];
		var amountNew = [];
		var nameNew = [];
		var categoryNew= [];		
		var n=[];
		var j=0;
		var dataAmountIn = 0;
		var dataAmountExp = 0;
		var dataAmountInCateg = 0;
		var dataAmountExpCateg = 0;
		for (var i=0;i<=dates.length;i++) {
			if (dates[i]>=date1 && dates[i]<=date2) {
				datesNew[j]=dates[i];
				n[j]=i;
				j++;
			}
		}
		for (var i=0; i<=names.length;i++) {
			if (isNaN(n[i])==false) {
				nameNew[i]=names[n[i]];
			}
		}
		for (var i=0; i<=amounts.length;i++) {
			if (isNaN(n[i])==false) {
				amountNew[i]=amounts[n[i]];
				if (nameNew[i]=='income') {
					dataAmountIn+=amountNew[i];
				} else if (nameNew[i]=='expence') {
					dataAmountExp+=amountNew[i];
				}	
			}
		}
		for (var i=0; i<=categories.length;i++) {
			if (isNaN(n[i])==false) {
				categoryNew[i]=categories[n[i]];
				if ((inc1 !='') && (inc2 =='') && (categoryNew[i]==inc1)) {
					dataAmountInCateg+=amountNew[i];
				} else if ((inc2 !='') && (inc1 =='') && (categoryNew[i]==inc2)) {
					dataAmountInCateg+=amountNew[i];
				} else if ((exp1 !='') && (exp2 =='') && (categoryNew[i]==exp1)) {
					dataAmountExpCateg+=amountNew[i];
				} else if ((exp2 !='') && (exp1 =='') && (categoryNew[i]==exp2)) {
					dataAmountExpCateg+=amountNew[i];
				}
			}
		}
		google.charts.load("current", {packages:['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawChart);
		
		function drawChart() {
			if ((dataAmountInCateg !=0)||(dataAmountExpCateg != 0)) {
				var data = google.visualization.arrayToDataTable([
					 ['Тип', 'Сумма', { role: 'style' }],
					 ['Доходы', dataAmountInCateg, '#9575cd'],
					 ['Расходы', dataAmountExpCateg, 'silver']     
				]);
			} else {
				var data = google.visualization.arrayToDataTable([
						 ['Тип', 'Сумма', { role: 'style' }],
						 ['Доходы', dataAmountIn, '#9575cd'],
						 ['Расходы', dataAmountExp, 'silver']     
					]);
			}
			var options = {
			  backgroundColor: '#fafafa',
			  chartArea:{right:20, width:'88%',height:'80%'},
			  legend: {position: 'none'}
			};
			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		  }
	});
});
