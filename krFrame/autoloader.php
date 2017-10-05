<?php
namespace krFrame;

class autoLoader {
  public static function load()
  {
    require('vendor/autoload.php');
    require('src/initTemplate/InitTemplate.php');

    require('src/utilis/AMPSupport.php');
    require('src/utilis/ACFSupport.php');

    require('src/initTemplate/SetSetting.php');
    require('src/initTemplate/Languages.php');
    require('src/initTemplate/SetCustomPostType.php');
    require('src/initTemplate/SetCustomTax.php');
    require('src/error/error.php');
    require('src/error/errorCode.php');
    require('layout/error/ErrorView.php');
    require('src/widgets/WidgetsOptions.php');
    require('src/widgets/RegisterKrWidgets.php');

    if (is_admin()) {
      require('src/DashPanel/DashPanel.php');
      require('layout/AdminPage.php');
      require('layout/WidgetsOptionsView.php');
    } else {
      require('src/front/DefaultContent.php');
      require('src/front/Alerts.php');
      require('src/front/InitJS.php');
      require('src/front/GalleryOption.php');
    }
    // modules

    require('src/modules/RelatedPosts/RelatedPosts.php');
    require('src/modules/RelatedPosts/RelatedPosts_widget.php');
  }
}
