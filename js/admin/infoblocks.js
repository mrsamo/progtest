$(document).ready(function() {

/* * *
	Функция сабмита редактирования инфоблока
* * */
$('.save_infoblock').click(function(){
	// Сабмитим форму редактирования инфоблока
	$('#editBlockForm').submit();
	return false;
});

});