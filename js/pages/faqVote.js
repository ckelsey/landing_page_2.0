
jQuery(document).ready(function () {
  const articleID = $('#aid').val();
  const hasVoted = localStorage.getItem('CAI-' + articleID);
  
  if(hasVoted == '1') {
    $('.feedbackRow').addClass('hidden');
  }

  $('#articleHelpfulYes').on('click', (e) => {
    e.preventDefault();

    
    $('#feedbackBtns').addClass('hidden');
    $('#feedbackThanks').removeClass('hidden');
    localStorage.setItem('CAI-' + articleID, '1');

    App.postData('/faq/post/saveFAQVote.php', JSON.stringify({
      'i': articleID,
      'v': '1'
    }), false, null).then(data => {
      console.log('vote saved');
    }).catch(data => {
      console.log(data);
    })
  });
});