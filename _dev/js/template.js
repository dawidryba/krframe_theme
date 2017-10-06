'use strict';

import './lib/jquery.fancybox.js';

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

jQuery(document).ready(function($) {
  const $gallery = $('div.gallery');

  $gallery.each(function(index) {
    let id = $(this).attr('id');
    $(this).find('a').attr('data-fancybox', 'gallery-'+index);
    $('#'+id).fancybox({
      selector : '.gallery-icon a[data-fancybox="gallery-'+index+'"]',
      loop     : true
    });
  });
});

// END TEMPLATE JS
