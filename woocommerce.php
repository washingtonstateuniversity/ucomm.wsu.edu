<?php get_header(); ?>

	<main class="spine-page-default">

		<?php get_template_part( 'parts/headers' ); ?>

		<section class="row single gutter pad-ends">

			<div class="column one">

				<?php woocommerce_content(); ?>

			</div><!--/column-->

		</section>

		<?php get_template_part( 'parts/footers' ); ?>

	</main>

<?php get_footer();
