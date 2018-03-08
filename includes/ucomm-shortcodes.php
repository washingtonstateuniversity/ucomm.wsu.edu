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
		add_shortcode( 'home_nav', array( $this, 'home_nav_display' ) );
		add_shortcode( 'print_blog', array( $this, 'print_blog_display' ) );
		add_shortcode( 'ucomm_library', array( $this, 'display_library' ) );
	}

	/**
	 * Handle the display of the call_action shortcode.
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
	 * Handle the display of the home_blog shortcode, which displays a list of
	 * blog posts on the static home page.
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
				'offset' => 0,
				'post_type' => 'post',
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => 'home',
					),
				),
			);

			$my_posts = new WP_Query( $args );

			if ( $my_posts->have_posts() ) : while ( $my_posts->have_posts() ) : $my_posts->the_post();
				?>
				<li class="nested-seperated">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<hgroup class="source">
						<time class="article-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
						<cite class="article-author" role="author"><?php the_author_posts_link(); ?></cite>
					</hgroup>
					<span class="blog-excerpt"><?php the_excerpt(); ?></span>
					<span class="blog-cattag"><?php the_tags( 'Tags: ', ', ', '' ); ?></span>
				</li>
			<?php endwhile;
endif;
			wp_reset_query();
			?>

		</ul>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Handle the display of the home_nav shortcode.
	 *
	 * @return string HTML output
	 */
	public function home_nav_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
		<nav>
			<ul>
				<li class="metroTitle"> <ul class="label">
						<h2>Design + production</h2>
					</ul></li>
				<li class="web"><a href="/web/"> <ul class="label">
							<h3>Web + social media</h3>
							<li class="descripto">University Communications creates compelling websites that deliver the messages you want and the information readers seek.</li> </ul></a></li>
				<li class="email"><a href="/email/"> <ul class="label">
							<h3>Email</h3>
							<li class="descripto">Email is the #1 activity on smartphones and tablets, according to Pew Research. University Communications writes and designs emails that captivate readers on the full range of devices.</li> </ul></a></li>
				<li class="printed"><a href="/print/"> <ul class="label">
							<h3>Printed materials</h3>
							<li class="descripto">Want your print publications to get noticed, read, and remembered? We’ll work with you to strategically plan print pieces that build awareness of your initiatives and shape audience attitudes.</li> </ul></a></li>
				<li class="presentations"><a href="/presentations/"> <ul class="label">
							<h3>Presentations</h3>
							<li class="descripto">Deliver your message with clarity and impact, while leveraging the strength of the WSU brand.</li> </ul></a></li>
				<li class="photo"><a href="/photos-video/"> <ul class="label">
							<h3>Photography + video</h3>
							<li class="descripto">The work of University Communications photographers and videographers entertains and educates while advancing the WSU brand.</li> </ul></a></li>
			</ul>
		</nav>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Handle the display of the print_blog shortcode.
	 *
	 * @return string HTML output
	 */
	public function print_blog_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
		<ul class="blog-loop">
			<?php
			$args = array(
				'posts_per_page' => 4,
				'offset' => 0,
				'post_type' => 'post',
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => 'print',
					),
				),
			);

			$my_posts = new WP_Query( $args );

			if ( $my_posts->have_posts() ) : while ( $my_posts->have_posts() ) : $my_posts->the_post();
				?>
				<li class="nested-seperated">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<span class="blog-excerpt"><?php the_excerpt(); ?></span>
					<span class="blog-cattag"><?php the_tags( 'Tags: ', ', ', '' ); ?></span>
				</li>
			<?php endwhile;
endif;
			wp_reset_query();
			?>

		</ul>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Display output for the library of work shortcode.
	 *
	 * @param array $atts Attributes passed with the shortcode.
	 *
	 * @return string HTML output
	 */
	public function display_library( $atts ) {
		// Look for a tag, use email by default.
		$atts = shortcode_atts( array( 'tag' => 'email' ), $atts );

		// Make sure it looks like a slug.
		$atts['tag'] = sanitize_key( $atts['tag'] );

		// Build the output to return for use by the shortcode.
		ob_start();
		?>
		<nav class="library-nav library-<?php echo esc_attr( $atts['tag'] ); ?>">
			<ul>
				<?php
				global $post;
				$args = array(
					'posts_per_page' => 12,
					'tag' => $atts['tag'],
				);
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) {
					setup_postdata( $post );
					$thumbnail_id = get_post_thumbnail_id( $post->ID );
					$thumb_url = wp_get_attachment_image_src( $thumbnail_id );
					if ( is_array( $thumb_url ) ) {
						$thumb_url = $thumb_url[0];
					} else {
						$thumb_url = false;
					}
					?>
					<li class="lib" <?php if ( $thumb_url ) { ?>style="background:url('<?php echo esc_url( $thumb_url ); ?>');" <?php } ?> >
						<a class="modal" data-post-id="<?php echo $post->ID; ?>" href="<?php echo get_permalink( $post->ID ); ?>" title="<?php echo esc_attr( $post->post_title ); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
					</li>
				<?php } ?>
			</ul>
		</nav>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
new UComm_Shortcodes();
