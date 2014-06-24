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

class print_lib {

	/**
	 * Setup the hooks.
	 */
	public function __construct() {

		add_shortcode( 'print_lib',    array( $this, 'print_lib_display' ) );
	}

	/**
	 * Handle the display of the svg_ shortcode.
	 *
	 * @return string HTML output
	 */
	public function print_lib_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
  <section class="lib-work">
    <?php 
      $thumbnails = get_posts(array('posts_per_page' => 9,'tag' => 'print'));
      foreach ($thumbnails as $thumbnail) {
        if ( has_post_thumbnail($thumbnail->ID)) {
          echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
          echo get_the_post_thumbnail($thumbnail->ID, 'thumbnail');
          echo '</a>';
        }
      }
    ?>
  </section>  
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
new print_lib();
