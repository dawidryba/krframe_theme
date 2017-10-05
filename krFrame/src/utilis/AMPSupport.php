<?php
namespace krFrame\utilis;

class AMPSupport
{
  private $acctualURL;
  private $postID;
  private $postType;
  private $homeURL;
  public function __construct() {
    $this->acctualURL = $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $this->acctualURL = str_replace('/amp', '', $this->acctualURL);
    $homeURL = get_home_url();
    if(function_exists('pll_home_url'))
      $this->homeURL = pll_home_url();

    $this->postID = url_to_postid($this->acctualURL);
    if ($this->postID == 0 && $this->acctualURL != $this->homeURL)
      return false;
    $query = new \WP_Query(array(
      'p' => $this->postID,
      'post_type' => 'any'
    ));

    while($query->have_posts()) {
      $query->the_post();
      global $post;
      $this->postType = $post->post_type;
    }
    $this->initAMPRouter();

  }

  private function initAMPRouter() {
    if ($this->acctualURL == $this->homeURL || ($this->acctualURL.'/') == $this->homeURL) {
      \Routes::map('/amp', function($params){
        $query = 'p='.$this->postID.'&post_type='.$this->postType;
        \Routes::load('amp_front-page.php', $this->getArgs(), $query, 200);
      });
      \Routes::map(':lang/amp', function($params){
        $query = 'p='.$this->postID.'&post_type='.$this->postType;
        \Routes::load('amp_front-page.php', $this->getArgs(), $query, 200);
      });
      \Routes::map(':lang/:page/amp', function($params){
        $query = 'p='.$this->postID.'&post_type='.$this->postType;
        \Routes::load('amp_front-page.php', $this->getArgs(), $query, 200);
      });
    } else {
      if ($this->postType == 'post') {
        \Routes::map(':name/amp', function($params){
          $query = 'p='.$this->postID.'&post_type='.$this->postType;
          \Routes::load('amp_page.php', $this->getArgs(), $query, 200);
        });
        \Routes::map(':lang/:name/amp', function($params){
          $query = 'p='.$this->postID.'&post_type='.$this->postType;
          \Routes::load('amp_page.php', $this->getArgs(), $query, 200);
        });
      } elseif ($this->postType == 'page') {
        \Routes::map(':name/amp', function($params){
          $query = 'p='.$this->postID.'&post_type='.$this->postType;
          \Routes::load('amp_page.php', $this->getArgs(), $query, 200);
        });
        \Routes::map(':parent/:name/amp', function($params){
          $query = 'p='.$this->postID.'&post_type='.$this->postType;
          \Routes::load('amp_page.php', $this->getArgs(), $query, 200);
        });
        \Routes::map(':parentParent/:parent/:name/amp', function($params){
          $query = 'p='.$this->postID.'&post_type='.$this->postType;
          \Routes::load('amp_page.php', $this->getArgs(), $query, 200);
        });
        \Routes::map(':lang/:parentParent/:parent/:name/amp', function($params){
          $query = 'p='.$this->postID.'&post_type='.$this->postType;
          \Routes::load('amp_page.php', $this->getArgs(), $query, 200);
        });
      }
    }
  }

  private function getArgs() {
    return array(
      'canonicalUrl' => $this->acctualURL
    );
  }
}
