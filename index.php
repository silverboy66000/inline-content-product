<?php
/*
Plugin Name: saya seo contnts
Plugin URI: https://abolfazsamiei.ir
Description: نمایش محتوای سئویی در سایت[saya-seo-shortcode content="1,2,3,4,5" product="19289,19287,19281,19277,19267"]
Version: 1.0
Author: ابوالفضل سمیعی
Author URI: https://abolfazlsamiei.ir
License: MIT
Text Domain: none
*/
global $wpdb;

function saya_seo_contents_page_function($atts = array(), $content = null, $tag = ''){
	ob_start();
	//print_r(wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ));
//	wp_register_script( 'ajax-script', plugin_dir_url( __FILE__ ) . '/src/jav.js', array( 'jquery' ), 1.0 );
	//wp_enqueue_script( 'ajax-script' );
	//wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	include WP_PLUGIN_DIR."/saya-seo-contents/public/index.php";
	$content = ob_get_clean(); // store buffered output content.

	return $content; // Return the content.
}

add_shortcode('saya-seo-shortcode', 'saya_seo_contents_page_function');

