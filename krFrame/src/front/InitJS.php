<?php
namespace krFrame\src\front;

class InitJS
{
    private $ajaxFunctions;
    private $correctArray;

    public function __construct($settingJSON)
    {
        $this->ajaxFunctions = null;
        $this->correctArray = true;
        if (!isset($settingJSON['ajax_functions']) || !is_array($settingJSON['ajax_functions']))
            $this->correctArray = false;
        else
            $this->ajaxFunctions = $settingJSON['ajax_functions'];
    }

    public function getScript()
    {
        wp_register_script('krFrameJS', get_template_directory_uri() . '/assets/js/main.script.js', array('jquery'), '1.0.0', true);
        if ($this->correctArray)
            $this->initUserAjaxCall();
        wp_enqueue_script('krFrameJS');
    }

    private function initUserAjaxCall()
    {
        foreach ($this->ajaxFunctions as $key => $functionsUserArray) {
            $this->localizeScript($key);
        }
    }

    public function localizeScript($name)
    {
        wp_localize_script(
            'krFrameJS',
            $name,
            array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce($name.'_nonce'),
            )
        );
    }

    public function addAction()
    {
        if ($this->correctArray)
            foreach ($this->ajaxFunctions as $key => $functionsUserArray) {
                if ($functionsUserArray['user'] == 1) {
                    add_action('wp_ajax_'.$key, $key);
                }
                if ($functionsUserArray['nouser'] == 1) {
                    add_action('wp_ajax_nopriv_'.$key, $key);
                }
            }
    }
}
