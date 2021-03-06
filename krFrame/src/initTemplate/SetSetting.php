<?php
namespace krFrame\Src\initTemplate;

use \krFrame\utilis\ACFSupport;
use \krFrame\Src\Error\Error;

class SetSetting
{
    private $urlJsonSetting;
    private $jsonDecodeFile;
    private $widgets;
    private $menu;
    private $thumbnail;

    public function set($file)
    {
        $this->checkFileExist($file);
        $this->urlJsonSetting = file_get_contents($file);
        $this->jsonDecodeFile = json_decode($this->urlJsonSetting, true);
        if ($this->validateArray()) {
            if ($this->checkWidget()) {
                $this->setWidget();
            }
            if ($this->checkMenu()) {
                $this->setMenu();
            }
            if ($this->checkThumbnail()) {
                $this->setThumbnail();
            }
            if (isset($this->jsonDecodeFile['custom-post-type'])) {
                new SetCustomPostType($this->jsonDecodeFile['custom-post-type']);
            }
            if (isset($this->jsonDecodeFile['taxonomies'])) {
                new SetCustomTaxonomies($this->jsonDecodeFile['taxonomies']);
            }
            if (isset($this->jsonDecodeFile['acf_support']) && isset($this->jsonDecodeFile['acf_support']['enable']) && $this->jsonDecodeFile['acf_support']['enable']) {
                new ACFSupport();
            }
        }
    }
    public function get()
    {
        return $this->jsonDecodeFile;
    }

    private function checkFileExist($file)
    {
        if (!file_exists($file)) {
            $this->initError(1);
        }
    }

    private function validateArray()
    {
        if (!is_array($this->jsonDecodeFile)) {
            $this->initError(2);
            return false;
        }
        return true;
    }

    private function checkWidget()
    {
        if (!isset($this->jsonDecodeFile['widgets']) || $this->jsonDecodeFile['widgets'] === null) {
            $this->initError(8);
        }
        $widgets = $this->jsonDecodeFile['widgets'];
        foreach ($widgets as $key => $widget) {
            if (!isset($widget['name'])) {
                $this->initError(3);
            } elseif (!isset($widget['before_widget'])) {
                $this->initError(4);
            } elseif (!isset($widget['after_widget'])) {
                $this->initError(5);
            } elseif (!isset($widget['before_title'])) {
                $this->initError(6);
            } elseif (!isset($widget['after_title'])) {
                $this->initError(7);
            }
        }
        $this->widgets = $widgets;
        return true;
    }

    private function setWidget()
    {
        add_action('widgets_init', array($this, 'initWidget'));
    }

    public function initWidget()
    {
        if (function_exists('register_sidebar')) {
            foreach ($this->widgets as $key => $widget) {
                register_sidebar($widget);
            }
        }
    }

    private function checkMenu()
    {
        if(!isset($this->jsonDecodeFile['menu']) || $this->jsonDecodeFile['menu'] === null) {
            $this->initError(9);
        }
        $this->menu = $this->jsonDecodeFile['menu'];
        return true;
    }

    private function setMenu()
    {
        add_action('init', array($this, 'initMenu'));
    }

    public function initMenu()
    {
        register_nav_menus($this->menu);
    }

    private function checkThumbnail()
    {
        if (!isset($this->jsonDecodeFile['thumbnail'])) {
            return false;
        }
        $thumbs = $this->jsonDecodeFile['thumbnail'];
        foreach ($thumbs as $key => $thumb) {
            if (!isset($thumb['width'])) {
                $this->initError(11);
            } elseif (!isset($thumb['height'])) {
                $this->initError(12);
            } elseif (!isset($thumb['name'])) {
                $this->initError(13);
            } elseif (!isset($thumb['crop'])) {
                $this->initError(14);
            }
        }
        $this->thumbnail = $thumbs;
        return true;
    }

    private function setThumbnail()
    {
        foreach ($this->thumbnail as $key => $thumb) {
            add_image_size($thumb['name'], $thumb['width'], $thumb['height'], $thumb['crop']);
        }
    }

    private function initError($code)
    {
        $error = new Error;
        $error->render($code);
    }
}
