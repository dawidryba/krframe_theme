<?php
namespace krFrame\Src\Front;

use \Timber\Timber;
use \Timber\Menu;

class DefaultContent
{
    private $context;
    private $file;
    private $acctualURL;

    public function __construct($file)
    {
        $GLOBALS['settingJSON'];
        $this->file = $file;
        $this->acctualURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->context = Timber::get_context();
        $this->context['widgets'] = $this->getDefaultWidgets();
        $this->context['menu'] = new Menu('main-menu');
        $this->context['alert'] = null;
        $this->getContent();
        if (!defined('WPSEO_FILE')) {
            $this->context['siteDescription'] = $this->setDescription();
        }
        if (function_exists('pll_the_languages')) {
            $this->context['langs'] = $this->setLanguages();
        }
    }

    private function getContent()
    {
        if (is_category() || is_archive() || is_tag() || is_tax()) {
            $this->context['posts'] = Timber::get_posts();
            if (is_category()) {
                $this->context['category'] = array(
                  'name' => single_cat_title('', false),
                  'description' => category_description()
                );
            } elseif (is_tax()) {
                $this->context['category'] = array(
                  'name' => single_term_title('', false),
                  'description' => category_description()
                );
            } elseif (is_tag()) {
                $this->context['category']['name'] = single_tag_title('', false);
            } else {
                $this->context['category']['name'] = post_type_archive_title('', false);
            }

            $this->context['pagination'] = Timber::get_pagination();
        } elseif (!is_404()) {
            $this->context['post'] = Timber::get_post();
            $this->context['post']->categories = $this->getPostCategories();
        }
    }

    private function setDescription($description = false)
    {
        $description = $this->context['site']->description;
        return '<meta name="description" content="'.$description.'">';
    }

    private function setLanguages()
    {
        $polylang = pll_the_languages(array('raw' => 1));
        $arrayLang = array();
        foreach ($polylang as $key => $value) {
            $class = '';
            if ($value['current_lang'] == 1) {
                $class = 'current';
            }
            $arrayLang[] = array(
            'name' => $value['name'],
            'short' => $key,
            'lang' => $value['locale'],
            'url' => $value['url'],
            'class' => $class
        );
        }
        return $arrayLang;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function render($context)
    {
        Timber::render(array($this->file.'.twig'), $context);
    }

    private function getDefaultWidgets()
    {
        $widgets = $GLOBALS['settingJSON']['widgets'];
        $arrayDefaultWidgets = null;
        foreach ($widgets as $key => $widget) {
            if ($widget['default']) {
                $twigName = str_replace('-', '_', $widget['id']);
                $array = Timber::get_widgets($widget['id']);
                if ($array == '') {
                    continue;
                }
                $arrayDefaultWidgets[$twigName] = Timber::get_widgets($widget['id']);
            }
        }
        return $arrayDefaultWidgets;
    }

    private function getPostCategories()
    {
        $categories = array();
        $categoryObject = $this->context['post']->terms('category');

        foreach ($categoryObject as $key => $category) {
            $categories[] = array(
                'name' => $category->name,
                'link' => get_term_link($category->id)
              );
        }
        return $categories;
    }
}
