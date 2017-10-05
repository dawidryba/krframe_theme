<?php
    use \Timber\Timber as Timber;
    use \Timber\Menu as Menu;

    $template = new \krFrame\src\front\DefaultContent(basename(__FILE__, '.php'));
    $context = $template->getContext();
    $template->render($context);
