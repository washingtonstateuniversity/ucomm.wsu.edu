<?php get_header(); ?>

	<main class="spine-page-default">

		<?php get_template_part( 'parts/headers' ); ?>
		<?php get_template_part( 'parts/featured-images' ); ?>

		<section class="row side-right gutter pad-ends">

			<div class="column one">

				<?php woocommerce_content(); ?>

			</div><!--/column-->

			<div class="column two">

				<?php get_sidebar(); ?>

			</div><!--/column two-->

		</section>

		<?php get_template_part( 'parts/footers' ); ?>

	</main>

<?php get_footer();
