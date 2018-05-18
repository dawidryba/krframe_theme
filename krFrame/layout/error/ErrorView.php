<?php
namespace krFrame\Layout\ErrorView;

final class ErrorView
{
    private $code;
    private $errorText;

    public function __construct($code, $errorText)
    {
        $this->code = $code;
        $this->errorText = $errorText;

        add_action('admin_notices', array($this,'renderAdminNotification'));
    }

    public static function renderError($code, $errorText)
    {
        $krTemplateUrl = get_bloginfo('template_url');
        require_once('view/viewFront.php');
    }

    public function renderAdminNotification()
    {
        require_once(__DIR__.'/view/viewNotification.php');
    }
}
