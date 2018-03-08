<?php
/**
 * Class WSUWP_Web_Template
 */
class WSUWP_Web_Template {

	/**
	 * @var string The desired text to be prepended to the html TITLE element.
	 */
	var $html_title = 'University Communications';

	/**
	 * Add hooks.
	 */
	public function __construct() {
		add_action( 'template_redirect', array( $this, 'handle_template_request' ) );
		add_filter( 'nav_menu_css_class', array( $this, 'modify_current_nav_item' ), 7 );
	}

	/**
	 * When consuming a web template, there's no great way to mark an
	 * item in the nav menu as "current". This first attempt looks for
	 * the CSS class `template-current-nav` and translates that to
	 * `current-menu-item`. This is later translated to `current` by the
	 * Spine Parent Theme.
	 *
	 * @param array $classes Current list of nav menu classes.
	 *
	 * @return array Modified list of nav menu classes.
	 */
	public function modify_current_nav_item( $classes ) {
		if ( $this->is_template_request() && in_array( 'template-current-nav', $classes ) ) {
			return array( 'current-menu-item' );
		} elseif ( $this->is_template_request() && ( in_array( 'current-menu-item', $classes ) || in_array( 'current_page_parent', $classes ) ) ) {
			return array();
		}

		return $classes;
	}

	/**
	 * Determine if this is a template request.
	 *
	 * @return bool
	 */
	public function is_template_request() {
		if ( isset( $_SERVER['REQUEST_URI'] ) && 0 === strpos( $_SERVER['REQUEST_URI'], '/web-template/' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Title text to prepend in the header of the HTML.
	 *
	 * @return string Modified title text.
	 */
	public function set_html_title() {
		return esc_html( $this->html_title . ' | Washington State University' );
	}

	/**
	 * Look for and handle any requests made to the `/web-template/` URL so that a JSON object containing
	 * the two parts of the template can be returned. We force the resonse to 200 OK and die as soon as
	 * the JSON is output.
	 */
	public function handle_template_request() {
		global $wp_query;

		if ( $this->is_template_request() ) {
			if ( isset( $_GET['html_title'] ) ) {
				$this->html_title = $_GET['html_title'];
			}

			add_filter( 'spine_get_title', array( $this, 'set_html_title' ) );
			$pre = $this->build_pre_content();
			$post = $this->build_post_content();
			remove_filter( 'spine_get_title', array( $this, 'set_html_title' ) );

			status_header( 200 );
			$wp_query->is_404 = false;
			header( 'HTTP/1.1 200 OK' );
			header( 'Content-Type: application/json' );
			echo json_encode(
				array(
					'before_content' => $pre,
					'after_content' => $post,
				)
			);
			die( 0 );
		}
	}

	/**
	 * Build the HTML to be displayed before any additional content is added by the requesting page.
	 *
	 * @return string HTML content.
	 */
	private function build_pre_content() {
		ob_start();

		$site_name      = get_bloginfo( 'name' );
		$site_tagline   = get_bloginfo( 'description' );

		get_header();
		?>
		<main class="spine-page-default">
			<header class="ucomm-bookmark">
				<hgroup>
					<!-- Removed ?php echo esc_html( $site_name ); ?> and placed University <span class="addGray">Communications</span> to achieve split word colors -->
					<div class="site"><a href="<?php home_url(); ?>" title="<?php echo esc_attr( $site_name ); ?>" rel="home">University <span class="addGray">Communications</span></a></div>
					<div class="tagline"><a href="<?php home_url(); ?>" title="<?php echo esc_attr( $site_tagline ); ?>" rel="home"><?php echo esc_html( $site_tagline ); ?></a></div>
				</hgroup>
			</header>
			<section class="row single gutter marginalize-ends">
				<div class="column one">
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Build the HTML to be displayed after any additional content is added by the requesting page.
	 *
	 * @return string HTML content.
	 */
	private function build_post_content() {
		ob_start();
		?>
				</div>
			</section>
		</main>
		<?php
		get_footer();
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
new WSUWP_Web_Template();
