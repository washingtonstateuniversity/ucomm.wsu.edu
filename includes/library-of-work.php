<?php
/**
 * Class UComm_Library_Of_Work
 */
class UComm_Library_Of_Work {

	/**
	 * Setup the hooks.
	 */
	public function __construct() {
		add_shortcode( 'ucomm_library', array( $this, 'display_library' ) );
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
		<nav class="library-nav">
			<ul>
			<?php
			global $post;
			$args = array( 'posts_per_page' => 12, 'tag' => $atts['tag'] );
			$myposts = get_posts( $args);
			foreach( $myposts as $post ) {
				setup_postdata($post);
				$thumbnail_id = get_post_thumbnail_id( $post->ID );
				$thumb_url = wp_get_attachment_image_src( $thumbnail_id );
				if ( is_array( $thumb_url ) ) {
					$thumb_url = $thumb_url[0];
				} else {
					$thumb_url = false;
				}
				?>
				<li class="lib" <?php if( $thumb_url ) { ?>style="background:url('<?php echo $thumb_url; ?>');" <?php } ?> >
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
new UComm_Library_Of_Work();
