<?php
    namespace krFrame\src\error;

    class Error
    {
        private static function checkErrorCode($cc)
        {
            if(is_int($cc) && self::errorCodeList($cc)) {
                return true;
            }
            return false;
        }

        private static function errorCodeList($cc) {
            return true;
        }

        public function render($code)
        {
            if (!self::checkErrorCode($code)) {
                $code = 0;
            }
            $text = \krFrame\src\error\errorCode::view($code);
            if (!is_admin()){

                \krFrame\layout\error\ErrorView::renderError($code, $text);
                die();
            } else {
                $adminError = new \krFrame\layout\error\ErrorView($code, $text);
            }
        }
    }
