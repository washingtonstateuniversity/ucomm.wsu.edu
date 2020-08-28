</div><!--/cover-->
</div><!--/jacket-->

<?php get_template_part( 'parts/contact' ); ?> 

<?php wp_footer(); ?>
<script>
(function($){
	var fixed_side = jQuery('#fixedSide');

	if ( 0 === fixed_side.length ) {
		return;
	}

	var fixed_section_top = fixed_side.parents('section').position().top;
	var fixed_section_width = fixed_side.width();

	$( ".mainAccordion" ).accordion({ heightStyle: "content" });

	$('#fixedSide' ).on('click','a[href*=#]:not([href=#])', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({ scrollTop: target.offset().top }, 1000);
				return false;
			}
		}
	});

	$(document).on('scroll',function(){
		var top;
		var fixme = $('.fixme');

		top = $(document).scrollTop();
		if( top > ( fixed_section_top - 50 ) ){
			fixme.addClass('fixed');
			fixme.css('width', fixed_section_width + 'px');
		} else {
			fixme.removeClass('fixed');
			fixme.css('width','');
		}
	});
}(jQuery));
</script>
</body>
</html>
