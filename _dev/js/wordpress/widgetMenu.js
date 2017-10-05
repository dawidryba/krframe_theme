jQuery(document).ready(function($) {
  const $menu = $('.widget ul.menu');
  const iconClassClose = 'fa fa-angle-down';
  const iconClassOpen = 'fa fa-angle-up';

  if ($menu.length == 0)
    return false;

  const $subMenu = $menu.find('li.menu-item-has-children');

  $subMenu.each(function(index, el) {
    $(this).append(`<i class="${iconClassClose} more"></i>`);
  });

  $subMenu.find('i.more').on('click', function(){
    let $parent = $(this).parent();
    $parent.toggleClass('menu-opened');

    if ($parent.hasClass('menu-opened'))
      $(this).removeClass(iconClassClose).addClass(iconClassOpen);
    else
      $(this).removeClass(iconClassOpen).addClass(iconClassClose);
  });
});
