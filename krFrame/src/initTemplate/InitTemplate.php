<?php
namespace krFrame\Src\initTemplate;

use \krFrame\Src\widgets\RegisterKrWidgets;
use \krFrame\Src\widgets\WidgetsOptions;
use \krFrame\Src\DashPanel\DashPanel;
use \krFrame\front\GalleryOption;
use \krFrame\src\front\InitJS;

class InitTemplate
{
    private static $settingFile;
    private $settingJSON;
    private $initJS;

    public function __construct()
    {
        $this->setDefaultVariables();
        add_filter('show_admin_bar', '__return_false');
        remove_action('wp_head', 'wp_generator');
        add_post_type_support( 'post', 'custom-fields' );
        add_filter('widget_title', 'do_shortcode');
        add_filter( 'use_default_gallery_style', '__return_false');
        add_theme_support( 'post-thumbnails' );
        new Languages();

        self::$settingFile = KR_THEME_DIR.'/settings.json';

        $this->settingJSON = new SetSetting();
        $this->settingJSON->set(self::$settingFile);
        $GLOBALS['settingJSON'] = $this->settingJSON->get();

        RegisterKrWidgets::register();

        if (is_admin())
          new DashPanel($GLOBALS['settingJSON']);
        else {
          $gallery = new GalleryOption();
          $this->initJS = new InitJS($GLOBALS['settingJSON']);
          add_action('wp_enqueue_scripts', array($this, 'addScript'));
          $this->initJS->addAction();
        }
        $widgetsOptions = new WidgetsOptions;
    }
    public function addScript() {
      $this->initJS->getScript();
    }

    private function setDefaultVariables()
    {
        if (!defined('KR_THEME_DIR'))
            define('KR_THEME_DIR', get_theme_root().'/'.get_template().'/');
        if (!defined('KR_THEME_URL'))
            define('KR_THEME_URL', WP_CONTENT_URL.'/themes/'.get_template().'/');
        if (!defined('KR_FRAME_URL'))
            define('KR_FRAME_URL', 'wp-content/themes/'.get_template().'/krFrame/');
        if (!defined('KR_FRAME_VERSION'))
            define('KR_FRAME_VERSION', 'v.1.2.0');
    }
}
