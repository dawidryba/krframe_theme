<?php
namespace krFrame\Src\Modules\RelatedPosts;

use \WP_Widget;
use \krFrame\Src\Modules\RelatedPosts;

class RelatedPosts_Widget extends WP_Widget
{
    public static function register()
    {
        register_widget(__CLASS__);
    }

    public function __construct()
    {
        parent::__construct('krWidget_RelatedPosts', __('krRelatedPosts', 'krframe'), array( 'description' => __('Widget to show RelatedPosts', 'krframe'), ));
    }

    public function widget($args, $instance)
    {
        $valueArray = array(
          'postType'           => $instance['postType'],
          'categoryID'         => $instance['categoryID'],
          'nameCustomTaxonomy' => $instance['nameCustomTaxonomy'] != '' ? $instance['nameCustomTaxonomy'] : false,
          'postLimit'          => $instance['postLimit'],
          'linkFollow'         => $instance['linkFollow'],
        );
        $relatedPosts = new RelatedPosts($valueArray);
        if ($relatedPosts->check()) {
            echo $args['before_widget'];
            if ($instance['title']) {
                echo $args['before_title'] . $instance['title'] . $args['after_title'];
            }
            echo $relatedPosts->render();
            echo $args['after_widget'];
        }
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['postType'] = sanitize_text_field($new_instance['postType']);
        $instance['categoryID'] = sanitize_text_field($new_instance['categoryID']);
        $instance['nameCustomTaxonomy'] = sanitize_text_field($new_instance['nameCustomTaxonomy']);
        $instance['postLimit'] = sanitize_text_field($new_instance['postLimit']);
        $instance['linkFollow'] = sanitize_text_field($new_instance['linkFollow']);
        return $instance;
    }

    public function form($instance)
    {
        $defaults = array(
        'title' => '',
        'postType' => '',
        'categoryID' => '',
        'nameCustomTaxonomy' => '',
        'postLimit' => '1',
        'linkFollow' => 'follow',
      );
        $instance = wp_parse_args((array) $instance, $defaults);
        echo '<p><label for="'.$this->get_field_id('title').'">'.__('Title:').'</label> <input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" /></p>';
        echo '<p><label for="'.$this->get_field_id('postType').'">'.__('Post Type:', 'krframe').'</label>'
            .'<select class="widefat" id="'.$this->get_field_id('postType').'" name="'.$this->get_field_name('postType').'">';
        foreach (get_post_types(array('public' => 'true')) as $key => $value) {
            if ($instance['postType'] == $value) {
                echo '<option value="'.$value.'" selected="selected">'.$value.'</option>';
            } else {
                echo '<option value="'.$value.'">'.$value.'</option>';
            }
        }
        echo '</select></p>';
        echo '<p><label for="'.$this->get_field_id('nameCustomTaxonomy').'">'.__('Custom Taxonomy name if exists:', 'krframe').'</label> <input class="widefat" id="'.$this->get_field_id('nameCustomTaxonomy').'" name="'.$this->get_field_name('nameCustomTaxonomy').'" type="text" value="'.$instance['nameCustomTaxonomy'].'" /></p>';
        echo '<p><label for="'.$this->get_field_id('categoryID').'">'.__('ID of category/term if exists separated ",":', 'krframe').'</label> <input class="widefat" id="'.$this->get_field_id('categoryID').'" name="'.$this->get_field_name('categoryID').'" type="text" value="'.$instance['categoryID'].'" /></p>';
        echo '<p><label for="'.$this->get_field_id('postLimit').'">'.__('How many posts show:', 'krframe').'</label> <input class="widefat" id="'.$this->get_field_id('postLimit').'" name="'.$this->get_field_name('postLimit').'" type="text" value="'.$instance['postLimit'].'" /></p>';
        echo '<p><label for="'.$this->get_field_id('linkFollow').'">'.__('Follow / Nofollow link to posts:', 'krframe').'</label>'
            .'<select class="widefat" id="'.$this->get_field_id('linkFollow').'" name="'.$this->get_field_name('linkFollow').'">';
        if ($instance['linkfollow'] == 'follow') {
            echo '<option value="follow" selected="selected">follow</option>';
            echo '<option value="nofollow">nofollow</option>';
        } else {
            echo '<option value="follow">follow</option>';
            echo '<option value="nofollow" selected="selected">nofollow</option>';
        }
        echo '</select></p>';
    }
}
