'use strict';
import './lib/jquery.fancybox.js';

jQuery(document).ready(function($) {
  const $gallery = $('div.gallery');
  if (!$gallery.length)
    return;

  $gallery.each(function(index) {
    let parentIndex = index;
    $(this).children('.gallery-item').each(function(index) {
      let caption = $(this).find('.wp-caption-text').text();
      $(this).find('a').attr({
        'data-fancybox': 'gallery-'+parentIndex,
        'data-caption': caption
      });
    });

    $(this).fancybox({
      selector : `div.gallery-icon a[data-fancybox="gallery-${parentIndex}"]`,
      loop     : true
    });
  });
});
