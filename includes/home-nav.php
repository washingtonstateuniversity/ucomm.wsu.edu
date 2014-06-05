<?php
/*
Plugin Name: WSU UComm nav home
Plugin URI: http://ucomm.wsu.edu/
Description: Allows users to register for assets.
Author: washingtonstateuniversity, jeremyfelt
Author URI: http://web.wsu.edu/
Version: 0.1.3
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

class home_nav {

	/**
	 * Setup the hooks.
	 */
	public function __construct() {

		add_shortcode( 'home_nav',    array( $this, 'home_nav_display' ) );
	}

	/**
	 * Handle the display of the svg_ shortcode.
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
        <h3>Printed material</h3>
        <li class="descripto">Want your print publications get noticed, read, and remembered? We’ll work with you to strategically plan print pieces that work hard to build awareness of your initiatives and shape audience attitudes.</li> </ul></a></li>
      <li class="presentations"><a href="/presentations/"> <ul class="label">
        <h3>Presentations</h3>
        <li class="descripto">Deliver your message with clarity and impact, while leveraging the strength of the <span class="addcrimson">WSU</span> brand.</li> </ul></a></li>
      <li class="photo"><a href="/print/"> <ul class="label">
        <h3>Photography + video</h3>
        <li class="descripto">Want your print publications get noticed, read, and remembered? We’ll work with you to strategically plan print pieces that work hard to build awareness of your initiatives and shape audience attitudes.</li> </ul></a></li>
    </ul>
  </nav>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
new home_nav();
