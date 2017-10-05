<?php
use \Timber\Timber as Timber;

$template = new \krFrame\src\front\DefaultContent('category');
$context = $template->getContext();
$template->render($context);
