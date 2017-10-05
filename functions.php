<?php
// =============== KRFRAME THEME ===================
require_once('krFrame/autoloader.php');
\krFrame\autoLoader::load();

$template = new \krFrame\Src\initTemplate\InitTemplate();

if(!is_admin()) {
  \Timber\Timber::$dirname = array('twig', 'views');
}

function removeAllThemeCSSJS() {
  global $wp_styles;
  global $wp_scripts;
  $wp_styles->queue = array();
  $wp_scripts->queue = array();
}

// ================= END KRFRAME ===================
// DELETE JS SCRIPT
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
add_filter('xmlrpc_enabled', '__return_false');
add_filter( 'wp_default_scripts', 'isa_remove_jquery_migrate' );
add_action('wp_footer', 'my_deregister_scripts');

remove_action('wp_head', 'wp_resource_hints', 2 );

function isa_remove_jquery_migrate( &$scripts) {
	if(!is_admin()) {
		$scripts->remove('jquery');
		$scripts->add('jquery', false, array( 'jquery-core' ), '1.12.4' );
	}
}

function my_deregister_scripts(){
  wp_deregister_script('wp-embed');
}

// AJAX FUNCTION

function krAjaxSortSellers()
{
    check_ajax_referer('krAjaxSortSellers_nonce', 'nonce');

    die();
}


__('Error 404', 'krframe');
