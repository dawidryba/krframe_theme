<?php
namespace krFrame\utilis;

class ACFSupport
{
  private $googleMapApiKey;
  public function __construct($googleMapApiKey = null) {
    $this->getInstallFile();
    $this->googleMapApiKey = $googleMapApiKey;
    add_filter('acf/settings/path', array($this, 'registerACFPlugin'));
    add_filter('acf/settings/dir', array($this, 'getACFSettingDir'));

    if ($this->googleMapApiKey != null)
      add_filter('acf/fields/google_map/api', 'registerACFGoogleMapApiKey');
  }

  public function registerACFPlugin($path) {
    $path = get_stylesheet_directory() . '/plugin/advanced-custom-fields/';
    return $path;
  }

  public function getACFSettingDir($dir) {
    $dir = KR_THEME_DIR. '/plugin/advanced-custom-fields/';
    return $dir;
  }

  public function registerACFGoogleMapApiKey($api){
  	$api['key'] = $this->googleMapApiKey;
  	return $api;
  }

  private function getInstallFile() {
    require(get_stylesheet_directory() . '/plugin/advanced-custom-fields/acf.php' );
  }
}
