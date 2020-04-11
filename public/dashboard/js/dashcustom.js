$(document).ready(function () {
	$('.indicator').on('input', function () {
		var value = $(this).val();
		$(this).parents('.row').find('.result').html(value);
	});
});
