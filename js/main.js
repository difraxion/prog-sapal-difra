// Generated by CoffeeScript 1.6.3
var baseurl = $('#hdn_baseurl').val();
(function() {
  $(window).load(function(){
    temp_gral();
    //max_min();
    var h_frmlicitaciones = $('#frm_licitaciones').contents().height();
    $('#frm_licitaciones').attr('height',h_frmlicitaciones);
  });
  temp_gral = function() {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: baseurl + "webservices/temp_actual_gral",
      success: function(t){
        $('#temp_actual').html(t);
      }
    });
  };
  max_min = function() {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: baseurl + "webservices/gettemps",
      success: function(t){
        $('#temp_maxmin').html(t);
      }
    });
  }
  $(document).ready(function() {
    $('.lnk-n').mouseenter(function(){
      $('span.txt',this).stop(true,true).slideDown();
    });
    $('.lnk-n').mouseleave(function(){
      $('span.txt',this).stop(true,true).slideUp();
    });
    $('#btnf_info').click(function(){
      var email = $('#txtf_email').val();
      var asunto = $('#txtf_asunto').val();
      var mensaje = $('#txaf_msj').val();
      $.ajax({
          type: "POST",
          dataType: "html",
          url: DIR + "transparencia/contacto",
          data: 'email='+email+'&asunto='+asunto+'&mensaje='+mensaje,
          beforeSend:function(){
              $('#infof_msj').html('Enviando...');
          },
          success: function(data){
              $('#txtf_email').val('');
              $('#txtf_asunto').val('');
              $('#txaf_msj').val('');
              $('#infof_msj').html(data);
          }
      });
    });
    get_slide();
    $('.fancy_img').fancybox();
    $('.fancy_video').click(function(){
      $.fancybox({
        'padding'   : 0,
        'autoScale'   : false,
        'transitionIn'  : 'none',
        'transitionOut' : 'none',
        'title'     : this.title,
        'width'     : 853,
        'height'    : 480,
        'href'      : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
        'type'      : 'swf',
        'swf'     : {
        'wmode'       : 'transparent',
        'allowfullscreen' : 'true'
        }
      });

      return false;
    });
    $('#inicio .cycle-slideshow').on('cycle-before', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
      $('.label > h1').hide('drop', {
        direction: 'up'
      }, 450);
      return $('.label > h2').hide('drop', {
        direction: 'down'
      }, 450);
    });
    $('#inicio .cycle-slideshow').on('cycle-after', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
      $('.label > h1').show('drop', {
        direction: 'up'
      }, 450);
      return $('.label > h2').show('drop', {
        direction: 'down'
      }, 450);
    });
    $('#ul_servicios a').mouseenter(function() {
      var a, ico, screen, txt;
      a = $(this);
      ico = a.find('.ico');
      ico.css('background-position', '50% 40px');
      txt = a.find('.txt');
      screen = a.find('.screen');
      return screen.stop(true,true).animate({
        height: txt.height() + 20
      }, 300);
    });
    $('#ul_servicios a').mouseleave(function() {
      var a, ico, screen;
      a = $(this);
      ico = a.find('.ico');
      ico.css('background-position', '50% 58px');
      screen = a.find('.screen');
      return screen.stop(true,true).animate({
        height: '100%'
      }, 300);
    });


    return $('.tb2').on('click', function() {
      var tb2;
      if (!$(this).hasClass('active')) {
        tb2 = $(this);
        $('.tb2').removeClass('active');
        $('.tb2').find('tbody').hide();
        tb2.addClass('active');
        return tb2.find('tbody').show(300, function() {
          var offset;
          offset = tb2.offset();
          return $('html, body').animate({
            scrollTop: offset.top - 15
          }, 600);
        });
      }
    });
  });
  function get_slide(){
    contents=$('.banner-princ');
       $.ajax({
        type: "POST",
        url: baseurl + 'home/get_slides',
       // data: 'id_not=' + getItem,
        dataType: 'json',
        success: function(data) {
          $.each(data, function(i, datosall) {
            contents.append('<div style="background-image: url('+baseurl+'media/images/'+datosall.imagen+');" class="item-slide bkg-cover"><div class="label wrapper pr"><h1 class="pa">'+datosall.titulo+'<h2 class="pa">'+datosall.subtitulo+'</h2></div></div>');
          });
          $('.cycle-slideshow').cycle('reinit');
        }
      });
  }
  $('.majorpoints').click(function(){
    var ts=$(this);
    $(this).find('.hiders').toggle('slow', function() {
        ts.find('legend').toggleClass('prub');
      });
  });
  $(".algo").click(function(){
    var id= $(this).attr('id'); 
    //alert('you clicked on id ' + id);
      $('.'+id).toggle('slow', function() {
        //$(id).prev().toggleClass('legend');
        //$('.prub').toggleClass(id);
        $(this).prev().toggleClass( "prub" );
        //alert('.activo');
      });
    $('html').animate ( {scrollTop: $('.ri').offset().top}, 1000 );
  });
  $(".tg-directory").click(function() {
    var lnk = $(this);
    var parent = lnk.parent().parent();
    var div = parent.find('.tg-function');
    if(div.is(':hidden')) {
      $(".tg-directory").removeClass('tg-directory-act');
      $('.tg-function').slideUp();
      lnk.addClass('tg-directory-act');
      div.slideDown();
    }
    else {
      lnk.removeClass('tg-directory-act');  
      div.slideUp();
    }
  });

  var num = 500; //number of pixels before modifying styles
  $(window).bind('scroll', function () {
      if ($(window).scrollTop() > num) {
          $('.topdirectory').addClass('fixed');
          $('.lnk_fback').slideDown();
      } else {
          $('.topdirectory').removeClass('fixed');
          $('.lnk_fback').slideUp();
      }
  });
  var status = $('#status');
  $('#frm_proveedores').ajaxForm({
      beforeSend: function() {
          status.empty();
      },
      uploadProgress: function(event, position, total, percentComplete) {},
      success: function() {},
      complete: function(xhr) {
          status.html(xhr.responseText);
      }
  });
	$(".sic_img").click(function(){
  		$("#sic_form").toggle("slow");
	});
}).call(this)