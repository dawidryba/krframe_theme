<?php
use \Timber\Timber;
global $params;

$template = new \krFrame\src\front\DefaultContent('amp/amp-front-page');
$context = $template->getContext();
add_action('wp_print_styles', 'removeAllThemeCSSJS', 100);
$context['canonicalUrl'] = $params['canonicalUrl'];

$template->render($context);
