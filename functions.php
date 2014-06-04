<?php
add_action( 'spine_pre_jacket_html', 'ucomm_add_banner_html' );
function ucomm_add_banner_html() {
       echo '<div class="acBanner"></div>';
}
add_theme_support( 'post-thumbnails' ); 
add_filter( 'spine_enable_builder_module', '__return_true' );
?>
