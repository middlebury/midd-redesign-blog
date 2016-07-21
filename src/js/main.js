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
