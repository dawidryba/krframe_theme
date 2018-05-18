<?php
namespace krFrame\Src\Error;
use \krFrame\Src\Error\ErrorCode;
use \krFrame\Layout\ErrorView\ErrorView;

class Error
{
    private static function checkErrorCode($cc)
    {
        if (is_int($cc)) {
            return true;
        }
        return false;
    }

    public function render($code)
    {
        if (!self::checkErrorCode($code)) {
            $code = 0;
        }
        $text = ErrorCode::view($code);
        if (!is_admin()) {
            ErrorView::renderError($code, $text);
            die();
        } else {
            $adminError = new ErrorView($code, $text);
        }
    }
}
