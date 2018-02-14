/*
 Разные скрипты для сайта.
 */
var lastForm = 0;

function handleRequestAddOpinion(response){
  if(response.ok){
    alert('Спасибо. Ваш комментарий добавлен');
    $('#'+lastForm).hide();
  }
  else if (response.errors) {
    var errors_str = '';
    for(i in response.errors){
      errors_str += response.errors[i] + '\n';
    }
    alert(errors_str);
  }
}

function setSubscribePopupTimeout()
{
  setTimeout(function(){
    $('#popupSubscribe').modal();
  }, 60 * 1000 * 4);
}

$(function(){
  $(".inp_txt").textPlaceholder();

  $('.express-signup-container').expressForm({
    successURL: 'http://' + document.domain + '/book/'
  });

  $('div.form_mail_exit input:submit').click(function(){
      $field = $('div.form_mail_exit input[name="first_name"]');
      if(!$field.val()){
          alert('Укажите своё имя.');
          return false;
      }
  });

  $('div.form_mail_exit form').submit(function(){
      $('div.form_mail_exit').hide();
      $('div.preload').show();
  });

  $('p.body_que').click(function(){
      $(this).next('.answer').toggleClass('hidden');
  });

  $('#payByOtherMethod').click(function(){
      $('.snippet_stories').hide();
  });

  /*
    Кнопка отображения дополнительных способов оплаты
   */
  $('.enable-advanced-methods').click(function(event){
    event.preventDefault();
    $('#advancedMethodsBtn').hide();
    $('#advancedMethodsContainer').show();
  });

  $('#popupSubscribe .form-container').expressForm({
    onSuccess: function(){
      $('#popupSubscribe .form-container').hide();
      $('#popupSubscribe .button-container').show();
    }
  });

  $('.form-opinion').submit(function(event){
    event.preventDefault();
    target = $(event.target);
    lastForm = target.attr('id');

    $.post(target.attr('action'), target.serialize(), handleRequestAddOpinion, 'json');
  });

  /*
   * При показе попапа ставим фокус на первое текстовое поле.
   */
  $('.popup').on('shown', function(){
    $('input[type="text"]:not(.hasDatepicker):first', $(this)).focus();
  });
});

$('#firstTimeGreeting .close').click(function(event){
  var $alert = $(this).parents('.alert:first');
  $alert.hide();
  $.get(urls.dismissGreeting);
});

function runHomepageAnimation()
{
}

$(document).ready(function() {
  $(window).on('scroll');

  var status = [];

  /* Every time the window is scrolled ... */
  $(window).scroll( function(){
    /* Check the location of each desired element */
    $('.hideme').each( function(i, el){
      if (status[i] !== 'showing') { // Makes sure that we haven't already done this item
        var bottom_of_object = $(this).position().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();

        /* If the object is completely visible in the window, fade it it */
        if( bottom_of_window > bottom_of_object ){
          $(this).animate({'opacity':'1'},500);
          status[i] = 'showing';

          if ($('.hideme').index($(this)) + 1 === $('.hideme').length) {
            // We've shown them all, stop listening for scroll events!!!
            $(window).off('scroll');
          }
        }
      }
    });
  });
});


function hidePic() {
    if ($(window).width() < 1120) {
        $('.hidePic').hide();
    } else {
        $('.hidePic').show();
    }
}

$(function () {
    hidePic();
});

$(window).resize(function () {
    hidePic();
});