<?php
/**
 * Class UComm_Shortcodes
 */
class UComm_Shortcodes {
	/**
	 * Setup the hooks.
	 */
	public function __construct() {
		add_shortcode( 'call_action',    array( $this, 'call_action_display' ) );
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
}
new UComm_Shortcodes();
