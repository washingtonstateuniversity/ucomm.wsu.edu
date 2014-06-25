<?php
add_theme_support( 'post-thumbnails' ); 
add_filter( 'spine_enable_builder_module', '__return_true' );

include_once( 'includes/home-nav.php' ); // Include shortcode plugin.
include_once( 'includes/home-blog.php' ); // Include shortcode plugin.
include_once( 'includes/email-lib.php' ); // Include shortcode plugin.
include_once( 'includes/presentation-lib.php' ); // Include shortcode plugin.
include_once( 'includes/print-lib.php' ); // Include shortcode plugin.
include_once( 'includes/web-lib.php' ); // Include shortcode plugin.
include_once( 'includes/research-lib.php' ); // Include shortcode plugin.

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
function alx_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Jetpack
?>
