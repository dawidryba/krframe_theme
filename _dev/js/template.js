jQuery(document).ready(function($) {
  const $buttonOpenMenu = $('#js-open-menu');
  const $buttonCloseMenu = $('#js-close-menu');
  const $navigation = $('#js-navigation');
  const $bg = $('#js-mask-bg');

  $buttonOpenMenu.add($buttonCloseMenu).add($bg).click(() => {
    $buttonOpenMenu.add('body').add($navigation).toggleClass('menu-open');
    $bg.toggleClass('active');
  });
});

// END TEMPLATE JS
