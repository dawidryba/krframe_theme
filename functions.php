<?php
use \krFrame\Src\initTemplate\InitTemplate;

require('krFrame/vendor/autoload.php');
$template = new InitTemplate();

// ================= END KRFRAME ===================
// DELETE JS SCRIPT

add_filter('wp_default_scripts', 'isa_remove_jquery_migrate');
add_action('wp_footer', 'my_deregister_scripts');

remove_action('wp_head', 'wp_resource_hints', 2);

function isa_remove_jquery_migrate(&$scripts)
{
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array( 'jquery-core' ), '1.12.4');
    }
}

function my_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}

// AJAX FUNCTION

function krAjaxSortSellers()
{
    check_ajax_referer('krAjaxSortSellers_nonce', 'nonce');

    die();
}


__('Error 404', 'krframe');
