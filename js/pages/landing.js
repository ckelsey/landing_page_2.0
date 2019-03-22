
jQuery(document).ready(function () {
  if (window.location.hash) {
    var hash_offset = $(window.location.hash).offset().top;
    $("html, body").animate({
        scrollTop: hash_offset
    });
  }
  
  $('a#moreinfo').on('click', (e) => {
    e.preventDefault();

    $.magnificPopup.open({
      fixedBgPos: false,
      items: {src: '/img/How-it-Works.png'},
      type: 'image'
    });
  });

  $('#btn-quick-signup').on('click', (e) => {
    const email = $('#register-email').val();
    const qs = window.btoa(email);
    window.location.href = "/signup/?" + qs;
  });
});