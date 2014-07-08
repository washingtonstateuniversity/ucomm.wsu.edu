<?php

class WSUWP_Web_Template {
	public function __construct() {
		add_action( 'template_redirect', array( $this, 'handle_template_request' ) );
	}

	public function handle_template_request() {
		if ( isset( $_SERVER['REQUEST_URI'] ) && 0 === strpos( $_SERVER['REQUEST_URI'], '/web-template/' ) ) {
			$pre = $this->build_pre_content();
			$post = $this->build_post_content();

			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json');
			echo json_encode( array( 'before_content' => $pre, 'after_content' => $post ) );
			die(0);
		}
	}

	private function build_pre_content() {
		ob_start();

		$site_name      = get_bloginfo('name');
		$site_tagline   = get_bloginfo('description');

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