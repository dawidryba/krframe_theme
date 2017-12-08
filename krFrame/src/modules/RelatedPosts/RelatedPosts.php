<?php
namespace krFrame\Src\Modules\RelatedPosts;

use WP_Query;
use Timber\Timber;

class RelatedPosts
{
    private $values;
    private $query;
    private $timberArray;

    public function __construct($values)
    {
        Timber::$locations = array(KR_THEME_DIR.'twig/widgets/RelatedPosts');

        $this->values = $values;
        $this->query();
    }

    private function query()
    {
        $this->query = new WP_Query($this->prepareData());
    }

    private function prepareData()
    {
        $args = array();
        global $post;
        $currentPostID = $post->ID;

        $args['post_type'] = $this->values['postType'];
        $args['post__not_in'] = array($currentPostID);
        if ($this->values['nameCustomTaxonomy'] && isset($this->values['categoryID']) && $this->values['categoryID'] != '') {
            $args['tax_query'] = array(
        array(
          'taxonomy' => $this->values['nameCustomTaxonomy'],
          'field'    => 'term_id',
          'terms'    => $this->values['categoryID'],
        )
      );
        } elseif ($args['post_type'] == 'post' && isset($this->values['categoryID']) && $this->values['categoryID'] != '') {
            $args['cat'] = $this->values['categoryID'];
        } elseif ($args['post_type'] == 'page' && isset($this->values['categoryID']) && $this->values['categoryID'] != '') {
            $args['post_parent'] = $this->values['categoryID'];
        }
        $args['posts_per_page'] = $this->values['postLimit'];

        return $args;
    }

    public function check()
    {
        $return = false;
        if ($this->query->have_posts()) {
            $return = true;
        }
        return $return;
    }

    private function getData()
    {
        $arrayReturn = array();
        while ($this->query->have_posts()) {
            $this->query->the_post();
            $arrayReturn[] = array(
        'title'     => get_the_title(),
        'thumbnail' => array(
          'oryginal' => get_the_post_thumbnail_url(),
          'large'   => get_the_post_thumbnail_url(null, 'large'),
          'medium'   => get_the_post_thumbnail_url(null, 'medium'),
          'thumbnail'   => get_the_post_thumbnail_url(null, 'thumbnail')
        ),
        'date'      => get_the_date('U'),
        'content'   => strip_tags(strip_shortcodes(get_the_content())),
        'link'      => get_the_permalink(),
      );
        }
        unset($currentPost);
        return $arrayReturn;
    }

    public function renderAlert($twigArray)
    {
        return Timber::compile('Alert.twig', $twigArray);
    }
    public function render()
    {
        $this->timberArray = Timber::get_context();
        $this->timberArray['posts'] = $this->getData();
        return Timber::compile('RelatedPosts.twig', $this->timberArray);
    }
}
