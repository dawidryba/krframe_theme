<?php
  namespace krFrame\src\front;

  class Alerts {
      static private $type;
      static private $message;
      static private $acceptClose;

      static public function render($type, $message, $acceptClose = true) {
          self::$type = $type;
          self::$message = $message;
          self::$acceptClose = $acceptClose;
          return self::returnArray();
      }

      static public function returnArray() {
        $array = [
          'type' => self::$type,
          'message' => self::$message,
          'close' => self::$acceptClose
        ];

        return $array;
      }
  }
