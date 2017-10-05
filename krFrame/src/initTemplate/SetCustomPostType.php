<?php
  namespace krFrame\Src\initTemplate;

  class SetCustomPostType {
    private $customPosts;
    private $customPost;
    private $name;

    public function __construct($array) {
      if(!is_array($array))
        return false;
      $this->customPosts = $array;

      $this->init();
    }
    public function registerPosts() {
      register_post_type($this->name, $this->customPost);
    }

    private function init() {
      foreach ($this->customPosts as $this->name => $this->customPost) {
        if ($this->validate()) {
          $this->customPost['labels']["name"] = __($this->customPost['labels']["name"], 'krframe');
          $this->customPost['labels']["singular_name"] = __($this->customPost['labels']["singular_name"], 'krframe');
          $this->customPost['rewrite']["slug"] = __($this->customPost['rewrite']["slug"], 'krframe');
          $this->registerPosts();
        }
      }
    }

    private function validate() {
      if( !isset($this->customPost['labels']) ||
          !isset($this->customPost['public']) ||
          !isset($this->customPost['rewrite'])
        ) {
            $error = new \krFrame\src\error\Error();
            $error->render(15);
            return false;
          }
        return true;
    }
  }
