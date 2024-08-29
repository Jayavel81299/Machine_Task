$(document).on('submit', '#formSubmit', function(e) {
    e.preventDefault();
    var form = $(this);

    if (validateForm(form)) {
        var submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        var formData = new FormData(this);
        var url = form.attr('action');
        var method = form.attr('method');
        CommonAjax(url, method, formData, submitBtn);
    }
});

function validateField(field) {
    var $field = $(field);
    var value = $field.val();
    var name = $field.attr('name');
    var errorElement = $('.' + name + '-error');

    if (value == null) {
        value = ''; 
    } else if (typeof value === 'string') {
        value = value.trim();
    } else {
        value = '';
    }
    var errorMessage = '';
    if (name === 'name') {
        if (value.length < 2 || value.length > 55) {
            errorMessage = 'Name must be between 2 and 55 characters.';
        }
    } else if (name === 'email') {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            errorMessage = 'Please enter a valid email address.';
        }
    } else if (name === 'role') {
        if (value === '' || value === null) {
            errorMessage = 'Please select a role.';
        }
    } else if (name === 'password') {
        if (value.length < 8 || value.length > 32) {
            errorMessage = 'Password must be between 8 and 32 characters.';
        }
    }

    if (errorMessage) {
        $field.addClass('is-invalid');
        errorElement.text(errorMessage);
        return false; 
    } else {
        $field.removeClass('is-invalid');
        errorElement.text('');
        return true; 
    }
}

function validateForm(form) {
    var isValid = true;

    $(form).find('[data-required="on"]').each(function() {
        if (!validateField(this)) {
            isValid = false;
        }
    });

    return isValid;
}

$(document).on('keyup change', '#formSubmit .form-control, #formSubmit .form-select', function() {
    validateField(this);
});
