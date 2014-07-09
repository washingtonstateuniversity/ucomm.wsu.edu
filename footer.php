<?php get_template_part( 'spine' ); ?>

</div><!--/cover-->
</div><!--/jacket-->

<?php get_template_part('parts/contact'); ?> 

<?php wp_footer(); ?>
<script>
(function($){
	var fixed_section_top = jQuery('#fixedSide').parents('section').position().top;

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
		if( top > ( fixed_section_top - 35 ) ){
			fixme.addClass('fixed');
		} else {
			fixme.removeClass('fixed');
		}
	});
}(jQuery));
</script>
</body>
</html>