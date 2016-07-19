(function($) {

  if(!window.matchMedia('(min-width: 769px)').matches) {

    var $header = $('.site-header');
    var $nav = $('.nav-primary');

    var $navBtn = $('<button>');
    $navBtn.text('Menu');
    $navBtn.addClass('menu-btn');

    var $btnHolder = $('<div class="menu-btn-holder">').append($navBtn);
    $('.title-area').append($btnHolder);

    $navBtn.on('click', function() {
      $header.toggleClass('is-open');
    });

  }

})(jQuery);
