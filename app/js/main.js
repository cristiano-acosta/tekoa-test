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

  $('nav a[href*="#"]:not([href="#"]), a.link-arrow[href*="#"]:not([href="#"])').click(function() {
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

  $('input[type="tel"]').mask('(00) 0000-0000?');

  /*= Validar Formularios  =*/
  jQuery.validator.addMethod('phoneBR', function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, '');
    return this.optional(element) || phone_number.length > 9 &&
      //phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
      phone_number.match(/^\([1-9]{2}\)\d{4}\d{4}$/);
  }, 'Informe DD. Ex. (xx)xxxxxxxx.');

  $('form#contato').each(function(){
    $(this).validate({
      /*errorPlacement: function(label, element){
       var real_label = label.clone();
       real_label.insertAfter(element);
       element.blur(function(){
       $(this).next('label.error').addClass('label label-danger').fadeOut(200);
       });
       element.focus(function(){
       $(this).next('label.error').addClass('label label-danger').fadeIn(200);
       });
       },*/
      errorClass:'help-block label label-danger',
      errorElement:'p',
      highlight: function (element, errorClass, validClass) {
        $(element).parents('div.control-group').addClass('error');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).parents('.error').removeClass('error');
      },
      rules:{
        nome:{ required:true, minlength:2 },
        subject:{ required:true, minlength:2 },
        email:{ required:true, email:true },
        phone:{ required:true, phoneBR: true }
      },
      messages:{
        nome:{ required:'Preencha o campo nome.', minlength:'No minimo 2 letras' },
        subject:{ required:'Preencha o campo Assunto.', minlength:'No minimo 2 letras' },
        email:{ required:'Informe o seu email.', email:'Ops, informe um email vÃ¡lido' },
        phone:{ required:'Nos diga seu telefone.', phoneBR:'Informe DD. Ex. (xx) xxxxxxxx' }
      },
      submitHandler:function ( form ) {
        var dados = $( 'form#contato' ).serialize();
        $.ajax({
          type:'POST',
          url:'enviar.php',
          data:dados,
          dataType:'html',
          success:function (data) {
            $('#validacao').html(data).animate({opacity:1}, 1000).mouseover(function (){
              $(this).animate({ opacity:0 }, 1000);
            });
            $('form#contato')[0].reset();
          },
          error:function(data){
            $('#validacao').html(data).animate({opacity:1}, 1000).mouseover(function (){
              $(this).animate({ opacity:0 }, 1000);
            });
            $('form#contato')[0].reset();
          }
        });
        return false;
      }
    });
    //$(this).validate();
  });

  var wow = new WOW(
    {
      boxClass: 'wow', // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated)
      offset: 0, // distance to the element when triggering the animation (default is 0)
      mobile: false, // trigger animations on mobile devices (true is default)
      live: true // act on asynchronously loaded content (default is true)
    }
  );
  wow.init();

});
