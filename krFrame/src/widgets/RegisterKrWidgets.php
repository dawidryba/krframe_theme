<?php
namespace krFrame\Src\Widgets;

class RegisterKrWidgets
{
    private static $widgetsList;

    public static function register()
    {
        self::$widgetsList = self::getWidgetsName();
        for ($i = 0; $i < count(self::$widgetsList); $i++) {
            add_action('widgets_init', array(self::$widgetsList[$i], 'register'));
        }
    }

    private static function getWidgetsName()
    {
        return array(
            '\krFrame\Src\Modules\RelatedPosts\RelatedPosts_widget',
        );
    }
}
