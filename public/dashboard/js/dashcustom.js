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

	// indicators range input
	$('.indicator').on('input', function () {
		var value = $(this).val();
		$(this).parents('.row').find('.result').html(value);
	});

});
