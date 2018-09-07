$('#toform-nav').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
  yaCounter49058453.reachGoal('nav-to-form');
});

$('#toform-footer').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
});

$('#toform-main').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
  yaCounter49058453.reachGoal('main-to-form');
});

$('#toform-review').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
});


$('#toform-sotr').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
});

$('#toform-prod').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
  yaCounter49058453.reachGoal('prod-to-form');
});

$('#toform-partner').on('click', function(e) {
  e.preventDefault();
  $('[name="name"]').focus();
  yaCounter49058453.reachGoal('partner-to-form');
});

$(function() {
  var form = $('#form-contacts');
  var formMessages = $('#form-contacts');
  $(form).submit(function(event) {
    yaCounter49058453.reachGoal('price');
    gtag('event', 'order-price', {'event_category': 'price', 'event_action': 'order'});
    event.preventDefault(event);


    var formData = $(form).serialize();
    $.ajax({type: 'POST', url: 'mail/mail.php', data: formData}).done(function(response) {
      var first_name = $('[name="name"]').val();
      var text = first_name + ', cпасибо за&nbsp;заявку! В&nbsp;ближайшее время с&nbsp;вами свяжется менеджер.';
      $('#form-msg').html(text);
      $('#form-contacts').css('visibility', 'hidden').css('opacity', '0');
      $('#form-msg').css('visibility', 'visible').css('opacity', '1');
      setTimeout(function() {
        $('#form-contacts').css('visibility', 'visible').css('opacity', '1');
        $('#form-msg').css('visibility', 'hidden').css('opacity', '0');
      }, 20000);
    });
  });
});
