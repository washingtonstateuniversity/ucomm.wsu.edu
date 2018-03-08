<?php get_header(); ?>

	<main class="spine-page-default">

		<?php

		global $post;

		$site_name      = get_bloginfo( 'name' );
		$site_tagline   = get_bloginfo( 'description' );
		$first_category = get_the_category();
		$section_title  = get_the_category();
		?>

		<header class="ucomm-bookmark">
			<hgroup>
				<div class="site"><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $site_name ); ?>" rel="home">University <span class="addGray">Communications</span></a></div>
				<div class="tagline"><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $site_tagline ); ?>" rel="home"><?php echo esc_html( $site_tagline ); ?></a></div>
				<?php

				if ( spine_is_sub() ) {
					echo '	<div class="section">' . spine_section_meta( 'title' ) . '</div>';
				}

				if ( ( is_archive() || is_category() || is_single() ) && ! empty( $first_category ) && isset( $first_category[0]->cat_name ) ) {
					echo '	<div class="category">' . $first_category[0]->cat_name . '</div>';
				}

				if ( is_page() ) {
					echo '	<div class="page">' . get_the_title() . '</div>';
				}

				if ( is_single() ) {
					echo '	<div class="post">' . get_the_title() . '</div>';
				}

				?>
			</hgroup>
		</header>

		<section class="row single gutter pad-ends">

			<div class="column one">

				<?php woocommerce_content(); ?>

			</div><!--/column-->

		</section>

		<?php get_template_part( 'parts/footers' ); ?>

	</main>

<?php get_footer();
