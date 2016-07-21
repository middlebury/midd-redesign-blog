(function() {

  if(!window.matchMedia('(min-width: 1024px)').matches) {

    var header = document.querySelector('.site-header');
    var nav = document.querySelector('.nav-primary');

    var navBtn = document.createElement('button');
    navBtn.appendChild(document.createTextNode('Menu'));
    navBtn.classList.add('menu-btn');

    var btnHolder = document.createElement('div').appendChild(navBtn);

    btnHolder.classList.add('menu-btn-holder');

    document.querySelector('.title-area').appendChild(btnHolder);

    navBtn.addEventListener('click', function() {
      header.classList.toggle('is-open');
    });

  }

})();

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpIHtcblxuICBpZighd2luZG93Lm1hdGNoTWVkaWEoJyhtaW4td2lkdGg6IDEwMjRweCknKS5tYXRjaGVzKSB7XG5cbiAgICB2YXIgaGVhZGVyID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNpdGUtaGVhZGVyJyk7XG4gICAgdmFyIG5hdiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5uYXYtcHJpbWFyeScpO1xuXG4gICAgdmFyIG5hdkJ0biA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2J1dHRvbicpO1xuICAgIG5hdkJ0bi5hcHBlbmRDaGlsZChkb2N1bWVudC5jcmVhdGVUZXh0Tm9kZSgnTWVudScpKTtcbiAgICBuYXZCdG4uY2xhc3NMaXN0LmFkZCgnbWVudS1idG4nKTtcblxuICAgIHZhciBidG5Ib2xkZXIgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKS5hcHBlbmRDaGlsZChuYXZCdG4pO1xuXG4gICAgYnRuSG9sZGVyLmNsYXNzTGlzdC5hZGQoJ21lbnUtYnRuLWhvbGRlcicpO1xuXG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnRpdGxlLWFyZWEnKS5hcHBlbmRDaGlsZChidG5Ib2xkZXIpO1xuXG4gICAgbmF2QnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICBoZWFkZXIuY2xhc3NMaXN0LnRvZ2dsZSgnaXMtb3BlbicpO1xuICAgIH0pO1xuXG4gIH1cblxufSkoKTtcbiJdLCJmaWxlIjoibWFpbi5qcyIsInNvdXJjZVJvb3QiOiIvc291cmNlLyJ9
