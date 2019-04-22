<?php
/**
 * template_scripts.php
 *
 * Author: pixelcave
 *
 * All vital JS scripts are included here
 *
 */
?>

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="/js/vendor/jquery.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="/js/plugins.js"></script>
<script src="/js/app.js"></script>
<script src="/js/vendor/anime.min.js"></script>
<script>
  $('#footerTerms').on('click', (e) => {
    $('#legal-modal .modal-header h2').addClass('hidden');
    $('#legal-modal .modal-body div').addClass('hidden');
    $('#legal-terms-title').removeClass('hidden');
    $('#legal-text-terms').removeClass('hidden');
    $('#legal-modal').modal();
  });

  $('#footerPrivacy').on('click', (e) => {
    $('.modal-header h2').addClass('hidden');
    $('#legal-modal .modal-body div').addClass('hidden');
    $('#legal-privacy-title').removeClass('hidden');
    $('#legal-text-privacy').removeClass('hidden');
    $('#legal-modal').modal();
  });

  $('#footerUserAgree').on('click', (e) => {
    $('.modal-header h2').addClass('hidden');
    $('#legal-modal .modal-body div').addClass('hidden');
    $('#legal-userAgree-title').removeClass('hidden');
    $('#legal-text-userAgree').removeClass('hidden');
    $('#legal-modal').modal();
  });

  $('#footerUserAgreement').on('click', (e) => {
    $('.modal-header h2').addClass('hidden');
    $('#legal-modal .modal-body div').addClass('hidden');
    $('#legal-userAgree-title').removeClass('hidden');
    $('#legal-text-userAgree').removeClass('hidden');
    $('#legal-modal').modal();
  });
</script>