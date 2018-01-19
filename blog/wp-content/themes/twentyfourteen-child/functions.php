<?php 

add_action('wp_enqueue_scripts', 'my_theme_styles' );
function my_theme_styles() {
	wp_enqueue_style('parent-theme-css', get_template_directory_uri() .'/style.css' );
	wp_enqueue_style('child-theme-css', get_stylesheet_directory_uri() .'/style.css', array('parent-theme-css') );
}


?>
