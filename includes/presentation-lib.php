<?php
/*
Plugin Name: WSU UComm Call to Action
Plugin URI: http://ucomm.wsu.edu/
Description: Allows users to register for assets.
Author: washingtonstateuniversity, jeremyfelt
Author URI: http://web.wsu.edu/
Version: 0.1.3
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

class presentation_lib {

	/**
	 * Setup the hooks.
	 */
	public function __construct() {

		add_shortcode( 'presentation_lib',    array( $this, 'presentation_lib_display' ) );
	}

	/**
	 * Handle the display of the svg_ shortcode.
	 *
	 * @return string HTML output
	 */
	public function presentation_lib_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
			<nav>
						<ul>
				        <?php
						global $post;
						$args = array( 'posts_per_page' => 12, 'tag' => 'presentations' );
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
								<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php echo esc_attr( $post->post_title ); ?>">
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
new presentation_lib();
