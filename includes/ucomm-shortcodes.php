<?php
/**
 * Class UComm_Shortcodes
 */
class UComm_Shortcodes {
	/**
	 * Setup the hooks.
	 */
	public function __construct() {
		add_shortcode( 'call_action', array( $this, 'call_action_display' ) );
		add_shortcode( 'home_blog', array( $this, 'home_blog_display' ) );
	}

	/**
	 * Handle the display of the svg_ shortcode.
	 *
	 * @return string HTML output
	 */
	public function call_action_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
		<div class="callbox">
			<div class="fixme"><a class="call" href="mailto:consult.ucomm@wsu.edu?subject=marketing questions"><span class="ss-icon">mail</span> Contact our marketing consultants</a></div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Handle the display of the svg_ shortcode.
	 *
	 * @return string HTML output
	 */
	public function home_blog_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
		<ul class="blog-loop">
			<?php
			$args = array(
				'posts_per_page' => 4,
				'offset'=> 0,
				'post_type' => 'post',
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => 'home'
					),
				),
			);

			$my_posts = new WP_Query( $args );

			if ( $my_posts->have_posts() ) : while( $my_posts->have_posts() ) : $my_posts->the_post();
				?>
				<li class="nested-seperated">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<hgroup class="source">
						<?php
						// Published on
						/* $year = get_the_date('Y'); $day = get_the_date('j'); $month = get_the_date('F');
						echo '<time class="article-date" datetime="'.get_the_date( 'c' ).'">';
						echo '	<span class="month">'.$month.'</span>';
						echo '	<span class="day">'.$day.'</span>';
						echo '	<span class="year">'.$year.'</span>';
						echo '</time>'; */
						echo '<time class="article-date" datetime="'.get_the_date( 'c' ).'">';
						echo the_date();
						echo '</time>';

						// Published by
						$author = get_the_author();
						$author_articles = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
						echo ' <cite class="article-author" role="author"><a href="'.$author_articles.'">'.$author.'</a></cite>';
						?>
					</hgroup>
					<span class="blog-excerpt"><?php the_excerpt(); ?></span>
					<span class="blog-cattag"><?php the_tags( 'Tags: ', ', ', ''); ?></span>
				</li>
			<?php endwhile; endif;
			wp_reset_query();
			?>

		</ul>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
new UComm_Shortcodes();