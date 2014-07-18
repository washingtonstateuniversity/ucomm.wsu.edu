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

class announce {

	/**
	 * Setup the hooks.
	 */
	public function __construct() {

		add_shortcode( 'announce',    array( $this, 'announce_display' ) );
	}

	/**
	 * Handle the display of the svg_ shortcode.
	 *
	 * @return string HTML output
	 */
	public function announce_display() {
		// Build the output to return for use by the shortcode.
		ob_start();
		?>
	<div id="video-background">
	</div>		
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
new announce();