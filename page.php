<?php
use \Timber\Timber;

$template = new \krFrame\src\front\DefaultContent(basename(__FILE__, '.php'));
$context = $template->getContext();
$template->render($context);
