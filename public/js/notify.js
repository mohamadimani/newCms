function confirmModal(title, message, okCallback){
	var el = '<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">\
				<div class="modal-dialog" role="document">\
					<div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
							<h4 class="modal-title" id="myModalLabel">' + title + '</h4>\
						</div>\
						<div class="modal-body">' + message + '</div>\
						<div class="modal-footer">\
							<button type="button" class="btn btn-default" data-dismiss="modal">انصرف</button>\
							<button type="button" class="btn btn-primary">تایید</button>\
						</div>\
					</div>\
				</div>\
			</div>';
	el = $(el);
	$('body').append(el);
	el.modal({});
	el.modal('show');
	el.on('click', '.btn-primary', function(){
		el.modal('hide');
		okCallback();
	});
}

function notify(message, type){
	var oldnotify = $('.notify-alert:last'),
		colors = {
		'warning': '#f88',
		'info': 'lightblue',
		'error': '#f80',
		'success': 'lightgreen'
	},
	bottom = oldnotify.length ? window.innerHeight - oldnotify[0].offsetTop : 0;
	type = colors[type]||colors['info'];
	var notify = $(
		'<div class="notify-alert" style="position:fixed; bottom:' + bottom + 'px; left:-100%; border:1px solid #222; margin: 2px; padding:10px 4px; background: ' + type + '">\
  				<i style="position: absolute;" class="glyphicon glyphicon-remove remove-notify"></i>\
  				<p style="margin:0; padding:0; padding-right: 15px;">' + message + '</p>\
		</div>');
	$('body').append(notify);
	notify.animate({
		'left': '0'
	}, 1000);
}

$(document).on('click', '.notify-alert > .remove-notify', function(e){
	$(this).parents('.notify-alert').fadeOut();
});