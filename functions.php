<?php
add_filter( 'spine_enable_builder_module', '__return_true' );

include_once( 'includes/home-nav.php' ); // Include shortcode plugin.
include_once( 'includes/home-blog.php' ); // Include shortcode plugin.
include_once( 'includes/library-of-work.php' ); // Handles library of work shortcode
include_once( 'includes/cta.php' ); // Include shortcode plugin.
include_once( 'includes/web-template.php' );

add_action( 'after_setup_theme', 'ucomm_setup_theme' );
/**
 * Add support for theme features.
 */
function ucomm_setup_theme() {
	add_theme_support( 'post-thumbnails' );
}

add_action( 'wp_enqueue_scripts', 'ucomm_enqueue_scripts' );
function ucomm_enqueue_scripts() {
	wp_register_script( 'ucomm-library-modal', get_stylesheet_directory_uri() . '/assets/scripts/site.js', array( 'jquery' ), spine_get_script_version(), true );
	wp_localize_script( 'ucomm-library-modal', 'UComm_Data', array( 'json_api_url' => get_home_url( get_current_blog_id(), '/wp-json/' ) ) );
	wp_enqueue_script( 'ucomm-library-modal' );
}

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter( 'the_excerpt', 'ucomm_the_excerpt' );

function ucomm_the_excerpt( $excerpt ) {
	$excerpt = trim( $excerpt );

	if ( '</p>' === substr( $excerpt, -4 ) ) {
		$excerpt = substr( $excerpt, 0, -4 ); // strip </p>	
		$excerpt = $excerpt . ' <a href="<?php echo get_permalink(); ?>">...read more</a></p>';
	}

	return $excerpt;
}


add_filter( 'tablepress_datatables_parameters', 'spine_params', 10, 4 );
/**
 * Filter Tablepress's call of the Datatables plugin to add an "All" option for viewing
 * a specified number of entries.
 *
 * @param $parameters
 * @param $table_id
 * @param $html_id
 * @param $js_options
 *
 * @return mixed
 */
function spine_params( $parameters, $table_id, $html_id, $js_options ) {
	if ( true === $js_options['datatables_lengthchange'] ) {
		$lengths = array(
			10 => 10,
			25 => 25,
			50 => 50,
			100 => 100
		);

		if ( false === array_key_exists( $js_options['datatables_paginate_entries'], $lengths ) ) {
			$lengths[ absint( $js_options['datatables_paginate_entries'] ) ] = absint( $js_options['datatables_paginate_entries'] );
			ksort( $lengths );
		}

		$lengths['-1'] = '"All"';

		$parameters['aLengthMenu'] = '"aLengthMenu":[[' . implode( ',', array_keys( $lengths ) ) . '],[' . implode( ',', array_values( $lengths ) ) . ']]';
	}

	return $parameters;
}