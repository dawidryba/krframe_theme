<?php
namespace krFrame\Src\initTemplate;

class Languages
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'initLanguages'));
    }

    public function initLanguages()
    {
        load_theme_textdomain('krframe', get_template_directory() . '/krFrame/language');
    }
}
