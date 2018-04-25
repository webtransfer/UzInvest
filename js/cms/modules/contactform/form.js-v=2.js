$(function(){
  var blocks = [
    $('.cfSender'),
    $('.cfMessage'),
    $('.cfQuestions'),
    $('.cfReservation'),
    $('.cfPaymentIssue')
  ];

  $('#changeCategoryButton').click(function(event){
    event.preventDefault();
    var $option = $('form#cfForm select[name="category_id"] option:selected');
    var behavior = $option.data('behavior');
    var categoryId = $option.val();

    resetForm();

    $('.behavior-' + behavior).show();
    switch (behavior) {
      case 'payment_issue':
        $('#cfForm').attr('action', urls.payment_issue);
        $('.cfSender').show();
        break;

      case 'reservation':
        $('#cfForm').attr('action', urls.reservation);
        $('.cfSender').show();
        break;

      case 'top':
        categoryId = 0;

      default:
        $('#cfForm').attr('action', urls.send);
        loadFaqCategory(categoryId);
    }
  });

  $('#writeMessageButton').click(function(event){
    event.preventDefault();
    resetForm();
    $('.cfSender, .behavior-message').show();
  });

  function resetForm()
  {
    $.each(blocks, function(){
      this.hide();
    });
    $('.category-text').hide();
    $('#categories').html();
    $('#cfForm input:file').val('');
  }

  function loadFaqCategory(id)
  {
    $.getJSON(urls.load_category, {id: id}, handleRequestLoadQuestions);
  };

  function handleRequestLoadQuestions(response)
  {
    if (response.ok) {
      $('.cfQuestions, .cfQuestions .tac').show();
      $('#questions').html(response.data.html);
    } else if (response.errors) {
      errors = response.errors || [];
      alert(errors.join("\n"));
    }
  };
});


// вешается на #senderfile change, если биндить - начинает глючить
function fileUpload(el)
{
  var $this = $(el);
  var $tab = $(el).parents('.cf-tab:first');
  var $ico = $(".ico-file-loading", $tab);

  $ico.css({visibility: 'visible'});
  $('.btn', $tab).addClass('disabled');
  $.ajaxFileUpload({
    url: urls.fileupload,
    secureuri: false,
    fileElementId: $(el).attr('id'),
    dataType: 'json',
    data: [],
    success: function (data, status)
    {
      $ico.css({visibility: 'hidden'});
      if (typeof(data.error) != 'undefined') {
        if (data.error != '') {
          alert(data.error);
        } else {
          $('.filename').val('');
          $('.filename', $tab).val(data.filename);
        }
      };
      $('.btn', $tab).removeClass('disabled');
    },
    error: function (data, status, e)
    {
      $('.btn', $tab).removeClass('disabled');
      $ico.css({visibility: 'hidden'});
      alert(e);
    }
  })
}