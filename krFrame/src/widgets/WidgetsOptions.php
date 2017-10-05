<?php
namespace krFrame\Src\widgets;

class WidgetsOptions {

public function __construct()
{
    add_action('in_widget_form', array($this, 'setOptions'), 5,3);
    add_filter('widget_update_callback', array($this, 'setOptionsUpdate'), 5,3);
    add_filter('dynamic_sidebar_params', array($this, 'setOptionsParams'));
}

public function setOptions($obj,$return,$instance)
{
    $instance = wp_parse_args((array) $instance, array(
        'widgetClass' => '',
        'title' => '',
        'text' => '',
        'gridXl' => 'col-xl-12',
        'gridLg' => 'col-lg-12',
        'gridMd' => 'col-md-12',
        'gridSm' => 'col-sm-12',
        'gridXs' => 'col',
        'titAwesome' => '',
        'titClass' => ''
        )
    );

    $adminPage = new \krFrame\layout\AdminPage;
    $adminPage->setCSS();
    $adminPage->setJS();
    unset($adminPage);
    if (is_admin()) {
      $render = new \krFrame\layout\WidgetsOptionsView();
      $render->view($obj,$instance);
    }

    $retrun = null;
    return array($obj,$return,$instance);
}

public function setOptionsUpdate($instance, $new_instance, $old_instance){
    $instance['widgetClass'] = $new_instance['widgetClass'];

    $instance['gridXl'] = $new_instance['gridXl'];
    $instance['gridLg'] = $new_instance['gridLg'];
    $instance['gridMd'] = $new_instance['gridMd'];
    $instance['gridSm'] = $new_instance['gridSm'];
    $instance['gridXs'] = $new_instance['gridXs'];
    $instance['displayXl'] = isset($new_instance['displayXl']) ? 1 : 0;
    $instance['displayLg'] = isset($new_instance['displayLg']) ? 1 : 0;
    $instance['displayMd'] = isset($new_instance['displayMd']) ? 1 : 0;
    $instance['displaySm'] = isset($new_instance['displaySm']) ? 1 : 0;
    $instance['displayXs'] = isset($new_instance['displayXs']) ? 1 : 0;

    $instance['titAwesome'] = $new_instance['titAwesome'];
    $instance['titClass'] = $new_instance['titClass'];

    return $instance;
}

public function setOptionsParams($params){
    global $wp_registered_widgets;
    $widgetId = $params[0]['widget_id'];
    $widgetObj = $wp_registered_widgets[$widgetId];
    $widgetOpt = get_option($widgetObj['callback'][0]->option_name);
    $widgetNum = $widgetObj['params'][0]['number'];

    $display = $this->setDisplay($widgetOpt[$widgetNum]);
    $grid = $this->setGrid($widgetOpt[$widgetNum]);

    $widgetClass = '';
    if (isset($widgetOpt[$widgetNum]['widgetClass']))
        $widgetClass = $widgetOpt[$widgetNum]['widgetClass'];

    $widgetTitleClass = '';
    if (isset($widgetOpt[$widgetNum]['titClass']))
        $widgetTitleClass = $widgetOpt[$widgetNum]['titClass'];

    $params[0]['before_widget'] = $this->setClass($params[0]['before_widget'], $grid.$display.$widgetClass);

    $params[0]['before_title'] = $this->setClass($params[0]['before_title'], $widgetTitleClass);

    if (isset($widgetOpt[$widgetNum]['titAwesome']) && $widgetOpt[$widgetNum]['titAwesome'] != '')
        $params[0]['before_title'] .= $this->prepareIcon($widgetOpt[$widgetNum]['titAwesome']);

    return $params;
}

private function prepareIcon($class)
{
    $class = str_replace(',',' ',$class);
    return '<i class="'.$class.'" aria-hidden="true"></i> ';
}

private function setClass($title, $class)
{
    if (isset($class) && $class != ''){
        $pos = strpos($title, 'class="');
        if ($pos !== false) {
          $title = substr_replace($title, 'class="'.$class.' ', $pos, strlen('class="'));
        }
        //$title = str_replace('class="', 'class="'.$class.' ', $title);
        //$title = str_replace('class=\'', 'class=\''.$class.' ', $title);
        $title = str_replace(',',' ',$title);
        return $title;
    }
    return $title;
}

private function setDisplay($settingArray)
{
    $display = '';
    if (isset($settingArray['displayXl']) && $settingArray['displayXl'] == 1)
        $display .= 'hidden-xl-up ';
    if (isset($settingArray['displayLg']) && $settingArray['displayLg'] == 1)
        $display .= 'hidden-lg-up ';
    if (isset($settingArray['displayMd']) && $settingArray['displayMd'] == 1)
        $display .= 'hidden-md-up ';
    if (isset($settingArray['displaySm']) && $settingArray['displaySm'] == 1)
        $display .= 'hidden-sm-up ';
    if (isset($settingArray['displayXs']) && $settingArray['displayXs'] == 1)
        $display .= 'hidden-xs-up ';

    return $display;
}

private function setGrid($settingArray)
{
    $grid = '';

    if (!isset($settingArray['gridXl']) || $settingArray['gridXl'] == '')
        $grid .= 'col-xl-12 ';
    else
        $grid .= $settingArray['gridXl'].' ';
    if (!isset($settingArray['gridLg']) || $settingArray['gridLg'] == '')
        $grid .= 'col-lg-12 ';
    else
        $grid .= $settingArray['gridLg'].' ';
    if (!isset($settingArray['gridMd']) || $settingArray['gridMd'] == '')
        $grid .= 'col-md-12 ';
    else
        $grid .= $settingArray['gridMd'].' ';
    if (!isset($settingArray['gridSm']) || $settingArray['gridSm'] == '')
        $grid .= 'col-sm-12 ';
    else
        $grid .= $settingArray['gridSm'].' ';
    if (!isset($settingArray['gridXs']) || $settingArray['gridXs'] == '')
        $grid .= 'col ';
    else
        $grid .= $settingArray['gridXs'].' ';
    return $grid;
}
}
