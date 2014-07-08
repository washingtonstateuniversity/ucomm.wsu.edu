(function($){

	function display_modal_data( data ) {
		var html = '<div class="content-modal">';
		html += '<h1>' + data.title + '</h1>';
		html += data.content;
		html += '</div>';
		$('body' ).append(html);
	}

	function pull_modal_data(e) {
		e.preventDefault();
		var post_id = $(this).attr('data-post-id');
		var post_url = window.UComm_Data.json_api_url + 'posts/' + post_id;
		$.getJSON( post_url, display_modal_data );
	}

	$('.library-nav' ).on('click','a', pull_modal_data );
}(jQuery));
