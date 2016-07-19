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

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigkKSB7XG5cbiAgaWYoIXdpbmRvdy5tYXRjaE1lZGlhKCcobWluLXdpZHRoOiA3NjlweCknKS5tYXRjaGVzKSB7XG5cbiAgICB2YXIgJGhlYWRlciA9ICQoJy5zaXRlLWhlYWRlcicpO1xuICAgIHZhciAkbmF2ID0gJCgnLm5hdi1wcmltYXJ5Jyk7XG5cbiAgICB2YXIgJG5hdkJ0biA9ICQoJzxidXR0b24+Jyk7XG4gICAgJG5hdkJ0bi50ZXh0KCdNZW51Jyk7XG4gICAgJG5hdkJ0bi5hZGRDbGFzcygnbWVudS1idG4nKTtcblxuICAgIHZhciAkYnRuSG9sZGVyID0gJCgnPGRpdiBjbGFzcz1cIm1lbnUtYnRuLWhvbGRlclwiPicpLmFwcGVuZCgkbmF2QnRuKTtcbiAgICAkKCcudGl0bGUtYXJlYScpLmFwcGVuZCgkYnRuSG9sZGVyKTtcblxuICAgICRuYXZCdG4ub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAkaGVhZGVyLnRvZ2dsZUNsYXNzKCdpcy1vcGVuJyk7XG4gICAgfSk7XG5cbiAgfVxuXG59KShqUXVlcnkpO1xuIl0sImZpbGUiOiJtYWluLmpzIiwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=
