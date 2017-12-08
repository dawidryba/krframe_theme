<?php
namespace krFrame\Src\Front;

class Alerts
{
    private static $type;
    private static $message;
    private static $acceptClose;

    public static function render($type, $message, $acceptClose = true)
    {
        self::$type = $type;
        self::$message = $message;
        self::$acceptClose = $acceptClose;
        return self::returnArray();
    }

    public static function returnArray()
    {
        $array = [
          'type' => self::$type,
          'message' => self::$message,
          'close' => self::$acceptClose
        ];

        return $array;
    }
}
