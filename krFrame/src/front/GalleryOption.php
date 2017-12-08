<?php
namespace krFrame\Src\Front;

class GalleryOption
{
    private $post;

    public function __construct()
    {
        add_filter('the_content', array($this, 'addContentShordcode'));
    }

    public function addContentShordcode($content)
    {
        global $post;
        add_shortcode('gallery', array($this, 'setLinkToMediaFile'));
        return $content;
    }

    public function setLinkToMediaFile($atts)
    {
        $atts['link'] = 'file';
        return gallery_shortcode($atts);
    }
}
