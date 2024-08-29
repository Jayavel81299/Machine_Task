$(document).on('submit', '#formSubmit', function(e) {
    e.preventDefault();
    var form = $(this);

    var submitBtn = form.find('button[type="submit"]');
    submitBtn.prop('disabled', true);
    var formData = new FormData(this);
    var url = form.attr('action');
    var method = form.attr('method');
    //initially add br tag remove it
    const editorContent = $('#description .ql-editor').html();
    formData.append('description', editorContent === '<p><br></p>' ? '' : editorContent);
    CommonAjax(url, method, formData, submitBtn);
});


