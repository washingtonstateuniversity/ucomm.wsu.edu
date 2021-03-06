<?php
add_filter( 'spine_enable_builder_module', '__return_true' );

require_once 'includes/web-template.php'; // Provides a JSON web template for external pages.
require_once 'includes/ucomm-shortcodes.php'; // Handle custom shortcodes for Ucomm.

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
	wp_localize_script( 'ucomm-library-modal', 'UComm_Data', array( 'json_api_url' => get_rest_url( get_current_blog_id(), '/wp/v2/' ) ) );
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
/*
Add responsive container to embeds
------------------------------------ */
function embed_html( $html ) {
	return '<div class="fluid-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'embed_html', 99, 4 );
/*
Add tablepress parameters
------------------------------------ */
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
			100 => 100,
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

add_action( 'pre_get_posts', 'ucomm_blog_pre_get_posts' );
/**
 * Filter the 'blog' page to only display posts with the category of home.
 *
 * @param WP_Query $query
 */
function ucomm_blog_pre_get_posts( $query ) {
	if ( ! $query->is_home() || ! $query->is_main_query() ) {
		return;
	}

	$args = array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => 'home',
		),
	);
	$query->set( 'tax_query', $args );
}
