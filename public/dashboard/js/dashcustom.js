$(document).ready(function () {
	var messangers = $('.messanger .messages')
	messangers.animate({ scrollTop: messangers.prop("scrollHeight")}, 1000);
});


// clone and unclone
$(document).on('click', '[data-action=clone]', function () {
	var target = $($(this).data('target'));
	var row = target.find('[data-row]').first();
	var cloned = row.clone();
	cloned.find('input:not([data-keep=1])').val(null);
	cloned.appendTo(target);
});

$(document).on('click', '[data-action=unclone]', function () {
	var row = $(this).parents('[data-row]').first();
	var count = row.siblings('[data-row]').length;
	if (count) {
		row.remove();
	}
});


// check all
$(document).on('click','[data-check]',function () {
	var content = $(this).data('check');
	var target = $('#checked-ids');
	var checked = $(this).attr('data-checked');
	var reversed = checked == 1 ? 0 : 1;
	$('#checked-form > input.checked-input').remove();

	if (content == 'all') {
		$('[data-check]').toggleClass('fa-square-o fa-check-square-o').attr('data-checked', reversed);
	}else {
		$('[data-check=all]').removeClass('fa-check-square-o').addClass('fa-square-o').attr('data-checked', 0);
		$(this).toggleClass('fa-square-o fa-check-square-o').attr('data-checked', reversed);
	}

	$('[data-check]').each(function () {
		var id = $(this).attr('data-check');
		var val = $(this).attr('data-checked');
		if (id != 'all' && val==1) {
			$('#checked-form').append('<input type="hidden" class="checked-input" name="checked_ids[]" value="'+id+'">');
		}
	});

});


$(document).on('click', '[data-text-editor]', function () {
	var action = $(this).data('text-editor');
	var target = $(this).siblings('.text-editor');
	var val = target.val();
	var newVal = null;
	if (action == 'code') {
		newVal = val + '<pre class="prettyprint">\n\n</pre>\n';
	}
	if (action == 'paragraph') {
		newVal = val + '<p>\n\n</p>\n';
	}
	if (action == 'link') {
		newVal = val + '<a href="" target="_blank">  </a>';
	}
	target.val(newVal);
	target.focus();
});

$(document).on('submit', '.messanger-form', function (e) {
	e.preventDefault();
	var input = $(this).find('input[name=body]');
	var user_id = $(this).find('input[name=user_id]').val();
	var message_type = $(this).data('message-type');
	var body = input.val();
	var url = $(this).attr('action');
	var formdata = {body:body, user_id:user_id, message_type:message_type};
	var target = $(this).find('.messages');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	$.ajax({
		url: url,
		type: "POST",
		data: formdata,
		success: function(data){
			target.append(data);
			target.animate({ scrollTop: target.prop("scrollHeight")}, 1000);
			input.val(null);
		}
	});
});

$(document).on('change', '.text-editor-img', function () {

	var root = $('meta[name=root]').attr('content')

	var formdata = new FormData();
	if($(this).prop('files').length > 0){
        file =$(this).prop('files')[0];
        formdata.append("file", file);
    }

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	$.ajax({
		url: $(this).data('action'),
		type: "POST",
		data: formdata,
		contentType: false,
		cache: false,
		processData:false,
		success: function(data){
			var output = '\n<img src="'+root+'/'+data+'" alt="">\n';
			var currVal = $('.text-editor').val();
			$('.text-editor').val(currVal+output);
			$('.text-editor').focus();
		}
	});
})
