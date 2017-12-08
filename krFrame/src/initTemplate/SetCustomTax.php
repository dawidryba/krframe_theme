<?php
namespace krFrame\Src\initTemplate;

use \krFrame\Src\Error\Error;

class SetCustomTaxonomies
{
    private $taxonomies;
    private $taxonomy;
    private $name;

    public function __construct($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $this->taxonomies = $array;

        $this->init();
    }

    private function init()
    {
        foreach ($this->taxonomies as $this->name => $this->taxonomy) {
            if ($this->validate()) {
                register_taxonomy($this->name, $this->taxonomy['post_type'], array(
                    'hierarchical' => $this->taxonomy['hierarchical'],
                    'label' => __($this->taxonomy['label'], 'krframe'),
                    'query_var' => $this->taxonomy['query_var'],
                    'rewrite' => array(
                        'slug' => __($this->taxonomy['rewrite']['slug'], 'krframe'),
                        'with_front' => $this->taxonomy['rewrite']['with_front']
                    )
                  )
                );
            }
        }
    }

    private function validate()
    {
        if (!isset($this->taxonomy['post_type']) ||
          !isset($this->taxonomy['hierarchical']) ||
          !isset($this->taxonomy['label']) ||
          !isset($this->taxonomy['hierarchical']) ||
          !isset($this->taxonomy['query_var']) ||
          !isset($this->taxonomy['rewrite']) ||
          !isset($this->taxonomy['rewrite']['slug']) ||
          !isset($this->taxonomy['rewrite']['with_front'])
        ) {
            $error = new Error();
            $error->render(16);
            return false;
        }
        return true;
    }
}
