<?php
namespace krFrame\layout;

class AdminPage
{
    public function viewDashPanel()
    {
        $this->setCSS();
        $this->setJS();
    }
    public function setCSS()
    {
        wp_enqueue_style('krFrameAdminCSS', KR_THEME_URL.'krFrame/layout/assets/css/style.css');
    }

    public function setJS()
    {
        wp_enqueue_script('krFrameAdminJS', KR_THEME_URL.'krFrame/layout/assets/js/script.js', array('jquery','wp-color-picker'), true);
    }
}
