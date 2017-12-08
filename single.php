<?php
$template = new \krFrame\Src\Front\DefaultContent(basename(__FILE__, '.php'));
$context = $template->getContext();
$template->render($context);
