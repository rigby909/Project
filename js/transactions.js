$(document).ready(function() {
	function check(){
	  var radio=document.getElementsByName("type");
	  if (radio[0].checked){
	  alert("ht");
		$('#standart_expences_categories').css('display', 'inline-block');
		$('#user_expences_categories').css('display', 'inline-block');
	  } else if (radio[1].checked){
		$('#standart_incomes_categories').css('display', 'inline-block');
		$('#user_incomes_categories').css('display', 'inline-block');
	 }
	}
});