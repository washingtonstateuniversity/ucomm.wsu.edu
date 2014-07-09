<?php get_template_part( 'spine' ); ?>

</div><!--/cover-->
</div><!--/jacket-->

<?php get_template_part('parts/contact'); ?> 

<?php wp_footer(); ?>
<script>
(function($){
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
		var top,call_top;
		call_top = $('.fixme').scrollTop();
		top = $(document).scrollTop();
		if(top>call_top){
			$('.fixme').addClass('fixed');
		} else {
			$('.fixme').removeClass('fixed');
		}
	});
}(jQuery));
</script>
</body>
</html>