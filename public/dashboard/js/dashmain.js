(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		console.log('ss');
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

	//inits
    $('[title]').tooltip();
    $('[data-toggle="popover"]').popover();
	$('.pdp').persianDatepicker();
	$('.select2').select2({
       width: '100%',
    });

	//are-you-sures
	$('.delete').click(function(){
		var htmlID = $(this).attr('data-target');
		var target = htmlID ? $('form#'+htmlID) : $(this).parents('form');
		swal({
			title: "آیا مطمئن هستید؟",
			text: "شما دیگر قادر به باز گردانی آن نخواهید بود!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "بله. پاک شود.",
			cancelButtonText: "لغو",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm) {
			if (isConfirm) {
				target.submit();
			} else {
				swal("عملیات لغو شد.", "اطلاعاتی پاک نشد", "error");
			}
		});
	});

})();
