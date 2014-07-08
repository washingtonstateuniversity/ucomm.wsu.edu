(function($){

	function display_modal_data( data ) {
		var html = '<div class="content-modal"><div class="content-modal-content"><div class="content-modal-close"><span class="ss-icon">Close</span></div>' +
			'<section class="row single"><div class="column one">' +
			'<article><header class="article-header"><h1 class="article-title">' +
			data.title +
			'</h1></header><div class="article-body">' +
			data.content +
			'</div></article>' +
			'</div></section></div></div>';
		$('body' ).append(html);
		$('.content-modal-close' ).on('click', function(e) {
			$('.content-modal' ).remove();
		});
	}

	function pull_modal_data(e) {
		e.preventDefault();
		var post_id = $(this).attr('data-post-id');
		var post_url = window.UComm_Data.json_api_url + 'posts/' + post_id;
		$.getJSON( post_url, display_modal_data );
	}

	$('.library-nav' ).on('click','a', pull_modal_data );
}(jQuery));
