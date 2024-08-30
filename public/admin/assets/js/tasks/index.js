// Input validation function
function validateInput(input, errorSelector) {
    let value = $(input).val();

    if (input.attr('id') === 'description') {
        const editorContent = $(input).find('.ql-editor').html();
        const plainText = editorContent.replace(/<\/?[^>]+(>|$)/g, "").trim();

        if (plainText === '') {
            $(errorSelector).text('This field is required.');
            return false;
        } else {
            $(errorSelector).text('');
            return true;
        }
    }

    if (input.attr('id') === 'user_id') {
        if (!value || value.length === 0) {
            $(errorSelector).text('Please select at least one member.');
            return false;
        } else {
            $(errorSelector).text('');
            return true;
        }
    }

    if (!value) {
        $(errorSelector).text('This field is required.');
        return false;
    } else {
        $(errorSelector).text('');
        return true;
    }
}

$('#project_id, #user_id, #description, #status, #start_date, #end_date').on('keyup change', function() {
    let input = $(this);
    let errorSelector = '.' + input.attr('id') + '-error';
    validateInput(input, errorSelector);
});

// Form submission handling
$('#formSubmit').on('submit', function(event) {
    event.preventDefault();
    let isValid = true;

    isValid = validateInput($('#project_id'), '.project_id-error') && isValid;
    isValid = validateInput($('#user_id'), '.user_id-error') && isValid;
    isValid = validateInput($('#description'), '.description-error') && isValid;
    isValid = validateInput($('#status'), '.status-error') && isValid;
    isValid = validateInput($('#start_date'), '.start_date-error') && isValid;
    isValid = validateInput($('#end_date'), '.end_date-error') && isValid;

    if (isValid) {
        let form = $(this);
        let submitBtn = form.find('button[type="submit"]');
        let formData = new FormData(this);
        let url = form.attr('action');
        let method = form.attr('method');
        
        const editorContent = $('#description .ql-editor').html();
        formData.append('description', editorContent === '<p><br></p>' ? '' : editorContent);
        
        CommonAjax(url, method, formData, submitBtn);
    }
});
