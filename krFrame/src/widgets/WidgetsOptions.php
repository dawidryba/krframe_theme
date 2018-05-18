<?php
namespace krFrame\Src\Widgets;

use \krFrame\Layout\AdminPage;
use \krFrame\Layout\WidgetsOptionsView;

class WidgetsOptions
{
    public function __construct()
    {
        add_action('in_widget_form', array($this, 'setOptions'), 5, 3);
        add_filter('widget_update_callback', array($this, 'setOptionsUpdate'), 5, 3);
        add_filter('dynamic_sidebar_params', array($this, 'setOptionsParams'));
    }

    public function setOptions($obj, $return, $instance)
    {
        $instance = wp_parse_args(
        (array) $instance,
        array(
        'widgetClass' => '',
        'title' => '',
        'text' => '',
        'grid' => 0,
        'gridXl' => 'col-xl-12',
        'gridLg' => 'col-lg-12',
        'gridMd' => 'col-md-12',
        'gridSm' => 'col-sm-12',
        'gridXs' => 'col',
        'titAwesome' => '',
        'titClass' => '',
        'titShow' => 0
        )
    );

        $adminPage = new AdminPage;
        $adminPage->setCSS();
        $adminPage->setJS();
        unset($adminPage);
        if (is_admin()) {
            $render = new WidgetsOptionsView();
            $render->view($obj, $instance);
        }

        $retrun = null;
        return array($obj,$return,$instance);
    }

    public function setOptionsUpdate($instance, $new_instance, $old_instance)
    {
        $instance['widgetClass'] = $new_instance['widgetClass'];

        $instance['grid'] = $new_instance['grid'] == 1 ? 1 : 0;
        $instance['gridXl'] = $new_instance['gridXl'];
        $instance['gridLg'] = $new_instance['gridLg'];
        $instance['gridMd'] = $new_instance['gridMd'];
        $instance['gridSm'] = $new_instance['gridSm'];
        $instance['gridXs'] = $new_instance['gridXs'];

        $instance['titAwesome'] = $new_instance['titAwesome'];
        $instance['titClass'] = $new_instance['titClass'];
        $instance['titShow'] = $new_instance['titShow'] == 1 ? 1 : 0;

        return $instance;
    }

    public function setOptionsParams($params)
    {
        global $wp_registered_widgets;
        $widgetId = $params[0]['widget_id'];
        $widgetObj = $wp_registered_widgets[$widgetId];
        $widgetOpt = get_option($widgetObj['callback'][0]->option_name);
        $widgetNum = $widgetObj['params'][0]['number'];

        $grid = '';
        if ($widgetOpt[$widgetNum]['grid'] == 1) {
            $grid = $this->setGrid($widgetOpt[$widgetNum]);
        }


        $widgetClass = '';
        if (isset($widgetOpt[$widgetNum]['widgetClass'])) {
            $widgetClass = $widgetOpt[$widgetNum]['widgetClass'];
        }

        $params[0]['before_widget'] = $this->setClass($params[0]['before_widget'], $grid.$widgetClass);

        if ($widgetOpt[$widgetNum]['titShow'] == 1) {
            $params[0]['before_title'] = $this->setHidden($params[0]['before_title']);
        }else{
            $widgetTitleClass = '';
            if (isset($widgetOpt[$widgetNum]['titClass'])) {
                $widgetTitleClass = $widgetOpt[$widgetNum]['titClass'];
            }
            $params[0]['before_title'] = $this->setClass($params[0]['before_title'], $widgetTitleClass);
        }
        if (isset($widgetOpt[$widgetNum]['titAwesome']) && $widgetOpt[$widgetNum]['titAwesome'] != '') {
            $params[0]['before_title'] .= $this->prepareIcon($widgetOpt[$widgetNum]['titAwesome']);
        }

        return $params;
    }

    private function prepareIcon($class)
    {
        $class = str_replace(',', ' ', $class);
        return '<i class="'.$class.'"></i> ';
    }

    private function setHidden($title) {
        $title = preg_replace('#class="[a-zA-Z0-9:;\.\s\(\)\-\,]*"#', '', $title);
        $title = str_replace('>', 'hidden>', $title);
        return $title;
    }

    private function setClass($title, $class)
    {
        if (isset($class) && $class != '') {
            $pos = strpos($title, 'class="');
            if ($pos !== false) {
                $title = substr_replace($title, 'class="'.$class.' ', $pos, strlen('class="'));
            }
            $title = str_replace(',', ' ', $title);
        }
        return $title;
    }

    private function setGrid($settingArray)
    {
        $grid = '';

        if (!isset($settingArray['gridXl']) || $settingArray['gridXl'] == '') {
            $grid .= 'col-xl-12 ';
        } else {
            $grid .= $settingArray['gridXl'].' ';
        }
        if (!isset($settingArray['gridLg']) || $settingArray['gridLg'] == '') {
            $grid .= 'col-lg-12 ';
        } else {
            $grid .= $settingArray['gridLg'].' ';
        }
        if (!isset($settingArray['gridMd']) || $settingArray['gridMd'] == '') {
            $grid .= 'col-md-12 ';
        } else {
            $grid .= $settingArray['gridMd'].' ';
        }
        if (!isset($settingArray['gridSm']) || $settingArray['gridSm'] == '') {
            $grid .= 'col-sm-12 ';
        } else {
            $grid .= $settingArray['gridSm'].' ';
        }
        if (!isset($settingArray['gridXs']) || $settingArray['gridXs'] == '') {
            $grid .= 'col ';
        } else {
            $grid .= $settingArray['gridXs'];
        }
        return $grid;
    }
}
