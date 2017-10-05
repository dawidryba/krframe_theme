<?php
namespace krFrame\Src\DashPanel;

class DashPanel
{
    private $settingFile;

    public function __construct($setting)
    {
        $this->settingFile = $setting;
    }

    public function initSettingPage()
    {
        $panel = new \krFrame\layout\adminPage();
        $panel->viewDashPanel();
    }
}
