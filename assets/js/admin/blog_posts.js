$(document).ready(function () {

  $(document).on('submit', '#add-blog', function (e) {
    e.preventDefault();
    $('.all_errors').empty();
    var formObj = $(this);
    $.ajax({
      url: base_url + 'process-add-blog',
      data: new FormData(this),
      method: 'POST',
      dataType: 'JSON',
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data.errors);
        if (data.response == true) {
          formObj.trigger('reset');
          swal("Congratulations!", "Blog Post Added Successfully!", "success");
        } else {
          errors(data.errors);
          if (data.image_errors) {
            $('.image_error').value(data.image_errors);
          }
        }
      }

    });
  });

  function errors(errors = '') {
    $.each(errors, function (key, value) {
      $('.' + key + '_error').html(value);
      return false;
    });
  }

});