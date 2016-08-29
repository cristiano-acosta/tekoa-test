jQuery(document).ready(function() {

  /** fixar menu */
  $(window).scroll(function () {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ){

    } else {
      if ($(window).scrollTop() > 100) {
        $('nav#navbar').removeClass('navbar-transparent').addClass('navbar-default').addClass('navbar-center');
        $('nav#navbar a.navbar-brand img.img-full').hide();
        $('nav#navbar a.navbar-brand img.img-ico').show();
      } else {
        $('nav#navbar').addClass('navbar-transparent').removeClass('navbar-center');
        $('nav#navbar a.navbar-brand img.img-full').show();
        $('nav#navbar a.navbar-brand img.img-ico').hide();
      }
    }
  });

  $('nav a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });

});
