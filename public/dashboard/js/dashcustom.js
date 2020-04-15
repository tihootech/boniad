$(document).ready(function () {

	// change password modal
	$('#change-branch-password').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var id = button.data('branch-id');
		var name = button.data('branch-name');
		var modal = $(this);
		modal.find('#branch-name').text(name)
		modal.find('#branch-id-target').val(id);
	});

	// evaluation answers and indicators limit
	$('.eval-answer').on('input', function () {
		var value = Number($(this).val());
		var min = Number($(this).attr('min'));
		var max = Number($(this).attr('max'));
		if (value < min || value > max) {
			$(this).siblings('.indicator-limit-error').slideDown();
		}else {
			$(this).siblings('.indicator-limit-error').slideUp();
		}
	});

});
