<?php
use \Timber\Timber;

global $params;


$template = new \krFrame\src\front\DefaultContent('amp/amp-page');
$context = $template->getContext();
remove_shortcode('contact-form-7');
remove_shortcode('youtube');
add_action('wp_print_styles', 'removeAllThemeCSSJS', 100);
$context['canonicalUrl'] = $params['canonicalUrl'];

function remove_my_shortcodes() {
    remove_shortcode( 'contact-form-7' );
}
$template->render($context);

//echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
